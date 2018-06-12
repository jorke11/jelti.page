<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
     protected $table = "orders";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "insert_id", 
        "response_payu",
        "status_id"];
}
