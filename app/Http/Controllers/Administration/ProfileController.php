<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\Administration\Parameters;
use \App\Traits\InformationClient;
use App\Models\Administration\StakeholderDocument;

class ProfileController extends Controller {

    use InformationClient;

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
        $redirect = ($_GET["p"] == 1) ? 1 : 0;

        return view("Administration.Profile.init", compact("dietas", "categories", "redirect"));
    }

    public function getDataUser() {
        $res["client"] = DB::table("vclient")->where("id", Auth::user()->stakeholder_id)->first();
        $fields_pending = $this->informationRequired(\App\Models\Administration\Stakeholder::find(Auth::user()->stakeholder_id));

        $res["client_pending"] = [
            "fields" => $fields_pending,
            'avg' => 100 - round((count($fields_pending) / 7) * 100)
        ];
        $res["type_person_id"] = Parameters::select("code as id", "description")->where("group", "typeperson")->get();
        $res["sector_id"] = Parameters::select("code as id", "description")->where("group", "sector")->get();
        $res["type_regime_id"] = Parameters::select("code as id", "description")->where("group", "typeregimen")->get();
        $res["type_document_id"] = Parameters::select("code as id", "description")->where("group", "typedocument")->get();
        $res["type_stakeholder_id"] = Parameters::select("code as id", "description")->where("group", "typestakeholder")->get();
        $res["documents"] = $this->listDocuments();

        return response()->json($res);
    }

    public function getTypeDocument() {
        $res = $this->pendientDocuments();
        return response()->json($res);
    }

    public function update(Request $req) {
        $in = $req->all();
        $stake = \App\Models\Administration\Stakeholder::find($in["id"]);
        $redirect = $in["redirect"];
        unset($in["redirect"]);
        unset($in["document"]);
        $in["send_city_id"] = $in["city_id"];
        $in["address"] = $in["address_send"];
        $stake->fill($in)->save();

        if ($redirect) {
            return redirect()->to("payment");
        }
        return back()->with("status", "Información modificada");
    }

    public function uploadDocument(Request $req) {
        $data = $req->all();
        $file = array_get($data, 'document_file');

//        $name = $file[0]->getClientOriginalName();
        $name = $file->getClientOriginalName();
//        $file[0]->move("images/stakeholder/" . $data["stakeholder_id"], $name);
        $file->move("images/stakeholder/" . Auth::user()->stakeholder_id, $name);


        $stakeholder = new StakeholderDocument();
        $stakeholder->stakeholder_id = Auth::user()->stakeholder_id;
        $stakeholder->document_id = $data["document_id"];
        $stakeholder->path = Auth::user()->stakeholder_id . "/" . $name;
        $stakeholder->name = $name;
        $stakeholder->save();
        return $this->listDocuments();
    }

    public function deleteDocument($id) {
        $row = StakeholderDocument::find($id);

        if (file_exists(public_path("images/stakeholder/" . $row->path))) {
            unlink(public_path("images/stakeholder/" . $row->path));
        }

        $row->delete();
        return $this->listDocuments();
    }

    public function listDocuments() {
        return Parameters::select("parameters.code as id", "parameters.description", "stakeholder_document.stakeholder_id", "stakeholder_document.path", "stakeholder_document.id as document_id")->
                        leftjoin("stakeholder_document", "stakeholder_document.document_id", DB::raw("parameters.code and stakeholder_document.stakeholder_id =" . Auth::user()->stakeholder_id))
                        ->where("parameters.group", "=", "type_document_upload")->whereNotNull("stakeholder_id")->get();
    }

    public function pendientDocuments() {
        return Parameters::select("parameters.code as id", "parameters.description", "stakeholder_document.stakeholder_id", "stakeholder_document.path", "stakeholder_document.id as document_id")->
                        leftjoin("stakeholder_document", "stakeholder_document.document_id", DB::raw("parameters.code and stakeholder_document.stakeholder_id =" . Auth::user()->stakeholder_id))
                        ->where("parameters.group", "=", "type_document_upload")->whereNull("stakeholder_id")->get();
    }

}
