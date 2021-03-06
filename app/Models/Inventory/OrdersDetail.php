<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class OrdersDetail extends Model {

    protected $table = 'orders_detail';
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "order_id",
        "product_id",
        "quantity",
        "units_sf",
        "tax",
        "price_sf"
    ];

    public function order() {
        return $this->belongsTo(Orders::class);
    }

    public function product() {
        return $this->hasOne(\App\Models\Administration\Products::class, "product_id");
    }

}
