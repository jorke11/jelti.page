<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Characteristic extends Model {

    protected $table = "products_characteristic";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description", "type_subcategory_id", "order", "status_id", "img", "alternative", "slug"];

    use Sluggable,
        SluggableScopeHelpers;

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'description'
            ]
        ];
    }

}
