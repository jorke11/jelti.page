<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class ProductsLike extends Model {

    protected $table = "products_like";
    protected $primaryKey = 'id';
    protected $fillable = [
        "id",
        "product_id",
        "user_id",
    ];

    public function product() {
        return $this->hasOne(Products::class,"id","product_id");
    }

}
