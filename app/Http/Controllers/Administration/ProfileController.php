<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class ProfileController extends Controller {

    public $dietas;
    public $categories;

    public function __construct() {
        $this->middleware("auth");
        $this->dietas = array(
            (object) array("id" => 1, "description" => "Paleo", "slug" => "paleo"),
            (object) array("id" => 2, "description" => "Vegano", "slug" => "vegano"),
            (object) array("id" => 3, "description" => "Sin gluten", "slug" => "sin_gluten"),
            (object) array("id" => 4, "description" => "Organico", "slug" => "organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans", "slug" => "sin_grasas_trans"),
            (object) array("id" => 6, "description" => "Sin azucar", "slug" => "sin_azucar"),
        );
        $this->categories = \App\Models\Administration\Categories::where("status_id", 1)
                        ->where("type_category_id", 1)
                        ->where(function ($query) {
                            $query->whereNull("node_id")
                            ->OrWhere("node_id", 0)->orderBy("order", "asc");
                        })->get();
    }

    public function index() {
        $dietas = $this->dietas;
        $categories = $this->categories;

        return view("Administration.Profile.init", compact("dietas", "categories"));
    }

    public function getDataUser() {
        $cli = DB::table("vclient")->where("id", Auth::user()->stakeholder_id)->first();
        return response()->json($cli);
    }

}
