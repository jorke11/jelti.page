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

Auth::routes();
Route::get('/search/{busqueda}', 'PageController@search');
Route::get('/', 'PageController@index');

Route::get('myOrders', "Ecommerce\PaymentController@getMyOrders");
Route::get('getDetailOrder/{invoice}', "Ecommerce\PaymentController@getInvoice");

Route::post('newVisitan', "PageController@newVisitan");
Route::post('loginModal', "Auth\LoginController@loginModal");

Route::get('/products/{slug_category}', "PageController@productSearch");
Route::get('/categories', "PageController@getCategories");
Route::get('/suppliers', "PageController@getSuppliers");
Route::get('/diet', "PageController@getDiet");

Route::get('/search', 'PageController@getProducts');
Route::get('/search-input', 'PageController@getProductsInput');

Route::get('/getComment/{id}', 'Ecommerce\ShoppingController@getComment');
Route::post('addComment', 'Ecommerce\ShoppingController@storeComment');
Route::get('/getCounter', 'Ecommerce\PaymentController@getOrdersCurrent');
Route::get('/getCounter/{slug}', 'Ecommerce\PaymentController@getOrdersCurrent');
Route::get('/productDetail/{id}', 'Ecommerce\ShoppingController@getProduct');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/payment', 'Ecommerce\PaymentController@index');
Route::get('/payment-credit', 'Ecommerce\PaymentController@paymentCredit');
Route::get('/selectPay', 'Ecommerce\PaymentController@methodsPayment');
Route::put('addProduct/{slug}', 'Ecommerce\PaymentController@addProduct');
Route::put('deleteProduct/{slug}', 'Ecommerce\PaymentController@deleteProduct');
Route::put('deleteProductUnit/{slug}', 'Ecommerce\PaymentController@deleteProductUnit');
Route::put('deleteAllProduct/{slug}', 'Ecommerce\PaymentController@deleteAllProduct');
Route::post('payment/target', 'Ecommerce\PaymentController@payment');

Route::get('/api/getDepartment', 'Administration\SeekController@getDepartment');

Route::get('getCity/{department_id}', "Ecommerce\PaymentController@getCities");
Route::get('congratulations', "Ecommerce\PaymentController@congratulations");
Route::get('updateLink', "Ecommerce\ShoppingController@updateLink");

Route::post('addFavourite/{slug}', 'Ecommerce\ShoppingController@addFavourite');
Route::post('comment-like', 'Ecommerce\ShoppingController@addCommentLike');
Route::get('pse', "Ecommerce\PseController@index");
Route::post('payment/pse', "Ecommerce\PseController@payment");
