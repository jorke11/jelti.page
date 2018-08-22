<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model {

    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description", "short_description", "order", "status_id", "type_category_id", "node_id"];

    public function product() {
        return $this->belongsTo(Products::class);
    }

}
