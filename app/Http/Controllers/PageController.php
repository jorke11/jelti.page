<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administration\Categories;
use DB;

class PageController extends Controller {

    public function index() {
        
    }

    public function getProducts(Request $req) {
        $in = $req->all();
        
        dd($in);
        

        $category = Categories::whereIn("slug", $in["categories"])->get();
        $cat = [];
        foreach ($category as $value) {
            $cat[] = $value->id;
        }

        $subcategory = Categories::where("status_id", 1)->WhereIn("node_id", $cat)->orderBy("order", "asc")->get();

        $sub = [];

        foreach ($category as $value) {
            $sub[] = $value->id;
        }

        $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("warehouse")->whereIn("category_id", $sub)->orderBy("title", "desc")->get();

        return response()->json(["products" => $products, "categories" => $subcategory]);
    }

}
