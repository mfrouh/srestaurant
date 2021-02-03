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
   Route::resource('category', 'Backend\CategoryController');
   Route::resource('coupon', 'Backend\CouponController');
   Route::resource('menu', 'Backend\MenuController');
   Route::resource('offer', 'Backend\OfferController');
   Route::resource('product', 'Backend\ProductController');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
