<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Departures extends Model {

    protected $table = "departures";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "responsible_id",
        "branch_id",
        "city_id",
        "client_id",
        "warehouse_id",
        "created",
        "destination_id",
        "address",
        "phone",
        "status_id",
        "shipping_cost",
        "invoice",
        "description",
        "paid_out",
        "transport",
        "insert_id",
        "update_id",
        "outstanding",
        "remission",
        "discount",
        "type_request",
        "responsible",
        'insert_id',
        'type_insert_id',
        "order_id",
        "purchase_order",
        "date_appointment",
        "quantity",
        "quantity_packaging",
        "status_briefcase_id"
    ];

}
