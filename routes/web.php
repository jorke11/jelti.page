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

Route::get('/', function () {

    $category = Models\Administration\Categories::where("status_id", 1)->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->orderBy("order", "asc")->get();
//    dd($category);
    $newproducts = DB::table("vproducts")->where("status_id", 1)
            ->where("category_id", "<>", -1)
            ->where("category_id", "<>", 19)
            ->whereNotNull("image")
            ->orderBy("supplier", "asc")
            ->orderBy("category_id")
            ->orderBy("reference")
            ->get();

    $subcategory = \App\Models\Administration\Characteristic::where("status_id", 1)->where("type_subcategory_id", 1)->whereNotNull("img")->orderBy("order", "asc")->get();
//    dd($subcategory);

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

    return view('page', compact("category", "subcategory", "newproducts", "love_clients", "clients"));
});


Route::get('/products/{slug_category}', function ($slug_category) {
    $row_category = Models\Administration\Categories::where("slug", $slug_category)->where("type_category_id", 1)->where("node_id", 0)->first();
    $category = Models\Administration\Categories::where("status_id", 1)->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->orderBy("order", "asc")->get();



    $subcategory = Models\Administration\Categories::where("status_id", 1)->where("node_id", $row_category->id)->orderBy("order", "asc")->get();

    $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("warehouse")->orderBy("title", "desc")->paginate(16);

    return view('listproducts', compact("category", "row_category", 'products', "slug_category", "subcategory"));
});

Route::get('/search', 'PageController@getProducts');
Route::get('/productDetail/{id}', 'Ecommerce\ShoppingController@getProduct');
Route::get('/getComment/{id}', 'Ecommerce\ShoppingController@getComment');
Route::get('/getCounter', 'Ecommerce\ShoppingController@getCountOrders');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
