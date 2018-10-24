<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class CouponClient extends Model {

    protected $table = "coupons_client";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "stakeholder_id",
        "coupon_id",
        "order_id",
        "status_id",
    ];

}
