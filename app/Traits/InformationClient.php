<?php

namespace App\Traits;

use DB;
use Auth;

trait InformationClient {

    public function __construct() {
        
    }

    public function numberVerification($document) {
        $vpri = [];
        $x = '';
        $y = '';
        $z = '';

        $document = preg_replace("/\s/", '', $document); // Espacios
        $document = preg_replace("/-/", '', $document); // Guiones
        $document = preg_replace("/\./", '', $document); // Espacios
        $document = preg_replace("/\,/", '', $document); // Espacios

        if (!is_numeric($document)) {
            return false;
        }

// Procedimiento

        $z = strlen($document);
        $vpri[1] = 3;
        $vpri[2] = 7;
        $vpri[3] = 13;
        $vpri[4] = 17;
        $vpri[5] = 19;
        $vpri[6] = 23;
        $vpri[7] = 29;
        $vpri[8] = 37;
        $vpri[9] = 41;
        $vpri[10] = 43;
        $vpri[11] = 47;
        $vpri[12] = 53;
        $vpri[13] = 59;
        $vpri[14] = 67;
        $vpri[15] = 71;
        $x = 0;
        $y = 0;
        for ($i = 0; $i < $z; $i++) {
            $y = (substr($document, $i, 1));
            $x += ($y * $vpri[$z - $i]);
        }

        $y = $x % 11;

        return ($y > 1) ? 11 - $y : $y;
    }

    public function informationRequired($client) {
        
        $error = [];
        if (is_null($client->type_regime_id)) {
            $error["type_regime_id"] = false;
        }
        if (is_null($client->type_person_id)) {
            $error["type_person_id"] = false;
        }
        if (is_null($client->type_person_id)) {
            $error["type_person_id"] = false;
        }
        if (is_null($client->invoice_city_id)) {
            $error["invoice_city_id"] = false;
        }
        if (is_null($client->address_invoice)) {
            $error["address_invoice"] = false;
        }
        if (is_null($client->send_city_id)) {
            $error["send_city_id"] = false;
        }
        if (is_null($client->address_send)) {
            $error["address_send"] = false;
        }

        return $error;
    }

}
