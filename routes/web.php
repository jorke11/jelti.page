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

Route::post('newVisitan', "PageController@newVisitan");

Route::get('/products/{slug_category}', "PageController@productSearch");

Auth::routes();
Route::get('/search', 'PageController@getProducts');
Route::get('/search-input', 'PageController@getProductsInput');

Route::get('/getComment/{id}', 'Ecommerce\ShoppingController@getComment');
Route::post('addComment', 'Ecommerce\ShoppingController@storeComment');
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
