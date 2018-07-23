<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

use App\Models;

Route::get('/search/{busqueda}', 'PageController@search');


Route::get('/', function () {

    $init = date('Y-m-d', strtotime('-3 month', strtotime(date('Y-m-d'))));
    $end = date("Y-m-d");

    $sql = "
            SELECT p.id,p.title as product,sup.business as supplier, 
            sum(CASE WHEN d.real_quantity IS NULL THEN 0 ELSE d.real_quantity end * CASE WHEN d.packaging=0 THEN 1 WHEN d.packaging IS NULL THEN 1 ELSE d.packaging END) quantity, 
            sum(d.value * CASE WHEN d.real_quantity IS NULL THEN 0 ELSE d.real_quantity end * d.units_sf) as subtotal,p.thumbnail,p.slug,p.short_description
            FROM departures_detail d 
            JOIN departures s ON s.id=d.departure_id and s.status_id IN(2,7) 
            JOIN stakeholder ON stakeholder.id=s.client_id and stakeholder.type_stakeholder=1 
            JOIN vproducts p ON p.id=d.product_id JOIN stakeholder sup ON sup.id=p.supplier_id and p.thumbnail is not null
            WHERE s.dispatched BETWEEN '" . $init . " 00:00' AND '" . $end . " 23:59' AND s.client_id NOT IN(258,264,24) AND p.category_id<>-1
            GROUP by 1,2,3,p.thumbnail,p.slug,p.short_description ORDER BY 4 DESC limit 50
            ";
    $most_sales = DB::select($sql);

    $categories = Models\Administration\Categories::where("status_id", 1)->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->orderBy("order", "asc")->get();
//    dd($category);
    $newproducts = DB::table("vproducts")->where("status_id", 1)
            ->where("category_id", "<>", -1)
            ->where("category_id", "<>", 19)
            ->whereNotNull("image")
            ->whereNotNull("thumbnail")
            ->where("is_new", true)
            ->orderBy("supplier", "asc")
            ->orderBy("category_id")
            ->orderBy("reference")
            ->get();

    $subcategory = \App\Models\Administration\Characteristic::where("status_id", 1)->where("type_subcategory_id", 1)->whereNotNull("img")->orderBy("order", "asc")->get();
//    dd($subcategory);
//    dd($newproducts);

    foreach ($newproducts as $i => $value) {
        $cod = str_replace("]", "", str_replace("[", "", $newproducts[$i]->characteristic));
        if ($cod != '') {
            $cod = array_map('intval', explode(",", $cod));
            $cod = array_filter($cod);
            $cha = null;
            if (count($cod) > 0) {

                $cha = Models\Administration\Characteristic::whereIn("id", $cod)->get();
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
        array("url" => "http://www.superfuds.com/images_blog/referentes/farmatodo-1.jpg", "title" => "farmatdo"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/segalco-2.jpg", "title" => "Segalco"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/rappi-3.jpg", "title" => "Rappi"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/terrafertil-4.jpg", "title" => "Terrafertil"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/chocolov-6.jpg", "title" => "Chocolov"));

    $clients = array(
        array("url" => "http://www.superfuds.com/images_blog/referentes/farmatodo-1.jpg", "title" => "farmatdo"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/segalco-2.jpg", "title" => "Segalco"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/rappi-3.jpg", "title" => "Rappi"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/terrafertil-4.jpg", "title" => "Terrafertil"),
        array("url" => "http://www.superfuds.com/images_blog/referentes/chocolov-6.jpg", "title" => "Chocolov"));

    $dietas = array(
        (object) array("id" => 1, "description" => "Paleo"),
        (object) array("id" => 2, "description" => "Vegano"),
        (object) array("id" => 3, "description" => "Sin gluten"),
        (object) array("id" => 4, "description" => "Organico"),
        (object) array("id" => 5, "description" => "Sin grasas Trans"),
        (object) array("id" => 6, "description" => "Sin azucar"),
    );


    return view('page', compact("categories", "subcategory", "newproducts", "love_clients", "clients", "dietas", "most_sales"));
});


Route::get('myOrders', "Ecommerce\PaymentController@getMyOrders");
Route::get('getDetailOrder/{invoice}', "Ecommerce\PaymentController@getInvoice");


Route::get('/products/{slug_category}', function ($slug_category) {

    $row_category = Models\Administration\Categories::where("slug", $slug_category)->where("type_category_id", 1)->where("node_id", 0)->first();
    $categories = Models\Administration\Categories::where("status_id", 1)->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->orderBy("order", "asc")->get();

    $subcategory = Models\Administration\Categories::where("status_id", 1)->where("node_id", $row_category->id)->orderBy("order", "asc")->get();




//    return DB::select($sql);


    $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("thumbnail")->whereNotNull("warehouse")->orderBy("title", "desc")->paginate(16);

//    dd($row_category);

    $dietas = array(
        (object) array("id" => 1, "description" => "Paleo"),
        (object) array("id" => 2, "description" => "Vegano"),
        (object) array("id" => 3, "description" => "Sin gluten"),
        (object) array("id" => 4, "description" => "Organico"),
        (object) array("id" => 5, "description" => "Sin grasas Trans"),
        (object) array("id" => 6, "description" => "Sin azucar"),
    );


    return view('listproducts', compact("categories", "row_category", 'products', "slug_category", "subcategory", "dietas"));
});

Auth::routes();
Route::get('/search', 'PageController@getProducts');
//Route::get('/search/{input}', 'PageController@getProducts');

Route::get('/getComment/{id}', 'Ecommerce\ShoppingController@getComment');
Route::get('/getCounter', 'Ecommerce\PaymentController@getOrdersCurrent');
Route::get('/getCounter/{slug}', 'Ecommerce\PaymentController@getOrdersCurrent');
Route::get('/productDetail/{id}', 'Ecommerce\ShoppingController@getProduct');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/payment', 'Ecommerce\PaymentController@index');
Route::get('/selectPay', 'Ecommerce\PaymentController@methodsPayment');
Route::put('addProduct/{slug}', 'Ecommerce\PaymentController@addProduct');
Route::put('deleteProduct/{slug}', 'Ecommerce\PaymentController@deleteProduct');
Route::put('deleteProductUnit/{slug}', 'Ecommerce\PaymentController@deleteProductUnit');
Route::put('deleteAllProduct/{slug}', 'Ecommerce\PaymentController@deleteAllProduct');
Route::post('payment/target', 'Ecommerce\PaymentController@payment');

Route::get('/api/getDepartment', 'Administration\SeekController@getDepartment');

Route::get('getCity/{department_id}', "Ecommerce\PaymentController@getCities");
Route::get('congratulations', "Ecommerce\PaymentController@congratulations");

Route::post('addFavourite/{slug}', 'Ecommerce\ShoppingController@addFavourite');
