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


Route::get('/', 'PageController@index');


Route::get('myOrders', "Ecommerce\PaymentController@getMyOrders");
Route::get('getDetailOrder/{invoice}', "Ecommerce\PaymentController@getInvoice");


Route::get('/products/{slug_category}', function ($slug_category) {

    $row_category = Models\Administration\Categories::where("slug", $slug_category)->where("type_category_id", 1)->where("node_id", 0)->first();
    $categories = Models\Administration\Categories::where("status_id", 1)->where("type_category_id", 1)->whereNull("node_id")->OrWhere("node_id", 0)->orderBy("order", "asc")->get();

    $subcategory = Models\Administration\Categories::where("status_id", 1)->where("node_id", $row_category->id)->orderBy("order", "asc")->get();

    $products = DB::table("vproducts")->whereNotNull("image")->whereNotNull("thumbnail")->whereNotNull("warehouse")->orderBy("title", "desc")->paginate(16);

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
