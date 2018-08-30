<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Administration\Categories;
use App\Models\Administration\Products;
use App\Models\Administration\ProductsImage;
use App\Models\Administration\Comment;
use App\Models\Administration\Characteristic;
use App\Models\Inventory\Orders;
use App\Models\Inventory\OrdersDetail;
use App\Models\Administration\Stakeholder;
use App\Models\Blog\Feedback;
use Auth;
use DB;
use App\Http\Controllers\Inventory\StockController;
use App\Models\Administration\ProductsComment;
use App\Models\Administration\ProductsCommentLike;

class ShoppingController extends Controller {

    public $stock;
    public $total;
    public $subtotal;
    public $tax5;
    public $tax19;
    public $dietas;
    public $user;

    public function __construct() {
//        $this->middleware("auth");
        $this->stock = new StockController();

        $this->dietas = array(
            (object) array("id" => 1, "description" => "Paleo", "slug" => "paleo"),
            (object) array("id" => 2, "description" => "Vegano", "slug" => "vegano"),
            (object) array("id" => 3, "description" => "Sin gluten", "slug" => "sin_gluten"),
            (object) array("id" => 4, "description" => "Organico", "slug" => "organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans", "slug" => "sin_grasas_trans"),
            (object) array("id" => 6, "description" => "Sin azucar", "slug" => "sin_azucar"),
        );


        $this->total = 0;
        $this->subtotal = 0;
        $this->tax5 = 0;
        $this->tax19 = 0;

//        $this->user = \App\User::find(Auth::user()->id);
//        dd($this->user);
//        $this->client = DB::table("vclient")->where("id", $this->user->stakeholder_id)->first();
    }

    public function index() {
        $categories = [];
        return view("Ecommerce.shopping.init", compact("categories"));
    }

    public function getDetailProduct($id) {
        $dietas = $this->dietas;
        $subcategory = Characteristic::where("status_id", 1)->whereNotNull("img")->where("type_subcategory_id", 1)->orderBy("order", "asc")->get();

        if ($id == '0') {
            $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("warehouse")->orderBy("title", "desc")->paginate(16);
            $category = Categories::all();
            return view("Ecommerce.shopping.specific", compact("category", "products", "subcategory", "deviceSessionId", "dietas"));
        } else {

            if (strpos($id, "_") !== false) {

                $id = str_replace("_", "", $id);
                $category = Categories::find($id);
                $products = DB::table("vproducts")->where(DB::raw("characteristic->>0"), $id)->whereNotNull("image")->whereNotNull("warehouse")->orderBy("title", "desc")->paginate(12);

                return view("Ecommerce.shopping.specific", compact("category", "products", "subcategory", "dietas"));
            } if (strpos($id, "sub") !== false) {
                $id = str_replace("sub", "", $id);

                $category = Categories::find($id);

                $products = DB::table("vproducts")->where("category_id", $id)->whereNotNull("image")->whereNotNull("warehouse")->orderBy("title", "desc")->paginate(12);
                return view("Ecommerce.shopping.specific", compact("category", "products", "subcategory", "dietas"));
            } else {

                $category = Categories::find($id);

                $categoryAssoc = Categories::where("node_id", $id)->get();
                $in = [];

                $sub = array();

                foreach ($categoryAssoc as $j => $value) {

                    $products = DB::table("vproducts")->where("category_id", $value->id)->whereNotNull("image")->orderBy("supplier_id")->orderBy("title", "desc")->get();

                    foreach ($products as $i => $value) {
                        $cod = str_replace("]", "", str_replace("[", "", $products[$i]->characteristic));
                        $cod = array_map('intval', explode(",", $cod));
                        $cod = array_filter($cod);


                        if (count($cod) > 0) {
                            foreach ($cod as $value) {
                                if (!in_array($value, $sub)) {
                                    $sub[] = $value;
                                }
                            }

                            $cha = Characteristic::whereIn("id", $cod)->get();
                            if (count($cha) == 0) {
                                $cha = null;
                            }

                            $products[$i]->characteristic = $cha;
                        } else {
                            $products[$i]->characteristic = null;
                        }

                        $products[$i]->short_description = str_replace("/", "<br>", $products[$i]->short_description);
                    }

                    $categoryAssoc[$j]->products = $products;
                }

                $subcategory = Characteristic::where("status_id", 1)->whereNotNull("img")->where("type_subcategory_id", 1)->whereIn("id", $sub)->orderBy("order", "asc")->get();

                return view("Ecommerce.shopping.detail", compact("category", "categoryAssoc", "subcategory", "id", "dietas"));
            }
        }
    }

    public function getProduct($slug) {
        $product = Products::findBySlug($slug);
        $dietas = $this->dietas;
        $orders = null;
        if ($product != null) {

            $detail = $product->images;
            $relations = DB::table("vproducts")->where("category_id", $product->category_id)->whereNotNull("image");

            if (Auth::user()) {
                $orders = Orders::where("status_id", 1)->where("insert_id", Auth::user()->id)->first();

                if ($orders != null)
                    $relations->select("orders_detail.quantity as quantity_order", "vproducts.category_id", "vproducts.description", "vproducts.thumbnail", "vproducts.slug", "vproducts.id", "vproducts.short_description", "vproducts.price_sf", "vproducts.tax", "vproducts.supplier")->leftjoin("orders_detail", "orders_detail.product_id", DB::raw("vproducts.id and orders_detail.order_id = " . $orders->id));
                $product->select("orders_detail.quantity as quantity_order", "vproducts.category_id", "vproducts.description", "vproducts.thumbnail", "vproducts.slug", "vproducts.id", "vproducts.short_description", "vproducts.price_sf", "vproducts.tax", "vproducts.supplier")->leftjoin("orders_detail", "orders_detail.product_id", DB::raw("vproducts.id and orders_detail.order_id = " . $orders->id));
            }

            $relations = $relations->get();

            $supplier = $product->supplier;

            if ($product->characteristic != null) {
                $id = array();
                $id = array_map('intval', explode(',', implode(",", $product->characteristic)));

                if (count($id) > 0) {
                    $cha = Characteristic::whereIn("id", $id)->get();
                    $product->characteristic = $cha;
                }
            }

            $available = $this->stock->getInventory($product->id);
            $categories = Categories::where("node_id", 0)->where("status_id", 1)->get();

            $like_product = null;

            if (Auth::user() != null) {
                $like_product = $product->is_like()->where("user_id", auth()->id())->first();
            }

            $text = '';

            if (count($like_product) > 0) {
                $like = $line = 'red';
            } else {
                $like = 'none';
                $line = "black";
                $text = "Añadir a favoritos";
            }

            $like = (count($like_product) > 0) ? 'red' : 'none';
//            dd($product->category->node_id);
            $category_f = Categories::find($product->category->node_id);


            if ($product->category->node_id == 0) {
                $slug_cat = $product->slug;
//                dd($product->category);
                $description = $product->category->description;
            } else {
                $slug_cat = $category_f->slug;
                $description = $category_f->description;
            }

            $breadcrumbs = "<a href='/'>Home</a> / <a href='/products/" . str_slug($description) . "'>" . ucwords(strtolower($description)) . "</a> / $slug";

            $product = DB::table("vproducts")->where("vproducts.id", $product->id);

            if ($orders != null) {
                $product->select("orders_detail.quantity as quantity_order", "vproducts.category_id", "vproducts.description", "vproducts.thumbnail", "vproducts.title", "vproducts.slug", "vproducts.id", "vproducts.short_description", "vproducts.price_sf", "vproducts.tax", "vproducts.supplier", "vproducts.image", "vproducts.why", "vproducts.ingredients")
                        ->leftjoin("orders_detail", "orders_detail.product_id", DB::raw("vproducts.id and orders_detail.order_id = " . $orders->id));
            }
            $product = $product->first();


//dd($product);

            return view("Ecommerce.payment.product", compact("breadcrumbs", "product", "detail", "relations", "supplier", "available", "categories", "dietas", "like", "line", "text"));
        } else {
            return response(view('errors.503'), 404);
        }
    }

    public function storeComment(Request $req) {
        $in = $req->all();
        $pro = Products::findBySlug($in["slug"]);

        $new["product_id"] = $pro->id;
        $new["user_id"] = Auth::user()->id;
        $new["subject"] = isset($in["subject"]) ? $in["subject"] : null;
        $new["comment"] = $in["comment"];
        $new["answer_id"] = $in["answer_id"];
        $pro->comment()->create($new);

        return $this->getComment($in["slug"]);
    }

    public function getCities($department_id) {
        $data = \App\Models\Administration\Cities::where("department_id", $department_id)->get();
        return response()->json($data);
    }

    public function getDetailProductAllCategory($id, $subcategory_id) {
        $category = Categories::find($id);

        $subcategory = Characteristic::where("status_id", 1)->whereNotNull("img")->where("type_subcategory_id", 1)->where("id", $subcategory_id)->orderBy("order", "asc")->get();


        $products = DB::table("vproducts")->where("category_id", $id)->where(DB::raw("characteristic->>0"), $subcategory_id)
                        ->whereNotNull("image")->whereNotNull("warehouse")->orderBy("title", "desc")->paginate(12);

        return view("Ecommerce.shopping.specific", compact("category", "products", "subcategory"));
    }

    public function getDetailProductFilter($category_id, $subcategory_id) {


        $subcategory = Characteristic::where("status_id", 1)->whereNotNull("img")->where("type_subcategory_id", 1)->where("id", $subcategory_id)->orderBy("order", "asc")->get();

        $category = Categories::find($category_id);

//        dd($subcategory);

        $categoryAssoc = Categories::where("node_id", $category_id)->get();
        $in = [];

        foreach ($categoryAssoc as $j => $value) {

            $products = DB::table("vproducts")->where("category_id", $value->id)->whereNotNull("image")->where(DB::raw("characteristic->>0"), $subcategory_id)->orderBy("supplier_id")->orderBy("title", "desc")->get();

            foreach ($products as $i => $value) {
                $cod = str_replace("]", "", str_replace("[", "", $products[$i]->characteristic));
                $cod = array_map('intval', explode(",", $cod));
                $cod = array_filter($cod);

                if (count($cod) > 0) {

                    $cha = Characteristic::whereIn("id", $cod)->get();
                    if (count($cha) == 0) {
                        $cha = null;
                    }
                    $products[$i]->characteristic = $cha;
                } else {
                    $products[$i]->characteristic = null;
                }

                $products[$i]->short_description = str_replace("/", "<br>", $products[$i]->short_description);
            }

            $categoryAssoc[$j]->products = $products;
        }

        $id = $category_id;

        return view("Ecommerce.shopping.detail", compact("category", "categoryAssoc", "subcategory", "subcategory_id", "id"));
    }

    public function getCategories() {
        return Categories::all();
    }

    public function managementOrder(Request $req) {
        $data = $req->all();

        $order = Orders::where("stakeholder_id", Auth::user()->id)->where("status_id", 1)->first();

        if (count($order) > 0) {
            $order_id = $order["id"];
        } else {
            $new["stakeholder_id"] = Auth::user()->id;
            $new["status_id"] = 1;
            $order_id = Orders::create($new)->id;
        }


        for ($i = 0; $i < $data["quantity"]; $i++) {
            $pro = Products::findOrFail($data["product_id"]);
            $det["product_id"] = $data["product_id"];
            $det["order_id"] = $order_id;
            $det["tax"] = $pro["tax"];
            $det["units_sf"] = $pro["units_sf"];
            $det["packaging"] = $pro["packaging"];
            $det["value"] = $pro["price_sf"];
            $det["quantity"] = 1;
            OrdersDetail::create($det);
        }

        return $this->getDataCountOrders();
    }

    public function getCountOrders() {
        if (Auth::user() != null) {
            $detail = $this->getDataCountOrders();
        }

        return response()->json(["quantity" => count($detail), "detail" => $detail]);
    }

    public function getDataCountOrders() {
        $order = Orders::where("insert_id", Auth::user()->stakeholder_id)->where("status_id", 1)->first();
        $detail = [];
        if ($order != null) {
            $sql = "
            SELECT d.product_id,p.title as product,d.tax,d.price_sf,COALESCE(d.units_sf,1) as units_sf,p.thumbnail,sum(d.quantity) as quantity,sum(d.quantity * d.price_sf) as subtotal
            FROM orders_detail d
            JOIN vproducts p on p.id=d.product_id
            WHERE d.order_id=" . $order["id"] . "
            group by 1, 2, 3, 4, 5, 6";

            $detail = DB::select($sql);
        }
        return $detail;

//        foreach ($det as $value) {
//            
//        }
//        return OrdersDetail::select("orders_detail.id", "orders_detail.quantity", "orders_detail.tax", "vproducts.title as product", "orders_detail.price_sf","vproducts.thumbnail")
//                        ->join("vproducts", "vproducts.id", "orders_detail.product_id")
//                        ->where("order_id", $order["id"])->get();
    }

    public function getComment($slug) {
        $pro = Products::findBySlug($slug);

        $comm = $pro->comment()->get();

        $comment = [];

        foreach ($comm as $i => $value) {
            $user = $value->user;

            $con = ProductsComment::where("answer_id", $value->id)->get();
//            $l = ProductsCommentLike::where("comment_id", $value->id)->first();

            $comm[$i]->is_like = $value->is_like;
            $comm[$i]->is_like_count = ProductsCommentLike::where("comment_id", $value->id)->count();
            $comm[$i]->client = $user->stakeholder->business;
            $comment[$i][] = $value;

            if (count($con) > 0) {
                $comment[$i]["child"] = $this->getChild($con);
            }
        }

        return response()->json($comm);
    }

    public function getChild($data) {

//        dd($data);

        foreach ($data as $val) {
            $row[] = ProductsComment::find($val->id);
        }
        return $row;
    }

    public function getMyProfile() {

        $sql = "select count(*) quantity, sum(subtotalnumeric) total from vdepartures where client_id=$user->stakeholder_id and status_id IN(2,7)";

        $orders = DB::select($sql);
        $orders = $orders[0];

        $sql = "select count(*) quantity, sum(subtotalnumeric) total from vdepartures where client_id=$user->stakeholder_id and status_id IN(1)";

        $new = DB::select($sql);
        $new = $new[0];

        return view("Ecommerce.shopping.profile", compact("client", "orders", "new"));
    }

    public function addFavourite($slug) {
        $pro = Products::findBySlug($slug);

        if ($pro->is_like()->first() == null) {
            $new["user_id"] = Auth::user()->id;
            $new["product_id"] = $pro->id;
            $pro->is_like()->create($new);
            $like = true;
        } else {
            $pro->is_like()->delete();
            $like = false;
        }

        return response()->json(["like" => $like]);
    }

    public function addCommentLike(Request $req) {
        $in = $req->all();
        $like = ProductsCommentLike::where("comment_id", $in["comment_id"])->first();

        if ($like == null) {
            $new["user_id"] = Auth::user()->id;
            $new["comment_id"] = $in["comment_id"];
            ProductsCommentLike::create($new);
            $like = true;
        } else {
            $like->delete();
            $like = false;
        }

        return response()->json(["like" => $like]);
    }

    public function updateLink() {
        $pro = DB::table("vproducts")->whereNull("image")->whereNull("thumbnail")->where("status_id", 1)->get();

        foreach ($pro as $value) {

            $file = public_path() . "/images/product/" . $value->id . "/" . $value->reference . ".png";
            $file_thumb = public_path() . "/images/product/" . $value->id . "/thumb/" . $value->reference . ".png";
            $image = "images/product/" . $value->id . "/" . $value->reference . ".png";
            $thumb = "images/product/" . $value->id . "/thumb/" . $value->reference . ".png";


            if (file_exists($file) && file_exists($file_thumb)) {
                $new["product_id"] = $value->id;
                $new["main"] = true;
                $new["path"] = $image;
                $new["thumbnail"] = $thumb;
                ProductsImage::create($new);
                var_dump($new);
                echo "<br>";
            } else {
                echo $file . "<br>";
                echo $file_thumb . "<br>";
                echo $value->slug . "<br>";
            }
        }


        echo "termino";
        dd($pro);
    }

}
