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
        "value"
    ];

}
