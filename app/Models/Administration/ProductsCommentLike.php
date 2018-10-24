<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class ProductsCommentLike extends Model {

    protected $table = "products_comment_like";
    protected $primaryKey = 'id';
    protected $fillable = [
        "id",
        "comment_id",
        "user_id",
    ];

    public function comment() {
        return $this->belongsTo(ProductsComment::class);
    }

}
