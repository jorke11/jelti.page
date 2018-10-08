<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administration\Stakeholder;
use App\Models\Inventory\Orders;
use App\Models\Security\Users;
use App\Models\Administration\Categories;
use Auth;
use App\Traits\Invoice;
use Log;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Sales\DepartureController;
use App\Http\Controllers\Ecommerce\PaymentController;
use DB;

class PseController extends Controller {

    use Invoice;

    public $depObj;
    public $oayObj;
    public $client;
    public $test;
    public $categories;

    public function __construct() {
        $this->middleware("auth");
        $this->client = '';
        $this->test = true;

        $this->depObj = new DepartureController();
        $this->payObj = new PaymentController();

        $this->dietas = array(
            (object) array("id" => 1, "description" => "Paleo", "slug" => "paleo"),
            (object) array("id" => 2, "description" => "Vegano", "slug" => "vegano"),
            (object) array("id" => 3, "description" => "Sin gluten", "slug" => "sin_gluten"),
            (object) array("id" => 4, "description" => "Organico", "slug" => "organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans", "slug" => "sin_grasas_trans"),
            (object) array("id" => 6, "description" => "Sin azucar", "slug" => "sin_azucar"),
        );
        $this->categories = Categories::where("status_id", 1)
                        ->where("type_category_id", 1)
                        ->where(function ($query) {
                            $query->whereNull("node_id")
                            ->OrWhere("node_id", 0)->orderBy("order", "asc");
                        })->get();
    }

    public function index() {
        $this->client = Stakeholder::where("email", Auth::user()->email)->first();
        $term = 2;
        $month = array();
        $years = array();
        $categories = $this->categories;
        $dietas = $this->dietas;
        $countries = [
                ["code" => "CO", "description" => "Colombia"]
        ];

        $data = $this->getDataPayment();

        $data_order = $this->dataCart();


        $banks = $this->getListBanks();
        $type_client = [
                ["id" => "N", "description" => "Persona Natural"],
                ["id" => "J", "description" => "Persona Jurídica"]
        ];


        $type_document = [
                ["id" => "CC", "description" => "Cédula de ciudadanía"],
                ["id" => "CE", "description" => "Cédula de extranjería"],
                ["id" => "NIT", "description" => "Número de Identificación Tributario"],
                ["id" => "TI", "description" => "Tarjeta de Identidad"],
                ["id" => "IDC", "description" => "Identificador único de cliente, para el caso de ID’s únicos de clientes/usuarios de servicios públicos"],
                ["id" => "CEL", "description" => "En caso de identificarse a través de la línea del móvil"],
                ["id" => "RC", "description" => "Registro civil de nacimiento"],
                ["id" => "DE", "description" => "Documento de identificación extranjero"],
        ];

        $total = "$" . number_format(round($data_order["total"]), 0, ",", ".");
        $subtotal = "$" . number_format(round($data_order["subtotal"]), 0, ",", ".");

        $client = $this->client;


        $deviceSessionId = $data["deviceSessionId"];
        $deviceSessionId_concat = $data["deviceSessionId_concat"];

        return view("Ecommerce.pse.init", compact("subtotal", "total", "client", "countries", "month", "years", "term", "categories", "dietas", "banks", "type_client", "type_document", "deviceSessionId", "deviceSessionId_concat"));
    }

    public function dataCart() {

        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();

        $current = \App\Models\Inventory\OrdersDetail::select("orders.created_at", DB::raw("round(sum(vproducts.price_sf * orders_detail.quantity * orders_detail.units_sf)) subtotal"), DB::raw("round(sum(vproducts.price_sf_with_tax * orders_detail.quantity * orders_detail.units_sf)) total"))
                ->join("orders", "orders.id", "orders_detail.order_id")
                ->join("vproducts", "vproducts.id", "orders_detail.product_id")
                ->where("order_id", $order->id)
                ->groupBy("orders.created_at")
                ->first();

        return $current;
    }

    public function getDataPayment() {
        $data = [];

        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();

        $user = Users::find($order->insert_id);

        $data["client"] = Stakeholder::find($user->stakeholder_id);

        $detail = $this->formatDetailOrder($order);

        $data["countries"][] = array("code" => "CO", "description" => "Colombia");

        $deviceSessionId = md5(session_id() . microtime());

        $data["categories"] = $this->categories;

        $data["id"] = 0;
        $data["term"] = $data["client"]->term;
        $data["total"] = "$ 0";
        $data["subtotal"] = "$ 0";

        $deviceSessionId_concat = $deviceSessionId . "80200";
        $data["deviceSessionId"] = $deviceSessionId;
        $data["deviceSessionId_concat"] = $deviceSessionId_concat;

        if ($detail) {
            $data["id"] = $order->id;
            $data["term"] = $data["client"]->term;
            $data["total"] = "$" . number_format($this->total, 0, ",", ".");
            $data["subtotal"] = "$" . number_format($this->subtotal, 0, ",", ".");
        }

        return $data;
    }

    public function getListBanks() {
//        $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
//        $host = "sandbox.api.payulatam.com";
//        $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
//        $apiLogin = "pRRXKOl8ikMmt9u";

        $url = "https://api.payulatam.com/payments-api/4.0/service.cgi";
        $host = 'api.payulatam.com';
        $apiKey = "ADme595Qf4r43tjnDuO4H33C9F";
        $apiLogin = "tGovZHuhL97hNh7";

        /*

          /* if ($this->test) {
          $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
          $host = 'sandbox.api.payulatam.com';
          $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
          $apiLogin = "pRRXKOl8ikMmt9u";
          } else {
          $url = "https://api.payulatam.com/payments-api/4.0/service.cgi";
          $host = 'api.payulatam.com';
          $apiKey = "ADme595Qf4r43tjnDuO4H33C9F";
          $apiLogin = "tGovZHuhL97hNh7";
          } */

        $postData = array(
            "test" => false,
            "language" => "es",
            "command" => "GET_BANKS_LIST",
            "bankListInformation" => [
                "paymentMethod" => "PSE",
                "paymentCountry" => "CO"
            ],
            "merchant" => [
                "apiLogin" => $apiLogin,
                "apiKey" => $apiKey
            ]
        );

        $data_string = json_encode($postData);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json;',
            'Host: ' . $host,
            'Accept:application/json',
            'Content-Length: ' . strlen($data_string))
        );


        $result = curl_exec($ch);
        $arr = json_decode($result, true);

        if ($arr["code"] == 'ERROR') {
            $error = "Problemas con la plataforma de PSE";
            return redirect('payment')->with("error", $error);
        }

        return $arr["banks"];
    }

    public function payment(Request $req) {
        $in = $req->all();

        if ($in["bank"] == 0) {
            return back()->with("error", "Selecciona el Banco")
                            ->with("name_headline", $in["name_headline"])
                            ->with("type_document", $in["type_document"])
                            ->with("document", $in["document"])
                            ->with("phone_headline", $in["phone_headline"])
                            ->with("type_client", $in["type_client"]);
        }

        $client = Stakeholder::where("email", Auth::user()->email)->first();
        $country = $in["country_id"];

//        $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
//        $host = "sandbox.api.payulatam.com";
//        $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
//        $apiLogin = "pRRXKOl8ikMmt9u";
//        $merchantId = 508029;
//        $accountId = 512321;
//        $url_response = 'http://localhost:8000/confirmation';

        $url = "https://api.payulatam.com/payments-api/4.0/service.cgi";
        $host = "api.payulatam.com";
        $apiKey = "ADme595Qf4r43tjnDuO4H33C9F";
        $apiLogin = "tGovZHuhL97hNh7";
        $merchantId = "559634";
        $accountId = "562109";
        $url_response = 'https://superfuds.com/confirmation';


        $data_order = $this->createOrder();
        $referenceCode = 'order_id_' . $data_order["header"]["order_id"];

        $currency = "COP";

        $TX_VALUE = round($data_order["header"]["total"]);
        $TX_TAX = 0;
        $TX_TAX_RETURN_BASE = 0;

        $signature = md5($apiKey . "~" . $merchantId . "~" . $referenceCode . "~" . $TX_VALUE . "~" . $currency);

        $buyer_email = $client->email;

        $postData = [
            "language" => "es",
            "command" => "SUBMIT_TRANSACTION",
            "test" => false,
            "merchant" => [
                "apiKey" => $apiKey,
                "apiLogin" => $apiLogin
            ],
            "transaction" => [
                "order" => [
                    "accountId" => $accountId,
                    "referenceCode" => $referenceCode,
                    "description" => "Pago " . $referenceCode,
                    "language" => "es",
                    "signature" => $signature,
                    "notifyUrl" => "",
                    "additionalValues" => [
                        "TX_VALUE" => ["value" => $TX_VALUE, "currency" => $currency],
                        "TX_TAX" => ["value" => $TX_TAX, "currency" => $currency],
                        "TX_TAX_RETURN_BASE" => ["value" => $TX_TAX_RETURN_BASE, "currency" => $currency],
                    ],
                    "buyer" => [
                        "emailAddress" => $buyer_email,
                        "fullName" => $in["name_headline"],
                        "contactPhone" => $in["phone_headline"],
                        "shippingAddress" => [
                            "street1" => $client->address_send,
                            "street2" => $client->address_invoice,
                            "city" => $client->city->description,
                            "state" => $client->city->department->description,
                            "country" => "CO",
                            "postalCode" => "0000000",
                            "phone" => $client->phone
                        ]
                    ]
                ],
                "payer" => [
                    "fullName" => $client->business,
                    "emailAddress" => $client->email,
                    "contactPhone" => $client->phone,
                ],
                "extraParameters" => [
                    "RESPONSE_URL" => $url_response,
                    "PSE_REFERENCE1" => request()->ip(),
                    "FINANCIAL_INSTITUTION_CODE" => $in["bank"],
                    "USER_TYPE" => $in["type_client"],
                    "PSE_REFERENCE2" => $in["type_document"],
                    "PSE_REFERENCE3" => $in["document"],
                ],
                "type" => "AUTHORIZATION_AND_CAPTURE",
                "paymentMethod" => "PSE",
                "paymentCountry" => $country,
                "ipAddress" => $_SERVER["REMOTE_ADDR"],
                "cookie" => "pt1t38347bs6jc9ruv2ecpv7o2",
                "userAgent" => $_SERVER["HTTP_USER_AGENT"]
            ],
        ];

//        dd($postData);

        Log::debug("REQUEST TO PAY PSE: " . print_r($postData, true));

//        dd($postData);

        $data_string = json_encode($postData);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
                $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Host: ' . $host,
            'Accept:application/json',
            'Content-Length: ' . strlen($data_string))
        );


        $result = curl_exec($ch);

        $arr = json_decode($result, true);

        Log::debug("RESPONSE TO PAY PSE: " . print_r($arr, true));

        if ($arr["code"] == 'SUCCESS') {
            if ($arr["transactionResponse"]["pendingReason"] == 'AWAITING_NOTIFICATION') {
                $order = Orders::find($data_order["header"]["order_id"]);
                $order->referencecode = $referenceCode;
                $order->status_id = 3;
                $order->save();
                return Redirect::to($arr["transactionResponse"]["extraParameters"]["BANK_URL"]);
            } else {
                echo "No paso de response";
                dd($arr);
            }
        } else {
            echo "No paso de success";
            dd($arr);
        }
    }

    public function confirmation() {
        $data = $_GET;
        $order = Orders::where("insert_id", Auth::user()->id)->where("status_id", 1)->first();


        if ($order == null) {
            return redirect('/');
        }

        if ($data["transactionState"] == 4) {
            $data["message"] = "Pago Realizado Orden Id #" . $data["transactionId"];
            $data["order"] = $order;

            $data_order = $this->payObj->createOrder();
            $dep = $this->depObj->processDeparture($data_order["header"], $data_order["detail"])->getData();
            $row = \App\Models\Inventory\Departures::find($dep->header->id);
            $row->paid_out = true;
            $row->status_briefcase_id = 1;
            $row->type_request = "pse";
            $row->save();

            $order->response_payu = $_GET;
            $order->status_id = 2;
            $order->departure_id = $dep->header->id;
            $order->save();
        } else if ($data["transactionState"] == 7) {
            $data["message"] = "En un tiempo de aproximado de 4 Horas te llegará la notificación del pago mientras realizamos validaciones de seguridad, gracias por preferirnos, Orden Id # " . $data["transactionId"];
            $data["order"] = $order;

            $data_order = $this->payObj->createOrder();
            $dep = $this->depObj->processDeparture($data_order["header"], $data_order["detail"])->getData();

            $row = \App\Models\Inventory\Departures::find($dep->header->id);
            $row->status_briefcase_id = 2;
            $row->type_request = "pse";
            $row->save();

            $order->response_payu = $_GET;
            $order->status_id = 3;
            $order->departure_id = $dep->header->id;
            $order->save();
        } else {
            $data["message"] = "No se ha podido realizar la transaccion por favor vuelva a intentar, Orden Id #" . $data["transactionId"];
            $data["order"] = $order;
        }

        if ($data["polTransactionState"] == 4 && $data["polResponseCode"] == 1) {
            $data["state"] = "Transacción aprobada";
        } else if ($data["polTransactionState"] == 6 && $data["polResponseCode"] == 5) {
            $data["state"] = "Transacción fallida";
        } else if (($data["polTransactionState"] == 12 || $data["polTransactionState"] == 14) && $data["polResponseCode"] >= 25) {
            $data["state"] = "Transacción pendiente, por favor revisar si el débito fue realizado en el banco.";
        } else {
            $data["state"] = "Transacción cancelada.";
        }

        $categories = $this->categories;
        $dietas = $this->dietas;

        return view("Ecommerce.pse.confirmation", compact("data", "categories", "dietas"));
    }

    public function createOrder() {
        $row = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();
        $user = Users::find(Auth::user()->id);

        $client = Stakeholder::find($user->stakeholder_id);

        $param["header"]["warehouse_id"] = 3;
        $param["header"]["responsible_id"] = ($client->responsible_id == null) ? 1 : $client->responsible_id;
        $param["header"]["city_id"] = $client->city_id;
        $param["header"]["created"] = date("Y-m-d H:i");
        $param["header"]["status_id"] = 1;
        $param["header"]["client_id"] = $user->stakeholder_id;
        $param["header"]["destination_id"] = $client->city_id;
        $param["header"]["address"] = $client->address_send;
        $param["header"]["phone"] = $client->phone;
        $param["header"]["shipping_cost"] = 0;
        $param["header"]["insert_id"] = Auth::user()->id;
//        $new["type_insert_id"] = 2;
        $param["header"]["order_id"] = $row->id;
        $param["detail"] = $this->formatDetailOrder($row);
        $param["header"]["total"] = $this->total;
        $param["header"]["tax19"] = $this->tax19;
        $param["header"]["tax5"] = $this->tax5;
//        
        return $param;
    }

    public function finishPurchase() {
        $data = $_GET;
        return redirect('congratulations')->with("success", 'Compra Realizada! Orden #' . $data["transactionId"]);
    }

    public function voucher() {
        $data["data"] = $_GET;

        if ($data["data"]["polTransactionState"] == 4 && $data["data"]["polResponseCode"] == 1) {

            $data["data"]["state"] = "Transacción aprobada";
        } else if ($data["data"]["polTransactionState"] == 6 && $data["data"]["polResponseCode"] == 5) {
            $data["data"]["state"] = "Transacción fallida";
        } else if (($data["data"]["polTransactionState"] == 12 || $data["data"]["polTransactionState"] == 14) && $data["data"]["polResponseCode"] >= 25) {
            $data["data"]["state"] = "Transacción pendiente, por favor revisar si el débito fue realizado en el banco.";
        }

        $pdf = \PDF::loadView('Ecommerce.pse.voucher', [], $data, [
                    'title' => 'Vouche',
                    'margin_top' => -12, "margin_bottom" => 1]);

        header('Content-Type: application/pdf');
        return $pdf->stream('voucher.pdf');
    }

}
