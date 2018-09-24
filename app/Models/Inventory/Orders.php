<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {

    protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "insert_id",
        "response_payu",
        "discount",
        "status_id"
    ];
    protected $casts = [
        'response_payu' => 'array'
    ];

    public function detail() {
        return $this->hasMany(OrdersDetail::class, "order_id");
    }

}
