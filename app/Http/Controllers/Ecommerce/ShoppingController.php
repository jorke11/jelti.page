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

class ShoppingController extends Controller {

    public $stock;
    public $total;
    public $subtotal;
    public $tax5;
    public $tax19;
    public $dietas;

    public function __construct() {
//        $this->middleware("auth");
        $this->stock = new StockController();

        $this->dietas = array(
            (object) array("id" => 1, "description" => "Paleo"),
            (object) array("id" => 2, "description" => "Vegano"),
            (object) array("id" => 3, "description" => "Sin gluten"),
            (object) array("id" => 4, "description" => "Organico"),
            (object) array("id" => 5, "description" => "Sin grasas Trans"),
            (object) array("id" => 6, "description" => "Sin azucar"),
        );


        $this->total = 0;
        $this->subtotal = 0;
        $this->tax5 = 0;
        $this->tax19 = 0;
    }

    public function index() {
        return view("Ecommerce.shopping.init");
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

    public function getProduct($id) {
        $product = DB::table("vproducts")->where("slug", $id)->first();
        $dietas = $this->dietas;

        if ($product != null) {

            $detail = ProductsImage::where("product_id", $product->id)->get();

            $relations = DB::table("vproducts")->where("category_id", $product->category_id)->whereNotNull("image")->get();


            $supplier = Stakeholder::find($product->supplier_id);

            if ($product->characteristic != null) {
                $cod = json_decode($product->characteristic, true);
                $id = array();

                foreach ($cod as $value) {
                    $id[] = (int) $value;
                }

                if (count($id) > 0) {
                    $cha = Characteristic::whereIn("id", $cod)->get();
                    $product->characteristic = $cha;
                }
            }

            $available = $this->stock->getInventory($product->id);

            $categories = Categories::where("node_id", 0)->get();


            return view("Ecommerce.payment.product", compact("product", "detail", "relations", "supplier", "available", "categories", "dietas"));
        } else {
            return response(view('errors.503'), 404);
        }
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

    public function addComment(Request $req) {
        $data = $req->all();

//        dd($data);
        $data["user_id"] = Auth::user()->id;
        $data["type_id"] = 1;
        $data["row_id"] = $data["product_id"];
        Feedback::create($data);
        return $this->getComment($data["product_id"]);
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

    public function getComment($product_id) {
        $feed = Feedback::select("feedback.id", "feedback.title", "users.name", "users.last_name", "feedback.content", "feedback.created_at")
                        ->join("users", "users.id", "feedback.user_id")
                        ->where("row_id", $product_id)->get();

        return response()->json($feed);
    }

    public function getMyProfile() {
        $user = \App\User::find(Auth::user()->id);
        $client = DB::table("vclient")->where("id", $user->stakeholder_id)->first();


        $sql = "select count(*) quantity, sum(subtotalnumeric) total from vdepartures where client_id=$user->stakeholder_id and status_id IN(2,7)";

        $orders = DB::select($sql);
        $orders = $orders[0];

        $sql = "select count(*) quantity, sum(subtotalnumeric) total from vdepartures where client_id=$user->stakeholder_id and status_id IN(1)";

        $new = DB::select($sql);
        $new = $new[0];

        return view("Ecommerce.shopping.profile", compact("client", "orders", "new"));
    }

    public function getMyOrders() {
        return view("Ecommerce.shopping.orders", compact("product"));
    }

}
