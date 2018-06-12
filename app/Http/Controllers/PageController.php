<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administration\Categories;
use DB;
use App\Models\Administration\Products;
use stdClass;

class PageController extends Controller {

    public $dietas;

    public function __construct() {
        $this->dietas = array(
            (object) array("id" => 1, "description" => "Paleo"),
            (object) array("id" => 2, "description" => "Vegano"),
            (object) array("id" => 3, "description" => "Sin gluten"),
            (object) array("id" => 4, "description" => "Organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans"),
            (object) array("id" => 6, "description" => "Sin azucar"),
        );
        
    }

    public function index() {
        
    }

    public function search($param) {

        $slug_category = '';
        $row_category = Categories::where("type_category_id", 1)->where("node_id", 0)->orderBy("id", "desc")->first();

        $subcategory = Categories::where("status_id", 1)->where("node_id", $row_category->id)->orderBy("order", "asc")->get();


        if (stripos($param, "s=") !== false) {
            $param = str_replace("s=", "", $param);
            $char = \App\Models\Administration\Characteristic::where("description", "ilike", "%" . strtolower($param) . "%")->get();
            $products = DB::table("vproducts")
                    ->whereNotNull("image")
                    ->whereNotNull("warehouse");
            foreach ($char as $value) {
                $products->where(function($q) use($value) {
                    $q->where(DB::raw("characteristic::text"), "like", '%' . $value->id . '%');
                });
            }

            $products = $products->orderBy("title", "desc")->get();


            $categories = Categories::where("status_id", 1);

            foreach ($products as $value) {
                $categories->where("id", $value->category_id);
            }



            $categories = $categories->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->orderBy("order", "asc")->get();
        } else {

            $products = DB::table("vproducts")
                            ->whereNotNull("image")
                            ->where(function($q) use($param) {
                                $q->where(DB::raw("lower(title)"), "like", '%' . $param . '%');
                                $q->Orwhere(DB::raw("lower(description)"), "like", '%' . $param . '%');
                            })
                            ->whereNotNull("warehouse")
                            ->orderBy("supplier")
                            ->orderBy("title", "desc")->get();

            $categories = Categories::where("status_id", 1);

            foreach ($products as $value) {
                $categories->where("id", $value->category_id);
            }



            $categories = $categories->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->orderBy("order", "asc")->get();
        }

        $dietas = $this->dietas;

        return view('listproducts', compact("categories", "row_category", 'products', "slug_category", "subcategory", "param", "dietas"));
    }

    public function getProducts(Request $req, $param = null) {
        $in = $req->all();
        $category = Categories::where("node_id", 0)->get();
        $row_category = array();

        if ($param == null) {

            $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("warehouse");


            if (isset($in["categories"])) {
//                dd($in["categories"]);

                $in["categories"] = array_filter($in["categories"]);
                $ids = array();
                foreach ($in["categories"] as $val) {
                    if ($val != '') {
                        $cate = Categories::where("slug", $val)->first();

                        $real_cat = Categories::where("node_id", $cate->id)->get();


                        foreach ($real_cat as $value) {
                            $ids[] = $value->id;
                        }




//                    }
//                    $categories = Categories::where("node_id", $cate->id)->get();
//                    foreach ($categories as $val) {
//                        $products->Orwhere("category_id", $val->id);
//                        
//                    }
                    }
                }

                $products->whereIn("category_id", $ids);
            }

            $cat = [];
            foreach ($category as $value) {
                $cat[] = $value->id;
            }

            $subcat_id = array();
            if (isset($in["subcategories"])) {
                foreach ($in["subcategories"] as $value) {
                    $subcat = Categories::where("description", "ilike", "%" . $value . "%")->first();
//                    $products->Orwhere("category_id", $subcat->id);
                }
            }


            $subcategory = Categories::where("status_id", 1)->WhereIn("node_id", $cat)->orderBy("order", "asc")->get();


            $products = $products->orderBy("supplier", "desc")->orderBy("title", "desc")->get();
        } else {

            $products = DB::table("vproducts")->Where(DB::raw("lower(title)"), "like", "%" . strtolower(trim($param)) . "%")
                            ->orWhere(DB::raw("lower(description)"), "like", "%" . strtolower(trim($param)) . "%")->orderBy("title", "desc")->get();

            $subcategory = array();

            if ($products != null) {
                $cat = [];
                foreach ($products as $value) {
                    $cat[] = $value->category_id;
                }

                $cat = array_unique($cat);
                $subcategory = Categories::where("status_id", 1)->WhereIn("id", $cat)->orderBy("order", "asc")->get();
            }

            $category = array();
            $slug_category = array();

            return view('listproducts', compact("category", "row_category", 'products', "slug_category", "subcategory"));
        }

        $count_cat = 0;

        if (isset($in["categories"]))
            $count_cat = count(array_filter($in["categories"]));

        if ($count_cat == 1) {
            if (isset($in["categories"]))
                $row_category = Categories::whereIn("slug", $in["categories"])->first();
        } else {
            $row_category = new stdClass();
            $row_category->banner = url("/images/banner_sf.jpg");
        }

        return response()->json(["products" => $products, "categories" => $subcategory, "count_cat" => $count_cat, "row_category" => $row_category]);
    }

}
