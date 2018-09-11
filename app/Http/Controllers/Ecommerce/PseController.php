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

class PseController extends Controller {

    use Invoice;

    public $client;
    public $categories;

    public function __construct() {
        $this->client = '';

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
                        ->where(function($query) {
                            $query->whereNull("node_id")
                            ->OrWhere("node_id", 0)->orderBy("order", "asc");
                        })->get();
    }

    public function index() {
        $this->client = Stakeholder::where("email", Auth::user()->email)->first();
        $term = 2;
        $month = array();
        $years = array();
        $categories = array();
        $dietas = $this->dietas;
        $countries = [
                ["code" => "CO", "description" => "Colombia"]
        ];

        $data = $this->getDataPayment();

        $data_order = $this->createOrder();

        $banks = $this->getListBanks();
        $type_client = [
                ["id" => "N", "description" => "Persona Natura"],
                ["id" => "J", "description" => "Persona Juridica"]
        ];


        $type_document = [
                ["id" => "CC", "description" => "Cédula de ciudadanía"],
                ["id" => "CE", "description" => "Cédula de extranjería"],
                ["id" => "NIT", "description" => "Número de Identificación Tributario"],
                ["id" => "TI", "description" => "Tarjeta de Identidad"],
                ["id" => "IDC", "description" => "Identificador único de cliente, para el caso de ID’s únicos de clientes/usuarios de servicios públicos"],
                ["id" => "CEL", "description" => "En caso de identificarse a través de la línea del móvil"],
                ["id" => "RC", "description" => "Registro civil de nacimiento"],
                ["id" => "DE", "description" => "Documento de identificación extranjeroo"],
        ];

        $total = "$" . number_format(round($data_order["header"]["total"]), 0, ",", ".");
        $subtotal = "$" . number_format(round($data_order["header"]["subtotal"]), 0, ",", ".");

        $client = $this->client;


        $deviceSessionId = $data["deviceSessionId"];
        $deviceSessionId_concat = $data["deviceSessionId_concat"];


        return view("Ecommerce.pse.init", compact("subtotal", "total", "client", "countries", "month", "years", "term", "categories", "dietas", "banks", "type_client", "type_document", "deviceSessionId", "deviceSessionId_concat"));
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

       $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
       $url_ch = 'sandbox.api.payulatam.com';

        /* $url = "https://api.payulatam.com/payments-api/4.0/service.cgi";
        $url_ch = 'api.payulatam.com'; */

        //Production
        /* $apiKey = "ADme595Qf4r43tjnDuO4H33C9F";
        $apiLogin = "tGovZHuhL97hNh7"; */

        //test
       $apiLogin = "pRRXKOl8ikMmt9u";
       $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";


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
                "apiKey" => $apiKey]
        );



        $data_string = json_encode($postData);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json;',
            'Host: ' . $url_ch,
            'Accept:application/json',
            'Content-Length: ' . strlen($data_string))
        );


        $result = curl_exec($ch);
        $arr = json_decode($result, TRUE);

        return $arr["banks"];
    }

    public function createOrder() {
        $row = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();
        $user = Users::find(Auth::user()->id);

        $client = Stakeholder::find($user->stakeholder_id);

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
        $param["header"]["insert_id"] = Auth::user()->id;
        $param["header"]["order_id"] = $row->id;
        $param["detail"] = $this->formatDetailOrder($row);
        $param["header"]["total"] = $this->total;
        $param["header"]["subtotal"] = $this->subtotal;
        $param["header"]["tax19"] = $this->tax19;
        $param["header"]["tax5"] = $this->tax5;
//        
        return $param;
    }

    public function payment(Request $req) {
        $in = $req->all();
        $client = Stakeholder::where("email", Auth::user()->email)->first();
        $country = $in["country_id"];

        //Production
        /* $url = "https://api.payulatam.com/payments-api/4.0/service.cgi";
        $host="api.payulatam.com";
        $apiKey = "ADme595Qf4r43tjnDuO4H33C9F";
        $apiLogin = "tGovZHuhL97hNh7";
        $merchantId = "559634";
        $accountId = "562109"; */

        //Test
        $url = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
        $host="sandbox.api.payulatam.com";
        $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
        $apiLogin = "pRRXKOl8ikMmt9u";
        $merchantId = 508029;
        $accountId = 512321;

        $referenceCode = 'invoice_' . microtime();
        $currency = "COP";

        $data_order = $this->createOrder();

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
                        "emailAddress" => $buyer_email
                    ]
                ],
                "payer" => [
                    "fullName" => $client->business,
                    "emailAddress" => $client->email,
                    "contactPhone" => $client->phone
                ],
                "extraParameters" => [
                    "RESPONSE_URL" => "http://localhost:8000/confirmation",
                    "PSE_REFERENCE1" => "127.0.0.1",
//                    "FINANCIAL_INSTITUTION_CODE" => "1007",
                    "FINANCIAL_INSTITUTION_CODE" => $in["bank"],
//                    "USER_TYPE" => "N",
                    "USER_TYPE" => $in["type_client"],
//                    "PSE_REFERENCE2" => "CC",
                    "PSE_REFERENCE2" => $in["type_document"],
                    "PSE_REFERENCE3" => $in["document"],
//                    "PSE_REFERENCE3" => "123456789"
                ],
                "type" => "AUTHORIZATION_AND_CAPTURE",
                "paymentMethod" => "PSE",
                "paymentCountry" => $country,
                "ipAddress" => $_SERVER["REMOTE_ADDR"],
                "cookie" => "pt1t38347bs6jc9ruv2ecpv7o2",
                "userAgent" => $_SERVER["HTTP_USER_AGENT"]
            ],
        ];

        Log::debug("REQUEST TO PAY PSE: " . print_r($postData, true));

//        dd($postData);

        $data_string = json_encode($postData);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Host: '.$host,
            'Accept:application/json',
            'Content-Length: ' . strlen($data_string))
        );


        $result = curl_exec($ch);

        $arr = json_decode($result, TRUE);

        Log::debug("RESPONSE TO PAY PSE: " . print_r($arr, true));


        
        if ($arr["code"] == 'SUCCESS') {
            if ($arr["transactionResponse"]["pendingReason"] == 'AWAITING_NOTIFICATION') {
                return Redirect::to($arr["transactionResponse"]["extraParameters"]["BANK_URL"]);
            }else{
                echo "No paso de response";    
                dd($arr);
            }
        }else{
            echo "No paso de success";
            dd($arr);
        }
    }

    public function confirmation(){
        $data = $_GET;
        dd($data);

        if($data["lapTransactionState"]=='PENDING'){
            $data["status"]=""
        }else{
            $data["status"]=""
        }

        return view("Ecommerce.pse.confirmation",compact("data"));
    }

}
