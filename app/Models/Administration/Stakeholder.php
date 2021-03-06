<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model {

    protected $table = "stakeholder";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "name",
        "last_name",
        "document",
        "verification",
        "email",
        "address",
        "phone",
        "contact",
        "phone_contact",
        "term",
        "city_id",
        "status_id",
        "invoice_city_id",
        "stakeholder_id",
        "responsible_id",
        "address_send",
        "address_invoice",
        "shipping_cost",
        "special_price",
        "web_site",
        "type_regime_id",
        "type_person_id",
        "type_document",
        "business_name",
        "business",
        "lead_time",
        "user_insert",
        "user_update",
        "send_city_id",
        "sector_id",
        "password",
        "login_web",
        "exclude_report",
        "type_stakeholder_id"
    ];
    protected $casts = [
        'type_stakeholder_id' => 'json'
    ];

    public function Product() {
        return $this->hasMany(Products::class, "supplier_id");
    }

    public function city() {
        return $this->hasOne(Cities::class, "id", "city_id");
    }

    public function user() {
        return $this->belongsTo(\App\Models\Security\Users::class);
    }

}
