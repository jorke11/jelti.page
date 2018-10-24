<?php

namespace App\Traits;

use DB;
use Auth;

trait Utils {

    public function __construct() {
        
    }

    function splitArray($arr, $number) {
        $res = [];
        $cont = 0;
        foreach ($arr as $i => $val) {
            $res[$cont][] = $val;
            if (($i + 1) % $number == 0) {
                $cont++;
            }
        }

        return $res;
    }

}
