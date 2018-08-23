<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administration\Categories;
use App\Models\Administration\Characteristic;
use DB;
use App\Models\Administration\Products;
use stdClass;
use App\Models\Administration\Email;
use App\Models\Administration\EmailDetail;
use Mail;
use App\Models\Inventory\Orders;
use Auth;

class PageController extends Controller {

    public $dietas;

    public function __construct() {
        $this->dietas = array(
            (object) array("id" => 1, "description" => "Paleo", "slug" => "paleo"),
            (object) array("id" => 2, "description" => "Vegano", "slug" => "vegano"),
            (object) array("id" => 3, "description" => "Sin gluten", "slug" => "sin_gluten"),
            (object) array("id" => 4, "description" => "Organico", "slug" => "organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans", "slug" => "sin_grasas_trans"),
            (object) array("id" => 6, "description" => "Sin azucar", "slug" => "sin_azucar"),
        );
    }

    public function index() {
        $init = date('Y-m-d', strtotime('-3 month', strtotime(date('Y-m-d'))));
        $end = date("Y-m-d");
        $join = '';
        $field = '';
        $group = '';
        if (Auth::user()) {
            $orders = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();

            if ($orders != null) {
                $join = "LEFT JOIN orders_detail ON orders_detail.product_id=p.id and orders_detail.order_id = " . $orders->id;
                $field = ",orders_detail.quantity";
                $group = ",orders_detail.quantity";
            }
        }


        $sql = "
            SELECT p.id,p.title as product,sup.business as supplier, 
            sum(CASE WHEN d.real_quantity IS NULL THEN 0 ELSE d.real_quantity end * CASE WHEN d.packaging=0 THEN 1 WHEN d.packaging IS NULL THEN 1 ELSE d.packaging END) quantity, 
            sum(d.value * CASE WHEN d.real_quantity IS NULL THEN 0 ELSE d.real_quantity end * d.units_sf) as subtotal,p.thumbnail,p.slug,p.short_description,
            p.price_sf,p.tax
            $field
            FROM departures_detail d 
            JOIN departures s ON s.id=d.departure_id and s.status_id IN(2,7) 
            JOIN stakeholder ON stakeholder.id=s.client_id and stakeholder.type_stakeholder=1 
            JOIN vproducts p ON p.id=d.product_id JOIN stakeholder sup ON sup.id=p.supplier_id and p.thumbnail is not null
            $join
            WHERE s.dispatched BETWEEN '" . $init . " 00:00' AND '" . $end . " 23:59' AND s.client_id NOT IN(258,264,24) AND p.category_id<>-1
            GROUP by 1,2,3,p.thumbnail,p.slug,p.short_description,p.price_sf,p.tax$group ORDER BY 4 DESC limit 50
            ";
        $most_sales = DB::select($sql);
        
        

        $categories = Categories::where("status_id", 1)
                        ->where("type_category_id", 1)
                        ->where(function($query) {
                            $query->whereNull("node_id")
                            ->OrWhere("node_id", 0)->orderBy("order", "asc");
                        })->get();

        $newproducts = DB::table("vproducts")->where("status_id", 1)
                ->where("category_id", "<>", -1)
                ->where("category_id", "<>", 19)
                ->whereNotNull("image")
                ->whereNotNull("thumbnail")
                ->where("is_new", true);



        $newproducts = $newproducts->orderBy("supplier", "asc")
                ->orderBy("category_id")
                ->orderBy("reference")
                ->get();

        $subcategory = Characteristic::where("status_id", 1)->where("type_subcategory_id", 1)->whereNotNull("img")->orderBy("order", "asc")->get();

        foreach ($newproducts as $i => $value) {
            $cod = str_replace("]", "", str_replace("[", "", $newproducts[$i]->characteristic));
            if ($cod != '') {
                $cod = array_map('intval', explode(",", $cod));
                $cod = array_filter($cod);
                $cha = null;
                if (count($cod) > 0) {

                    $cha = Characteristic::whereIn("id", $cod)->get();
                    if (count($cha) == 0) {
                        $cha = null;
                    }
                    $newproducts[$i]->characteristic = $cha;
                }

                $newproducts[$i]->short_description = str_replace("/", "<br>", $newproducts[$i]->short_description);
            } else {
                $newproducts[$i]->characteristic = null;
            }
        }

        $love_clients = array(
            array("url" => "https://superfuds.com/images_blog/referentes/farmatodo-1.jpg", "title" => "farmatodo"),
            array("url" => "https://superfuds.com/images_blog/referentes/segalco-2.jpg", "title" => "Segalco"),
            array("url" => "https://www.superfuds.com/images_blog/referentes/rappi-3.jpg", "title" => "Rappi"),
            array("url" => "https://www.superfuds.com/images_blog/referentes/terrafertil-4.jpg", "title" => "Terrafertil"),
            array("url" => "https://www.superfuds.com/images_blog/referentes/chocolov-6.jpg", "title" => "Chocolov"));

        $clients = array(
            array("url" => "https://superfuds.com/images_blog/referentes/farmatodo-1.jpg", "title" => "farmatodo"),
            array("url" => "https://superfuds.com/images_blog/referentes/segalco-2.jpg", "title" => "Segalco"),
            array("url" => "https://superfuds.com/images_blog/referentes/rappi-3.jpg", "title" => "Rappi"),
            array("url" => "https://superfuds.com/images_blog/referentes/terrafertil-4.jpg", "title" => "Terrafertil"),
            array("url" => "https://superfuds.com/images_blog/referentes/chocolov-6.jpg", "title" => "Chocolov"));


        $dietas = $this->dietas;



        return view('page', compact("categories", "subcategory", "newproducts", "love_clients", "clients", "dietas", "most_sales"));
    }

    public function productSearch($slug_category) {
        $row_category = Categories::where("slug", $slug_category)->where("type_category_id", 1)->where("node_id", 0)->first();

//        dd($row_category);

        $categories = Categories::where("status_id", 1)->where("type_category_id", 1)
                        ->where(function($query) {
                            $query->whereNull("node_id")
                            ->OrWhere("node_id", 0)->orderBy("order", "asc");
                        })->get();



        $subcategory = Categories::where("status_id", 1)->where("node_id", $row_category->id)->orderBy("order", "asc")->get();

        $ids = [];
        foreach ($subcategory as $val) {
            $ids[] = $val->id;
        }

        $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("thumbnail")->whereIn("category_id", $ids)
                ->whereNotNull("warehouse");
        $dietas = array(
            (object) array("id" => 1, "description" => "Paleo", "slug" => "paleo"),
            (object) array("id" => 2, "description" => "Vegano", "slug" => "vegano"),
            (object) array("id" => 3, "description" => "Sin gluten", "slug" => "sin_gluten"),
            (object) array("id" => 4, "description" => "Organico", "slug" => "organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans", "slug" => "sin_grasas_trans"),
            (object) array("id" => 6, "description" => "Sin azucar", "slug" => "sin_azucar"),
        );

        $breadcrumbs = "<a href='/'>Home</a> / " . ucwords($slug_category);

        if (Auth::user()) {
            $orders = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();

            if ($orders != null)
                $products->select("orders_detail.quantity", "vproducts.category_id", "vproducts.thumbnail", "vproducts.slug", "vproducts.id", "vproducts.short_description", "vproducts.price_sf", "vproducts.tax", "vproducts.supplier")->leftjoin("orders_detail", "orders_detail.product_id", DB::raw("vproducts.id and orders_detail.order_id = " . $orders->id));
        }


        $products = $products->orderBy("title", "desc")->get();


        return view('listproducts', compact("breadcrumbs", "categories", "row_category", 'products', "slug_category", "subcategory", "dietas"));
    }

    public function search($param) {
        $orders = null;



        $slug_category = '';
        $row_category = Categories::where("type_category_id", 1)->where("node_id", 0)->where("status_id", 1)->orderBy("id", "desc")->first();

        $subcategory = Categories::where("status_id", 1)->where("node_id", $row_category->id)->where("status_id", 1)->orderBy("description", "asc")->get();

        if (stripos($param, "s = ") !== false) {
            $param = str_replace("s = ", "", $param);
            $char = \App\Models\Administration\Characteristic::where("description", "ilike", "%" . strtolower($param) . "%")->get();
            $products = DB::table("vproducts")->select("vproducts.id", "vproducts.title", "vproducts.short_description", "vproducts.price_sf", "vproducts.image", "vproducts.thumbnail", "vproducts.category_id", "vproducts.slug", "vproducts.tax", "vproducts.supplier"
                    )
                    ->whereNotNull("image")
                    ->whereNotNull("warehouse");

            if (Auth::user()) {
                $orders = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();

                if ($orders != null)
                    $products->select("orders_detail.quantity", "vproducts.category_id", "vproducts.thumbnail", "vproducts.slug", "vproducts.id", "vproducts.short_description", "vproducts.price_sf", "vproducts.tax", "vproducts.supplier")->leftjoin("orders_detail", "orders_detail.product_id", DB::raw("vproducts.id and orders_detail.order_id = " . $orders->id));
            }

            foreach ($char as $value) {
                $products->where(function($q) use($value) {
                    $q->where(DB::raw("characteristic::text"), "like", '%' . $value->id . '%');
                });
            }

            $products = $products->orderBy("title", "desc")->get();

            $categories = Categories::where("status_id", 1);

            foreach ($products as $value) {
//                dd($value);
                $categories->where("id", $value->category_id);
            }

            $categories = $categories->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->where("status_id", 1)->orderBy("order", "asc")->get();
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

            $categories = $categories->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->where("status_id", 1)->orderBy("order", "asc")->get();
        }

//        dd($products);
        $dietas = $this->dietas;
        $breadcrumbs = "<a href = '/'>Home</a> / Alimentos";
        return view('listproducts', compact("breadcrumbs", "categories", "row_category", 'products', "slug_category", "subcategory", "param", "dietas"));
    }

    public function getProducts(Request $req, $param = null) {
        $in = $req->all();
        $category = Categories::where("node_id", 0)->get();
        $sub_ids = array();

        $row_category = array();
        $cat_ids = [];
        if ($param == null) {
            $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("thumbnail")->whereNotNull("warehouse");

            if (isset($in["categories"])) {

                $in["categories"] = array_filter($in["categories"]);
                $ids = array();

                foreach ($in["categories"] as $val) {
                    if ($val != '') {
                        $cate = Categories::where("slug", $val)->first();
                        $cat_ids[] = $cate->id;
                        $real_cat = Categories::where("node_id", $cate->id)->get();


                        foreach ($real_cat as $value) {
                            $ids[] = $value->id;
                        }
                    }
                }

                $products->whereIn("category_id", $ids);
            }

            if (isset($in["subcategories"])) {
                $in["subcategories"] = array_filter($in["subcategories"]);

                foreach ($in["subcategories"] as $val) {
                    if ($val != '') {
                        $cate = Categories::where("slug", $val)->first();
                        $sub_ids[] = $cate->id;
                    }
                }

                $products->whereIn("category_id", $sub_ids);
            }

            if (count($cat_ids) > 0) {
                $subcategory = Categories::WhereIn("node_id", $cat_ids)->orderBy("description", "asc")->get();
                foreach ($subcategory as $i => $value) {
                    if (in_array($value->id, $sub_ids)) {
                        $subcategory[$i]->checked = true;
                    }
                }
            } else {
                $subcategory = Categories::Where("node_id", "<>", 0)->orderBy("description", "asc")->get();
                foreach ($subcategory as $i => $value) {
                    if (in_array($value->id, $sub_ids)) {
                        $subcategory[$i]->checked = true;
                    }
                }
            }

            $products = $products->orderBy("supplier", "desc")->orderBy("title", "asc")->get();
        } else {

            echo "else";
            exit;

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
            $row_category->banner = url("/images/banner_sf.png");
        }




        return response()->json(["products" => $products, "subcategories" => $subcategory, "count_cat" => $count_cat, "row_category" => $row_category]);
    }

    public function newVisitan(Request $req) {
        $in = $req->all();

        $in["email"] = trim($in["email"]);
        unset($in["_token"]);
        $email = \App\Models\Administration\Stakeholder::where("email", trim($in["email"]))->get();

        if (count($email) > 0) {
            return response()->json(["msg" => "Email ya esta registrado en nuestro sistema!", "status" => false], 500);
        }

        if ($in["type_stakeholder"] == 1) {
            $new = \App\Models\Seller\Prospect::create($in);
        }

//        unset($in["type_stakeholder"]);

        $this->mails[] = "jpinedom@hotmail.com";

        if ($in["type_stakeholder"] == 3) {
            $in["type"] = "Proveedor";
            $email = Email::where("description", "page_supplier")->first();
        } else {
            $in["type"] = "Cliente";
            $email = Email::where("description", "page")->first();
        }

        if ($email != null) {
            $emDetail = EmailDetail::where("email_id", $email->id)->get();

            if ($emDetail != null) {
                foreach ($emDetail as $value) {
                    $this->mails[] = $value->description;
                }
            }
        }

        $in["environment"] = env("APP_ENV");

        $this->subject = "Nuevo Registro";
        Mail::send("Notifications.prospect", $in, function($msj) {
            $msj->subject($this->subject);
            $msj->to($this->mails);
        });

        return response()->json(["msg" => "Creados!", "status" => true]);
    }

}
