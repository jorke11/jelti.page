<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class ProductsComment extends Model {

    protected $table = "products_comment";
    protected $primaryKey = 'id';
    protected $fillable = [
        "id",
        "product_id",
        "user_id",
        "text",
        "answer_id",
        "comment",
        "subject",
    ];

    public function product() {
        return $this->hasOne(Products::class);
    }

    public function user() {
        return $this->hasOne(\App\Models\Security\Users::class, "id", "user_id");
    }

    public function is_like() {
        return $this->hasOne(ProductsCommentLike::class, "comment_id", "id");
    }

}
