<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {

    protected $table = "coupons";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "stakeholder_id",
        "amount",
        "description",
        "status_id",
    ];
    
    

}
