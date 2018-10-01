<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\Administration\Parameters;

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
        $res["client"] = DB::table("vclient")->where("id", Auth::user()->stakeholder_id)->first();
        $res["type_person_id"] = Parameters::select("code as id", "description")->where("group", "typeperson")->get();
        $res["sector_id"] = Parameters::select("code as id", "description")->where("group", "sector")->get();
        $res["type_regime_id"] = Parameters::select("code as id", "description")->where("group", "typeregimen")->get();
        $res["type_document_id"] = Parameters::select("code as id", "description")->where("group", "typedocument")->get();
        $res["type_stakeholder_id"] = Parameters::select("code as id", "description")->where("group", "typestakeholder")->get();
        return response()->json($res);
    }

    public function update(Request $req) {
        $in = $req->all();
        $stake = \App\Models\Administration\Stakeholder::find($in["id"]);
        unset($in["document"]);
        $stake->fill($in)->save();
        return back()->with("status", "Información modificada");
    }

}
