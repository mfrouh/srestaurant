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
   Route::resource('permissions', 'Backend\PermissionController');
   Route::resource('roles', 'Backend\RoleController');
   Route::resource('tag', 'Backend\TagController');
   Route::resource('order', 'Backend\OrderController');
   Route::get('/setting', 'Backend\SettingController@index')->name('setting.index');
   Route::post('/setting', 'Backend\SettingController@store')->name('setting.store');
   Route::get('/change-password', 'Backend\ChangepasswordController@index')->name('change-password.index');
   Route::post('/change-password', 'Backend\ChangepasswordController@store')->name('change-password.store');
   Route::get('/profile-setting', 'Backend\ProfilesettingController@index')->name('profile-setting.index');
   Route::post('/profile-setting', 'Backend\ProfilesettingController@store')->name('profile-setting.store');
   Route::get('/dashboard', 'Backend\MainController@index')->name('dashboard.index');
   Route::get('/review', 'Backend\MainController@reviews')->name('review.index');



});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
