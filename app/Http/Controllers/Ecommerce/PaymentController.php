<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inventory\Orders;
use App\Models\Inventory\OrdersDetail;
use App\Http\Controllers\Sales\DepartureController;
use App\Models\Administration\Characteristic;
use Auth;
use DB;
use Session;
use Illuminate\Support\Facades\Input;
use App\Models\Administration\Stakeholder;
use App\Models\Security\Users;
use Log;
use App\Models\Inventory\Departures;
use App\Models\Inventory\DeparturesDetail;
use App\Models\Administration\PricesSpecial;
use App\Models\Administration\Products;
use App\Traits\ValidateCreditCard;
use App\Models\Administration\Categories;
use App\Models\Administration\ProductsImage;
//Firebase
//use Kreait\Firebase\Factory;
//use Kreait\Firebase\ServiceAccount;
//use Kreait\Firebase\Database;
//Firestore
//use Google\Cloud\Firestore\FirestoreClient;
//use Google\Cloud\Firestore\DocumentSnapshot;
//use Google\Cloud\Firestore\QuerySnapshot;
use App\Traits\Invoice;
use App\Http\Controllers\Inventory\StockController;

class PaymentController extends Controller {

    use ValidateCreditCard;
    use Invoice;

    public $depObj;
    public $merchantId;
    public $accountId;
    public $description;
    public $referenceCode;
    public $buyerEmail;
    public $currency;
    public $ApiKey;
    public $ApiLogin;
    public $amount;
    public $order_id;
    public $order;
    public $categories;
    public $dietas;

    public function __construct() {

        $this->middleware("auth");

        $this->dietas = array(
            (object) array("id" => 1, "description" => "Paleo"),
            (object) array("id" => 2, "description" => "Vegano"),
            (object) array("id" => 3, "description" => "Sin gluten"),
            (object) array("id" => 4, "description" => "Organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans"),
            (object) array("id" => 6, "description" => "Sin azucar"),
        );

        $this->stock = new StockController();
        $this->depObj = new DepartureController();
        $this->merchantId = "508029";
        $this->accountId = "512321";
        $this->description = "Ventas en linea";
        $this->referenceCode = "invoice001";
        $this->buyerEmail = "jpinedom@hotmail.com";
        $this->currency = "COP";
        $this->ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
        $this->ApiLogin = "pRRXKOl8ikMmt9u";
        $this->amount = 0;
        $this->order_id = 0;

        $this->categories = Categories::where("status_id", 1)->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)
                        ->orderBy("order", "asc")->get();
    }

    public function index() {

        $month = $this->getMonts();
        $years = $this->getYears();

        $data = $this->getDataPayment();

        $countries = $data["countries"];
        $categories = $data["categories"];
        $id = $data["id"];
        $total = $data["total"];
        $subtotal = $data["subtotal"];
        $term = $data["term"];

        $deviceSessionId = $data["deviceSessionId"];
        $deviceSessionId_concat = $data["deviceSessionId_concat"];

        $categories = $this->categories;
        $client = Stakeholder::where("document", Auth::user()->document)->first();

        $deviceSessionId = md5(session_id() . microtime());
        $deviceSessionId_concat = $deviceSessionId . "80200";
        $dietas=$this->dietas;
//        return view("Ecommerce.payment.init", compact());
        return view("Ecommerce.payment.init", compact("id", "categories", "client", "month", "years", "total", "countries", "subtotal", "deviceSessionId", "deviceSessionId_concat", "term","dietas"));
    }

    public function getProduct($id) {
        $product = DB::table("vproducts")->where("slug", $id)->first();


        if ($product != null) {

            $detail = ProductsImage::where("product_id", $product->id)->get();

            $relations = DB::table("vproducts")->where("category_id", $product->category_id)->whereNotNull("image")->get();


            $supplier = Stakeholder::find($product->supplier_id);

            if ($product->characteristic != null) {
                $cod = json_decode($product->characteristic, true);
                $id = array();

                foreach ($cod as $value) {
                    $id[] = (int) $value;
                }

                if (count($id) > 0) {
                    $cha = Characteristic::whereIn("id", $cod)->get();
                    $product->characteristic = $cha;
                }
            }

            $available = $this->stock->getInventory($product->id);

            $categories = Categories::where("node_id", 0)->get();


            return view("Ecommerce.payment.product", compact("product", "detail", "relations", "supplier", "available", "categories"));
        } else {
            return response(view('errors.503'), 404);
        }
    }

    public function congratulations() {
        $categories = $this->categories;
        return view("congratulations", compact("categories"));
    }

    public function getMethodsPayments() {
        $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi ";
        $postData = array(
            "test" => "false",
            "language" => "es",
            "command" => "GET_PAYMENT_METHODS",
            "merchant" => array("apiLogin" => "pRRXKOl8ikMmt9u", "apiKey" => "4Vj8eK4rloUd272L48hsrarnUA"));


        $data_string = json_encode($postData);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json;',
            'Host: sandbox.api.payulatam.com',
            'Accept:application/json',
            'Content-Length: ' . strlen($data_string))
        );
//print_r($data_string);exit;                        

        $result = curl_exec($ch);
        $arr = json_decode($result, TRUE);
        $banks = [];


        dd($arr);
        foreach ($arr["paymentMethods"] as $val) {
            if ($val["country"] == 'CO') {
                $banks[] = $val;
            }
        }

        return $banks;
    }

    public function generatekey() {
        $key = md5($this->ApiKey . "~" . $this->merchantId . "~" . $this->referenceCode . "~" . $this->currency);
        return response()->json(["key" => $key]);
    }

    public function addProduct(Request $req, $slug) {
        $in = $req->all();

        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();



        if ($order == null) {
            $new["insert_id"] = Auth::user()->id;
            $new["status_id"] = 1;
            $order_id = Orders::create($new)->id;
        } else {
            $order_id = $order->id;
        }

        if ($order_id != null) {

            $pro = Products::find($in["product_id"]);

            $detPro = OrdersDetail::where("product_id", $pro->id)->where("order_id", $order->id)->first();

            $det["product_id"] = $pro->id;
            $det["order_id"] = $order_id;
            $det["tax"] = $in["tax"];
            $det["units_sf"] = $pro->units_sf;
            $det["packaging"] = $pro->packaging;
            $det["price_sf"] = $pro->price_sf;

            if ($detPro != null) {
                $detPro->quantity = $detPro->quantity + 1;
                $detPro->save();
            } else {
                $det["quantity"] = 1;
                OrdersDetail::create($det);
            }
        }


        $res = $this->getOrdersCurrent($slug);

        return response()->json(["success" => true, "quantity" => $res["quantity"], "detail" => $res["detail"], "row" => $res["row"]]);
    }

    public function deleteProduct(Request $req, $slug) {
        $in = $req->all();

        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();

        if ($order != null) {
            $pro = Products::where("slug", $slug)->first();
            $detPro = OrdersDetail::where("product_id", $pro->id)->first();

            if ($detPro->quantity == 1) {
                $detPro->delete();
            } else {
                $detPro->quantity = $detPro->quantity - 1;
                $detPro->save();
            }
        }

        $res = $this->getOrdersCurrent($slug);

        return response()->json(["success" => true, "quantity" => $res["quantity"], "detail" => $res["detail"], "row" => $res["row"]]);
    }

    public function deleteAllProduct(Request $req, $slug) {

        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();

        if ($order != null) {
            $pro = Products::where("slug", $slug)->first();
            $detPro = OrdersDetail::where("product_id", $pro->id)->get();

            foreach ($detPro as $value) {
                $row = OrdersDetail::find($value->id);
                $row->delete();
            }
        }

        $res = $this->getOrdersCurrent($slug);

        return response()->json(["success" => true, "quantity" => $res["quantity"], "detail" => $res["detail"], "row" => $res["row"]]);
    }

    public function getCities($department_id) {
        $data = \App\Models\Administration\Cities::where("department_id", $department_id)->get();
        return response()->json($data);
    }

    public function getOrdersCurrent($slug = null) {
        $detail = [];
        if (Auth::user() != null) {
            $detail = $this->getDataCountOrders();
        }

        $row = [];
        if ($slug != null) {
            $row = $this->getDataCountOrders($slug);
        }

        $quantity = 0;
        $total = 0;
        $subtotal = 0;
        $tax5 = 0;
        $tax19 = 0;

        if ($detail) {
            foreach ($detail as $value) {
                $quantity += $value->quantity;
                $subtotal += $value->quantity * $value->price_sf;
                $total += ($value->quantity * $value->price_sf * $value->tax) + ($value->quantity * $value->price_sf);

                if ($value->tax == '0.05') {
                    $tax5 += ($value->quantity * $value->price_sf * $value->tax);
                }
                if ($value->tax == '0.19') {
                    $tax19 += ($value->quantity * $value->price_sf * $value->tax);
                }
            }
        } else {
            
        }

        return ["quantity" => $quantity, "total" => $total, "subtotal" => $subtotal, "tax5" => $tax5, "tax19" => $tax19, "detail" => $detail, "row" => $row];
    }

    public function getDataCountOrders($slug = null) {
        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();

        if ($order != null) {

            if ($slug != null) {
                $slug = " AND p.slug='" . $slug . "'";
            }

            $sql = "
            SELECT d.product_id,p.title as product,d.tax,d.price_sf,COALESCE(d.units_sf,1) as units_sf,p.thumbnail,sum(d.quantity) as quantity,sum(d.quantity * d.price_sf) as subtotal,p.slug,p.supplier
            FROM orders_detail d
            JOIN vproducts p on p.id=d.product_id
            WHERE d.order_id=" . $order["id"] . " $slug
            group by 1, 2, 3, 4, 5, 6,slug,p.supplier";

            if ($slug != null) {
                if (count(DB::select($sql)) > 0) {
                    return DB::select($sql)[0];
                } else {
                    return ["quantity" => 0];
                }
            }
            return DB::select($sql);
        } else {
            return false;
        }
//        
//        return OrdersDetail::select("orders_detail.id", "orders_detail.quantity", "orders_detail.tax", "vproducts.title as product", "orders_detail.price_sf", "vproducts.thumbnail")
//                        ->join("vproducts", "vproducts.id", "orders_detail.product_id")
//                        ->where("order_id", $order["id"])->get();
    }

    public function getDetail() {
        $detail = $this->getDetailData();

        if ($detail != null) {

            $detail = $this->formatedDetail($detail);

            $total = "$" . number_format($this->total, 0, ",", ".");
            $subtotal = "$" . number_format($this->subtotal, 0, ",", ".");
            $tax5 = "$" . number_format($this->tax5, 0, ",", ".");
            $tax19 = "$" . number_format($this->tax19, 0, ",", ".");

            return response()->json(["detail" => $detail, "total" => $total, "exento" => $this->exento, "subtotal" => $subtotal,
                        "order" => $this->order_id, "totalnumeric" => $this->total, 'tax5' => $tax5, "tax19" => $tax19]);
        } else {
            return response()->json(["success" => false, "total" => 0, "subtotal" => 0]);
        }
    }

    public function methodsPayment() {
        $month = $this->getMonts();
        $years = $this->getYears();

        $data = $this->getDataPayment();

        $countries = $data["countries"];
        $categories = $data["categories"];
        $id = $data["id"];
        $total = $data["total"];
        $subtotal = $data["subtotal"];

        $deviceSessionId = $data["deviceSessionId"];
        $deviceSessionId_concat = $data["deviceSessionId_concat"];

        return view("Ecommerce.payment.payment", compact("id", "categories", "client", "month", "years", "total", "countries", "subtotal", "deviceSessionId", "deviceSessionId_concat"));
    }

    public function getDataPayment() {
        $data = [];

        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();

        $user = Users::find($order->insert_id);

        $client = Stakeholder::find($user->stakeholder_id);

        $detail = $this->getDetailOrder($order->id);

        $data["countries"][] = array("code" => "CO", "description" => "Colombia");

        if ($detail) {
            $deviceSessionId = md5(session_id() . microtime());
            $deviceSessionId_concat = $deviceSessionId . "80200";
            $data["deviceSessionId"] = $deviceSessionId;
            $data["deviceSessionId_concat"] = $deviceSessionId_concat;

            $data["categories"] = $this->categories;

            $data["id"] = $order->id;
            $data["term"] = $client->term;
            $data["total"] = "$" . number_format($this->total, 0, ",", ".");
            $data["subtotal"] = "$" . number_format($this->subtotal, 0, ",", ".");
        }

        return $data;
    }

    public function getYears() {
        $years = array();

        for ($i = (int) date("Y"); $i <= date("Y") + 10; $i++) {
            $years[] = $i;
        }

        return $years;
    }

    public function getMonts() {
        $month = array();
        for ($i = 1; $i <= 12; $i++) {
            if ($i <= 9) {
                $month[] = "0" . $i;
            } else {
                $month[] = "" . $i;
            }
        }

        return $month;
    }

    public function getDetailData() {
        $detail = null;
        if (Auth::user() != null) {
            $this->order = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();
            if ($this->order != null) {
                $this->order_id = $this->order->id;
                $sql = "
                SELECT p.title product,s.business as supplier,d.product_id,d.order_id,sum(d.quantity) quantity,d.price_sf as value,sum(d.quantity * d.price_sf) total,
                p.image,p.thumbnail,
                d.units_sf,d.tax
                FROM orders_detail d
                    LEFT JOIN vproducts p ON p.id=d.product_id
                    LEFT JOIN stakeholder s ON s.id=p.supplier_id
                WHERE order_id=" . $this->order->id . "
                GROUP BY 1,2,3,4,d.units_sf,product_id,p.image,d.tax,p.thumbnail,d.price_sf
                ORDER BY 1";
                $detail = DB::select($sql);

                $detail = json_decode(json_encode($detail), true);
                return $detail;
            } else {
                return null;
            }
        }
    }

    public function setQuantity(Request $req, $order_id) {
        $in = $req->all();

        $det = OrdersDetail::where("order_id", $order_id)->where("product_id", $in["product_id"])->get();
        foreach ($det as $value) {
            $row = OrdersDetail::find($value->id);
            $row->delete();
        }

        $pro = \App\Models\Administration\Products::find($in["product_id"]);

        for ($i = 0; $i < $in["quantity"]; $i++) {
            $new["order_id"] = $order_id;
            $new["product_id"] = $in["product_id"];
            $new["tax"] = $pro->tax;
            $new["value"] = $pro->price_sf;
            $new["units_sf"] = $pro->units_sf;
            $new["quantity"] = 1;
            OrdersDetail::create($new);
        }

        return response()->json(["success" => true]);
    }

    public function createOrder() {
        $row = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();

        $user = Users::find(Auth::user()->id);

        $client = Stakeholder::find($user->stakeholder_id);

        $new["warehouse_id"] = 3;
        $new["responsible_id"] = 1;
        $new["city_id"] = $client->city_id;
        $new["created"] = date("Y-m-d H:i");
        $new["status_id"] = 1;
        $new["client_id"] = $user->stakeholder_id;
        $new["destination_id"] = $client->city_id;
        $new["address"] = $client->address_send;
        $new["phone"] = $client->phone;
        $new["shipping_cost"] = 0;
        $new["insert_id"] = Auth::user()->id;
//        $new["type_insert_id"] = 2;
        $new["order_id"] = $row->id;
        $detail = $this->getDetailData();

        $res = $this->depObj->processDeparture($new, $detail)->getData();
        return $res;
    }

    public function payment(Request $req) {
//        dd($_SERVER["HTTP_USER_AGENT"]);
        try {
            DB::beginTransaction();
            $in = $req->all();

            $country = $in["country_id"];
            $in["expirate"] = $in["year"] . "/" . $in["month"];

            $data_order = $this->createOrder();
            $data_order->header->total = 10000;
//            echo "asd";
//            exit;
//        dd($data_order);
            $detail = $this->getDetailData();

            $client = Stakeholder::where("email", Auth::user()->email)->first();

            $city = \App\Models\Administration\Cities::find($client->city_id);
            $department = \App\Models\Administration\Department::find($city->department_id);
//
            $type_card = $this->identifyCard($in["number"], $in["crc"], $in["expirate"]);

            $error = '';


            if ($type_card["status"] == false) {
                $error = $type_card["msg"];
            }

            if ($error == '') {

                $deviceSessionId = $in["devicesessionid"];
//                $deviceSessionId = md5(session_id() . microtime());

                $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
                $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
//$apiKey = "maGw8KQ5JlOEv64D79ma1N0l9G";
                $apiLogin = "pRRXKOl8ikMmt9u";
//$apiLogin = "rHpg9EL98w905Nv";
                $merchantId = "508029";
                $accountId = "512321";
                $referenceCode = 'invoice_' . microtime();

                $TX_VALUE = round($data_order->header->total);
                $TX_TAX = 0;
                $TX_TAX_RETURN_BASE = 0;

                $session_id = md5(session_id() . microtime());
                $currency = "COP";
                $postData["test"] = "true";
                $postData["language"] = "en";
                $postData["command"] = "SUBMIT_TRANSACTION";

                $postData["merchant"] = array(
                    "apiKey" => $apiKey,
                    "apiLogin" => $apiLogin
                );

                $signature = md5($apiKey . "~" . $merchantId . "~" . $referenceCode . "~" . $TX_VALUE . "~" . $currency);

                $buyer_full_name = $client->business;
                $buyer_email = $client->email;
                $buyer_document = $client->document;
                $buyer_address = $client->address_invoice;
                $buyer_phone = $client->phone;
                $buyer_city = $client->description;
                $buyer_department = $department->description;


                if (!isset($in["checkbuyer"])) {
                    $city_buyer = \App\Models\Administration\Cities::find($in["city_buyer_id"]);
                    $department_buyer = \App\Models\Administration\Department::find($in["department_buyer_id"]);
                    if ($in["name_buyer"] != '') {
                        $buyer_full_name = $in["name_buyer"];
                    }
                    if ($in["email_buyer"] != '') {
                        $buyer_email = $in["email_buyer"];
                    }
                    if ($in["document_buyer"] != '') {
                        $buyer_document = $in["document_buyer"];
                    }
                    if ($in["addrees_buyer"] != '') {
                        $buyer_address = $in["addrees_buyer"];
                    }
                    if ($in["addrees_buyer"] != '') {
                        $buyer_phone = $in["phone_buyer"];
                    }
                    if ($in["city_buyer_id"] != '') {
                        $buyer_city = $city_buyer->description;
                    }
                    if ($in["department_buyer_id"] != '') {
                        $buyer_department = $department_buyer->description;
                    }
                }

                $payer_fullName = $postData["transaction"] = array("order" => array(
                        "accountId" => $accountId,
                        "referenceCode" => $referenceCode,
                        "description" => "Pago " . $referenceCode,
                        "language" => "es",
                        "signature" => $signature,
//                    "notifyUrl" => "http://localhost:8080/payu/tarjetas_credito.php",
                        "notifyUrl" => "",
                        "additionalValues" => array(
                            "TX_VALUE" => array("value" => $TX_VALUE, "currency" => $currency),
                            "TX_TAX" => array("value" => $TX_TAX, "currency" => $currency),
                            "TX_TAX_RETURN_BASE" => array("value" => $TX_TAX_RETURN_BASE, "currency" => $currency),
                        ),
                        "buyer" => array(
                            "merchantBuyerId" => "1",
                            "fullName" => $buyer_full_name,
                            "emailAddress" => $buyer_email,
                            "contactPhone" => $buyer_phone,
                            "dniNumber" => $buyer_document,
                            "shippingAddress" => array(
                                "street1" => $buyer_address,
//                        "street2" => "5555487",
                                "city" => $buyer_city,
                                "state" => $buyer_department,
                                "country" => $country,
                                "postalCode" => "000000",
                                "phone" => $buyer_phone
                            )
                        ),
                        "shippingAddress" => array(
                            "street1" => $buyer_address,
//                        "street2" => "5555487",
                            "city" => $buyer_city,
                            "state" => $buyer_department,
                            "country" => $country,
                            "postalCode" => "000000",
                            "phone" => $buyer_phone
                        )
                    ),
                    "payer" => array(
                        "merchantPayerId" => $client->id,
                        "fullName" => $client->business,
                        "emailAddress" => $client->email,
                        "contactPhone" => $client->phone,
                        "dniNumber" => $client->document,
                        "billingAddress" => array(
                            "street1" => $client->address_send,
//                        "street2" => "5555487",
                            "city" => $city->description,
                            "state" => $department->description,
                            "country" => $country,
                            "postalCode" => "000000",
                            "phone" => $client->phone
                        )
                    ),
                    "creditCard" => array(
//                "number" => "4097440000000004",
                        "number" => $in["number"],
//                "securityCode" => "321",
                        "securityCode" => $in["crc"],
//                "expirationDate" => "2019/02",
                        "expirationDate" => $in["expirate"],
                        "name" => $in["name"]
                    ),
                    "extraParameters" => array(
                        "INSTALLMENTS_NUMBER" => $in["dues"]
                    ),
                    "type" => "AUTHORIZATION_AND_CAPTURE",
//            "paymentMethod" => "VISA",
                    "paymentMethod" => $type_card["paymentMethod"],
                    "paymentCountry" => $country,
//            "deviceSessionId" => "vghs6tvkcle931686k1900o6e1",
                    "deviceSessionId" => $deviceSessionId,
                    "ipAddress" => $_SERVER["REMOTE_ADDR"],
                    "cookie" => "",
//                "userAgent" => "Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
                    "userAgent" => $_SERVER["HTTP_USER_AGENT"]
                );

//        Log::info(print_r($postData, true));
                $data_string = json_encode($postData);

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Host: sandbox.api.payulatam.com',
                    'Accept:application/json',
                    'Content-Length: ' . strlen($data_string))
                );
//            dd(json_decode($data_string, TRUE));

                $result = curl_exec($ch);

                $arr = json_decode($result, TRUE);

                $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();

                if ($arr["transactionResponse"]["responseCode"] == 'APPROVED') {

                    $row = Departures::find($data_order->header->id);
                    $row->paid_out = true;
                    $row->type_request = "ecommerce";
                    $row->save();

//                    $row_order = Orders::find($order->id);
                    $order->response_payu = json_encode($result);
                    $order->status_id = 2;
                    $order->save();
                    DB::commit();
                    return redirect('congratulations')->with("success", 'Compra Realizada! Orden #' . $arr["transactionResponse"]["orderId"]);
                } else if ($arr["transactionResponse"]["state"] == 'PENDING') {
                    $row = Departures::find($data_order->header->id);
                    $row->paid_out = false;
                    $row->type_request = "ecommerce";
                    $row->save();

                    $order->response_payu = $result;
                    $order->status_id = 3;
                    $order->save();
                    DB::commit();
                    return redirect('congratulations')
                                    ->with("success", 'En un tiempo de aproximado de 4 Horas te llegará la notificación del pago mientras realizamos validaciones de seguridad, gracias por preferirnos, Orden Id # ' . $arr["transactionResponse"]["orderId"])
                                    ->with("order_id", $arr["transactionResponse"]["orderId"]);
                } else {
                    $error = $arr["error"];
                    if ($arr["code"] == 'SUCCESS') {
                        if ($arr["transactionResponse"]["state"] == 'DECLINED') {
                            $error = "Por favor verifique la informacion de la Tarjeta de credito, vuelve a intentarlo. Orden Id #" . $arr["transactionResponse"]["orderId"] . "";
                        } else {
                            $error = $arr["transactionResponse"]["responseMessage"];
                        }
                        DB::rollback();
                    } else {
                        $error = "Tarjeta no aceptada en nuestro Sistema";
                    }

                    return back()->with("error", $error);
                }
            } else {
                return back()->with("error", $error);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(["success" => false], 409);
        }
    }

    public function paymentCredit(Request $req) {
        $in = $req->all();

        $this->processPayment($in["order_id"]);
    }

    public function processPayment($id) {
//        $order = Orders::where("status_id", 1)->where("stakeholder_id", Auth::user()->id)->first();
        $order = Orders::where("status_id", 1)->where("id", $id)->first();

        $stake = Stakeholder::find($order->stakeholder_id);

        dd($stake);

        $sql = "SELECT p.title product,d.product_id,d.order_id,sum(d.quantity) quantity,sum(d.quantity * d.value) total,p.image
                            FROM orders_detail d
                            JOIN products p ON p.id=d.product_id
                            WHERE order_id=$order->id
                            GROUP BY 1,2,3,product_id,p.image";

        $detail = DB::select($sql);
        $detail = json_decode(json_encode($detail), true);

        $user = \App\Models\Security\Users::find(Auth::user()->id);

        $cli = \App\Models\Administration\Stakeholder::where("document", $user->document)->first();

        $header["warehouse_id"] = 3;
        $header["responsible_id"] = 1;
        $header["city_id"] = 1;
        $header["created"] = date("Y-m-d H:i");
        $header["client_id"] = $cli->id;
        $header["destination_id"] = 1;
        $header["address"] = "adress";
        $header["phone"] = "phone";
        $header["status_id"] = 1;
        $header["shipping_cost"] = 0;
        $header["type_request"] = "ecommerce";

        $this->depObj->processDeparture($header, $detail);
        \Session::flash('success', 'Compra Realizada con exito');

        $order->status_id = 2;
        $order->save();

        return redirect('ecommerce/0')->with("success", 'Payment success');
    }

    public function payu(Request $req) {
        $pet = '{
                    "test": false,
                    "language": "en",
                    "command": "PING",
                    "merchant": {
                       "apiLogin": "pRRXKOl8ikMmt9u",
                       "apiKey": "4Vj8eK4rloUd272L48hsrarnUA"
                    }
                    }';


        $data = json_decode($pet, true);

        $pet2 = json_encode($data);


        $ch = curl_init("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
//a true, obtendremos una respuesta de la url, en otro caso, 
//true si es correcto, false si no lo es
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HEADER, array('Accept:application/json', 'Content-Type: application/json', 'Content-Length: ' . strlen($pet2)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//establecemos el verbo http que queremos utilizar para la petición
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//enviamos el array data
        curl_setopt($ch, CURLOPT_POSTFIELDS, $pet2);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, build_query($data));
//obtenemos la respuesta
        $response = curl_exec($ch);

        curl_close($ch);

        print_r($response);
        exit;
    }

    public function deleteItem(Request $req, $id) {
        $input = $req->all();
        OrdersDetail::where("order_id", $id)->where("product_id", $input["product_id"])->delete();

        return response()->json(["status" => true, "order" => $id]);
    }

}