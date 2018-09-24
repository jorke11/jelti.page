<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CronController extends Controller {

    public function loadPending() {
        $url = "https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
        $host = "sandbox.api.payulatam.com";
        $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
        $apiLogin = "pRRXKOl8ikMmt9u";

        /* $url = "https://api.payulatam.com/payments-api/4.0/service.cgi";
          $host = 'api.payulatam.com';
          $apiKey = "ADme595Qf4r43tjnDuO4H33C9F";
          $apiLogin = "tGovZHuhL97hNh7"; */



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


        $pedding = \App\Models\Inventory\Orders::where("status_id", 3)->get();

        foreach ($pedding as $value) {
            
            $postData = [
                "test" => false,
                "language" => "en",
                "command" => "ORDER_DETAIL_BY_REFERENCE_CODE",
                "merchant" => [
                    "apiLogin" => $apiLogin,
                    "apiKey" => $apiKey
                ],
                "details" => [
                    "referenceCode" => $value->response_payu["referenceCode"]
                ]
            ];

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
            var_dump($arr);
            echo $arr["result"]["payload"]["transactions"][0]["transactionResponse"]["state"];
            
            dd($arr);
        }
    }

}
