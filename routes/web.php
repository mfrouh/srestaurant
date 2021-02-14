<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::group(['prefix'=>'backend','middleware' => ['auth']], function () {
   Route::resource('category', 'Backend\CategoryController')->except(['edit','create']);
   Route::resource('coupon', 'Backend\CouponController')->except(['edit','create']);
   Route::resource('menu', 'Backend\MenuController')->except(['edit','create']);
   Route::resource('offer', 'Backend\OfferController')->except(['edit','create']);
   Route::resource('product', 'Backend\ProductController')->except(['edit','create']);
   Route::resource('permissions', 'Backend\PermissionController')->except(['edit','create']);
   Route::resource('roles', 'Backend\RoleController')->except(['edit','create']);
   Route::resource('tag', 'Backend\TagController')->except(['edit','create']);
   Route::resource('order', 'Backend\OrderController')->except(['edit','create']);
   Route::resource('attribute', 'Backend\AttributeController')->except(['edit','create']);
   Route::resource('value', 'Backend\ValueController')->except(['edit','create']);
   Route::resource('variant', 'Backend\VariantController')->except(['edit','create']);
   //setting  website
   Route::resource('/setting', 'Backend\SettingController')->only(['index','store']);
   //personal information
   Route::resource('/change-password', 'Backend\ChangepasswordController')->only(['index','store']);
   Route::resource('/profile-setting', 'Backend\ProfilesettingController')->only(['index','store']);
   //change status
   Route::post('category/status', 'Backend\CategoryController@status');
   Route::post('menu/status', 'Backend\MenuController@status');
   Route::post('product/status', 'Backend\ProductController@status');
   //show product page
   Route::get('product/show/{id}', 'Backend\ProductController@showproduct')->name('showproduct');
   //dashboard
   Route::get('/dashboard', 'Backend\MainController@index')->name('dashboard.index');
   //cashier
   Route::get('/cashier', 'Backend\CashierController@index')->name('cashier');
   Route::get('/cashier/order', 'Backend\CashierController@order')->name('cashier.createorder');
   Route::get('/cart', 'Backend\CartController@index')->name('cashier.order');
   Route::delete('/cart/{id}', 'Backend\CartController@destroy')->name('cashier.deleteorder');
   //kitchen
   Route::get('/kitchen', 'Backend\KitchenController@index')->name('kitchen');
   Route::post('/kitchen', 'Backend\KitchenController@details')->name('kitchen.orderdetails');
   Route::post('/kitchen/changeorder', 'Backend\KitchenController@changeorder')->name('kitchen.changeorder');
   Route::post('/kitchen/changeorderdetails', 'Backend\KitchenController@changeorderdetails')->name('kitchen.changeorderdetails');
   //reviews
   Route::get('/review', 'Backend\MainController@reviews')->name('review.index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
