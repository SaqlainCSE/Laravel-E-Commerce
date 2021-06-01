<?php

use Illuminate\Support\Facades\Route;

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


//Frontend site....................
Route::get('/', 'App\Http\Controllers\HomeController@index');

//show Category wise product.......
Route::get('/product_by_category/{category_id}', 'App\Http\Controllers\HomeController@show_product_by_category');

//show Manufacture wise product.......
Route::get('/product_by_manufacture/{manufacture_id}', 'App\Http\Controllers\HomeController@show_product_by_manufacture');

//show Product View...................
Route::get('/view_product/{product_id}', 'App\Http\Controllers\HomeController@product_details_by_id');

//Add to Cart.........................
Route::post('/add-to-cart', 'App\Http\Controllers\CartController@add_to_cart');

//Show to Cart.........................
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');

//Update to Cart.........................
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_to_cart');

//Delete to Cart.........................
Route::get('/delete-to-cart/{rowId}', 'App\Http\Controllers\CartController@delete_to_cart');

//Checkout Route Here....................
Route::get('/login-check', 'App\Http\Controllers\CheckoutController@login_check');

//Payment Route..........................
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');

//Order Place Route..........................
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
 
//Manage Order...............................
Route::get('/manage-order', 'App\Http\Controllers\CheckoutController@manage_order');

//Customer Login, Logout, Registration Route Here.......
Route::post('/customer_registration', 'App\Http\Controllers\CheckoutController@customer_registration');
Route::post('/customer_login', 'App\Http\Controllers\CheckoutController@customer_login');
Route::get('/customer-logout', 'App\Http\Controllers\CheckoutController@customer_logout');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');


//Shipping Information...................
Route::post('/save-shipping-info', 'App\Http\Controllers\CheckoutController@save_shipping_info');


//Backend Route.....................
Route::get('/logout', 'App\Http\Controllers\SuperAdminController@logout');
Route::get('/admin', 'App\Http\Controllers\AdminController@index'); 
Route::get('/dashboard', 'App\Http\Controllers\SuperAdminController@index');
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');

//Category Related Route...........
Route::get('/add-category', 'App\Http\Controllers\CategoryController@index');
Route::get('/all-category', 'App\Http\Controllers\CategoryController@all_category');
Route::post('/save-category', 'App\Http\Controllers\CategoryController@save_category');
Route::get('/inactive_category/{category_id}', 'App\Http\Controllers\CategoryController@inactive_category');
Route::get('/active_category/{category_id}', 'App\Http\Controllers\CategoryController@active_category');
Route::get('/edit-category/{category_id}', 'App\Http\Controllers\CategoryController@edit_category');
Route::post('/update-category/{category_id}', 'App\Http\Controllers\CategoryController@update_category');
Route::get('/delete-category/{category_id}', 'App\Http\Controllers\CategoryController@delete_category');


//Manufature or Brands route.......
Route::get('/add-manufacture', 'App\Http\Controllers\ManufactureController@index');
Route::get('/all-manufacture', 'App\Http\Controllers\ManufactureController@all_manufacture');
Route::post('/save-manufacture', 'App\Http\Controllers\ManufactureController@save_manufacture');
Route::get('/inactive_manufacture/{manufacture_id}', 'App\Http\Controllers\ManufactureController@inactive_manufacture');
Route::get('/active_manufacture/{manufacture_id}', 'App\Http\Controllers\ManufactureController@active_manufacture');
Route::get('/edit-manufacture/{manufacture_id}', 'App\Http\Controllers\ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{manufacture_id}', 'App\Http\Controllers\ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{manufacture_id}', 'App\Http\Controllers\ManufactureController@delete_manufacture');


//Product route....................
Route::get('/add-product', 'App\Http\Controllers\ProductController@index');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::get('/inactive_product/{product_id}', 'App\Http\Controllers\ProductController@inactive_product');
Route::get('/active_product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');


//Slider Route......................
Route::get('/add-slider', 'App\Http\Controllers\SliderController@index');
Route::get('/all-slider', 'App\Http\Controllers\SliderController@all_slider');
Route::post('/save-slider', 'App\Http\Controllers\SliderController@save_slider');
Route::get('/inactive_slider/{slider_id}', 'App\Http\Controllers\SliderController@inactive_slider');
Route::get('/active_slider/{slider_id}', 'App\Http\Controllers\SliderController@active_slider');
Route::get('/delete-slider/{slider_id}', 'App\Http\Controllers\SliderController@delete_slider');

//Contact Page
Route::get('/contact', 'App\Http\Controllers\AdminController@contact');

// SSLCOMMERZ Start
Route::get('/example1', 'App\Http\Controllers\SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'App\Http\Controllers\SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'App\Http\Controllers\SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'App\Http\Controllers\SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'App\Http\Controllers\SslCommerzPaymentController@success');
Route::post('/fail', 'App\Http\Controllers\SslCommerzPaymentController@fail');
Route::post('/cancel', 'App\Http\Controllers\SslCommerzPaymentController@cancel');

Route::post('/ipn', 'App\Http\Controllers\SslCommerzPaymentController@ipn');
//SSLCOMMERZ END
