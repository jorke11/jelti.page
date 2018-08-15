<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Products extends Model {

    protected $table = "products";
    protected $primaryKey = 'id';
    protected $fillable = [
        "id",
        "category_id",
        "supplier_id",
        "title",
        "description",
        "short_description",
        "reference",
        "units_supplier",
        "units_sf",
        "cost_sf",
        "tax",
        "price_sf",
        "url_part",
        "bar_code",
        "status_id",
        "meta_title",
        "meta_keywords",
        "meta_description",
        "minimum_stock",
        "characteristic",
        "account_id",
        "packaging",
        "update_id",
        "type_product_id",
        "warehouse",
        "pvp",
        "is_new",
        "about",
        "why",
        "ingredients",
        "measure_product",
        "measure_box",
        "measure_master",
        "content_product",
        "expire_month"
    ];
    protected $casts = [
        'characteristic' => 'array',
    ];
    public $timestamp = false;

    use Sluggable,
        SluggableScopeHelpers;

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function images() {
        return $this->hasMany(ProductsImage::class, "product_id");
//         return $this->hasMany(ProductsImage::class, "id","product_id");
    }

    public function comment() {
        return $this->hasMany(ProductsComment::class, "product_id");
//         return $this->hasMany(ProductsImage::class, "id","product_id");
    }

    public function is_like() {
        return $this->hasOne(ProductsLike::class, "product_id", "id");
    }

    public function supplier() {
        return $this->belongsTo(Stakeholder::class, "supplier_id");
    }
    public function orderDetail() {
        return $this->belongsTo(\App\Models\Inventory\OrdersDetail::class, "product_id");
    }

}
