<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable {

    use Notifiable;

    protected $table = "users";
    protected $primaryKey = "id";
    protected $fillable = ["id", "name", "last_name", "email", "city_id",
        "stakeholder_id", "role_id", "status_id",
        "password", "remember_token", "document", "warehouse_id", "alias"];

    public function comment() {
        return $this->belongsTo(\App\Models\Administration\ProductsComment::class, "user_id");
    }

    public function stakeholder() {
        return $this->hasOne(\App\Models\Administration\Stakeholder::class, "id", "stakeholder_id");
    }

}
