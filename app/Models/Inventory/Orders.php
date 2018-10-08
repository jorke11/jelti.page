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
        "daparture_id",
        "discount",
        "status_id",
        "referencecode",
        "last_executed",
        "amounted_consulted"
    ];
    protected $casts = [
        'response_payu' => 'array'
    ];

    public function detail() {
        return $this->hasMany(OrdersDetail::class, "order_id");
    }

    public function departure() {
        return $this->hasOne(Departures::class, "id", "departure_id");
    }

}
