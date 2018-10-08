<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sales\DepartureController;
use App\Http\Controllers\Ecommerce\PaymentController;
use App\Traits\Payment;
use Log;

class CronController extends Controller {

    use Payment;

    public $depObj;
    public $oayObj;

    public function loadPending() {
//        $url = "https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
//        $host = "sandbox.api.payulatam.com";
//        $apiKey = "4Vj8eK4rloUd272L48hsrarnUA";
//        $apiLogin = "pRRXKOl8ikMmt9u";

        $url = "https://api.payulatam.com/reports-api/4.0/service.cgi";
        $host = 'api.payulatam.com';
        $apiKey = "ADme595Qf4r43tjnDuO4H33C9F";
        $apiLogin = "tGovZHuhL97hNh7";



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

        if (count($pedding) > 0) {
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
                        "referenceCode" => $value->referencecode
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

                if ($arr["code"] == 'SUCCESS') {
                    if ($arr["result"]["payload"][0]["transactions"][0]["transactionResponse"]["state"] == 'APPROVED') {
                        $data_order = $this->createOrder($value->insert_id, $value->id);
                        Log::debug("PSE CREATED : " . print_r($data_order, true));

//                    $dep = $this->depObj->processDeparture($data_order["header"], $data_order["detail"])->getData();
                        $dep = $this->createDeparture($data_order["header"], $data_order["detail"])->getData();
                        $row = \App\Models\Inventory\Departures::find($dep->header->id);
                        $row->paid_out = true;
                        $row->status_briefcase_id = 1;
                        $row->type_request = "pse";
                        $row->save();

                        $value->status_id = 2;
                        $value->departure_id = $dep->header->id;
                        $value->save();
                        echo "Approved";
                    }
                } else {
                    $value->last_executed = date("Y-m-d H:i");
                    $value->amounted_consulted = $value->amounted_consulted + 1;
                    $value->save();
                }
            }
        } else {
            echo "No hay pagos pendientes";
        }
    }

}
