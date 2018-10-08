<?php

namespace App\Traits;

use DB;
use Auth;
use App\Models\Administration\Comment;
use App\Traits\Invoice;
use App\Models\Inventory\Departures;
use Mail;

trait Payment {

    use Invoice;

    public function __construct() {
        
    }

    public function createOrder($user_id = null, $order_id = null) {
        $user_id = ($user_id == null) ? Auth::user()->id : $user_id;

        if ($order_id == null) {
            $row = \App\Models\Inventory\Orders::where("status_id", 1)->where("insert_id", $user_id)->first();
        } else {
            $row = \App\Models\Inventory\Orders::find($order_id);
        }
        $user = \App\Models\Security\Users::find($user_id);

        $client = \App\Models\Administration\Stakeholder::find($user->stakeholder_id);

        $param["header"]["warehouse_id"] = 3;
        $param["header"]["responsible_id"] = 1;
        $param["header"]["city_id"] = $client->city_id;
        $param["header"]["created"] = date("Y-m-d H:i");
        $param["header"]["status_id"] = 1;
        $param["header"]["client_id"] = $user->stakeholder_id;
        $param["header"]["destination_id"] = $client->city_id;
        $param["header"]["address"] = $client->address_send;
        $param["header"]["phone"] = $client->phone;
        $param["header"]["shipping_cost"] = 0;
        $param["header"]["insert_id"] = $user_id;
        $param["header"]["order_id"] = $row->id;
        $param["detail"] = $this->formatDetailOrder($row);
        $param["header"]["total"] = $this->total;
        $param["header"]["tax19"] = $this->tax19;
        $param["header"]["tax5"] = $this->tax5;
        return $param;
    }

    public function createDeparture($header, $detail) {
        try {
            DB::beginTransaction();
            $header["insert_id"] = (isset($header["insert_id"])) ? $header["insert_id"] : Auth::user()->id;

            if (isset($header["branch_id"]) && $header["branch_id"] != 0) {

                $bra = \App\Models\Administration\Branch::find($header["branch_id"]);
                $header["responsible_id"] = $bra->responsible_id;
            } else {
                unset($header["branch_id"]);
            }


            $commercial = \App\Models\Security\Users::find($header["responsible_id"]);
            $header["responsible"] = $commercial["name"] . " " . $commercial["last_name"];
            $result = Departures::create($header)->id;


            if ($result) {
                $emDetail = null;

                $resp = Departures::Find($result);

                $detail = array_values(array_filter($detail));


                $price_sf = 0;
                $tax19 = 0;
                $tax5 = 0;
                $total_quantity = 0;
                $total_quantity_packaging = 0;
                foreach ($detail as $i => $val) {
                    $product_id = (is_array($val)) ? $val["product_id"] : $val->product_id;
                    $quantity = (is_array($val)) ? $val["quantity"] : $val->quantity;

                    $total_quantity += $quantity;

                    $special = \App\Models\Administration\PricesSpecial::where("product_id", $product_id)
                                    ->where("client_id", $header["client_id"])->first();

                    if ($special == null) {
                        $pro = \App\Models\Administration\Products::find($product_id);
                    } else {
                        $pro = DB::table("products")
                                ->select("products.id", "prices_special.price_sf", "prices_special.units_sf", 'prices_special.tax', "prices_special.packaging", "products.cost_sf")
                                ->join("prices_special", "prices_special.product_id", "products.id")
                                ->where("prices_special.id", $special->id)
                                ->first();
                    }

                    $price_sf = $pro->price_sf;
//                    if (Auth::user()->role_id == 1) {
//                        if (isset($val["price_sf"]) && !empty($val["price_sf"])) {
//                            $price_sf = $val["price_sf"];
//                        }
//                    }

                    $new["product_id"] = $product_id;
                    $new["departure_id"] = $resp->id;
                    $new["status_id"] = 1;
                    $new["quantity"] = $quantity;
                    $new["units_sf"] = $pro->units_sf;
                    $new["packaging"] = ($pro->packaging == null) ? 1 : $pro->packaging;
                    $new["tax"] = $pro->tax;
                    $new["value"] = $price_sf;
                    $new["cost_sf"] = $pro->cost_sf;
                    $new["real_quantity"] = 0;
                    $new["type_insert_id"] = 1;

                    $total_quantity_packaging += $new["packaging"] * $quantity;


                    if ($pro->tax == '0.05') {
                        $tax5++;
                    }
                    if ($pro->tax == '0.19') {
                        $tax19++;
                    }

                    $valpro = \App\Models\Inventory\DeparturesDetail::where("product_id", $val["product_id"])->where("departure_id", $resp->id)->first();

                    if ($valpro == null) {
                        \App\Models\Inventory\DeparturesDetail::create($new);
                    }
                }


                if ($header["shipping_cost"] != 0) {
                    if ($tax19 > 0) {
                        $resp->shipping_cost_tax = 0.19;
                    } else if ($tax19 == 0 && $tax5 > 0) {
                        $resp->shipping_cost_tax = 0.05;
                    } else {
                        $resp->shipping_cost_tax = 0;
                    }
                    $resp->save();
                }


                $data["header"] = $resp;
                $listdetail = $this->formatDetailJSON($data, $result);


                $ware = $resp->warehouse;
                $client = $resp->client;

                $email = \App\Models\Administration\Email::where("description", "departures")->first();

                if ($email != null) {
                    $emDetail = \App\Models\Administration\EmailDetail::where("email_id", $email->id)->get();
                }

                if (count($emDetail) > 0) {
                    $this->mails = array();

                    $userware = \App\Administrator::find($ware->responsible_id);
                    $this->mails[] = $userware->email;

                    foreach ($emDetail as $value) {
                        $this->mails[] = $value->description;
                    }

                    $cit = $ware->city;

                    $this->subject = "SuperFuds " . date("d/m") . " " . $client->business . " " . $cit->description . " " . $result;
                    $header["city"] = $cit->description;

                    $user = \App\Administrator::find($header["responsible_id"]);

                    $header["name"] = ucwords($user->name);
                    $header["last_name"] = ucwords($user->last_name);
                    $header["phone"] = $user->phone;
                    $header["warehouse"] = $ware->description;
                    $header["address"] = $ware->address;
                    $header["detail"] = $listdetail["detail"];
                    $header["id"] = $result;
                    $header["environment"] = env("APP_ENV");
                    $header["created_at"] = $resp->created_at;

                    $this->subtotal += ($resp->shipping_cost);
                    $shipping_cost_tax = 0;

                    if ($resp->shipping_cost_tax == 0.05) {
                        $this->tax5 += $resp->shipping_cost_tax * $resp->shipping_cost;
                        $shipping_cost_tax = $this->tax5;
                    } else if ($resp->shipping_cost_tax == 0.19) {
                        $this->tax19 += $resp->shipping_cost_tax * $resp->shipping_cost;
                        $shipping_cost_tax = $this->tax19;
                    }

                    $this->total = $this->subtotal + $this->tax5 + $this->tax19 - $resp->discount;

                    $header["subtotal"] = "$" . number_format($this->subtotal, 0, ",", ".");
                    $header["total"] = "$" . number_format($this->total, 0, ",", ".");
                    $header["exento"] = $this->exento;
                    $header["tax5"] = $this->tax5;
                    $header["tax19"] = $this->tax19;
                    $header["flete"] = $resp->shipping_cost;
                    $header["discount"] = $resp->discount;
                    $header["status_id"] = $resp->status_id;

                    $this->mails[] = $user->email;

                    if ($header["environment"] == 'local') {
                        $this->mails = 'tech@superfuds.com.co';
                    }

                    $resp->quantity_packaging = $total_quantity_packaging;
                    $resp->quantity = $total_quantity;
                    $resp->exento = $this->exento;

                    $resp->tax5 = $this->tax5;
                    $resp->tax19 = $this->tax19;
                    $resp->subtotal = $this->subtotal;
                    $resp->total = $this->total;

                    $resp->save();

                    Mail::send("Notifications.departure", $header, function($msj) {
                        $msj->subject($this->subject);
                        $msj->to($this->mails);
                    });

//                    $this->logClient($client->id, "Genero Orden de venta " . $result);
                }

                DB::commit();

                $total = "$ " . number_format($this->total, 0, ",", ".");
                $data["success"] = true;
                $data["header"] = $resp;
                $response = $this->formatDetailJSON($data, $result);

                return response()->json($response);
            } else {
                return response()->json(['success' => false]);
            }
        } catch (Exception $exc) {
            DB::rollback();
            return response()->json(['success' => false, "msg" => "Wrong"], 409);
        }
    }

}
