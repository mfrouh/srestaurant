<?php

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
    // $pdf = App::make('dompdf.wrapper');
    // $pdf->loadview('welcome');
    // return $pdf->stream();
    return view('welcome');
});
Auth::routes();
Route::group(['prefix'=>'backend','middleware' => ['auth']], function () {
   Route::resource('category', 'Backend\CategoryController')->except(['edit','create']);
   Route::resource('employee', 'Backend\EmployeeController')->except(['edit','create','show']);
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
   Route::post('/order/order_details', 'Backend\OrderController@order_details')->name('order.orderdetails');
   //employee  roles
   Route::get('employee/roles', 'Backend\EmployeeController@roles')->name('employee.roles');
   //set permissions to role
   Route::post('roles/role_permissions', 'Backend\RoleController@role_permissions')->name('role_permissions');
   Route::get('roles/role_permissions/{id}', 'Backend\RoleController@getrolepermissions')->name('getrolepermissions');
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
   Route::get('/cashier/createorder', 'Backend\CashierController@createorder')->name('cashier.createorder');
   Route::get('/cashier/order', 'Backend\CashierController@order')->name('cashier.order');
   Route::get('/cashier/history', 'Backend\CashierController@history')->name('cashier.history');
   Route::post('/cashier/orderdetails', 'Backend\CashierController@order_details')->name('cashier.orderdetails');
   Route::delete('/cashier/order/{id}', 'Backend\CashierController@destroy')->name('cashier.deleteorder');
   //supervisor kitchen
   Route::get('/superkitchen', 'Backend\SupervisorKitchenController@index')->name('kitchen');
   Route::post('/superkitchen', 'Backend\SupervisorKitchenController@details')->name('kitchen.orderdetails');
   Route::post('/superkitchen/changeorder', 'Backend\SupervisorKitchenController@changeorder')->name('kitchen.changeorder');
   Route::post('/superkitchen/selectchef', 'Backend\SupervisorKitchenController@selectchef')->name('kitchen.selectchef');
   Route::get('/superkitchen/history', 'Backend\SupervisorKitchenController@history')->name('kitchen.history');
   //chef kitchen
   Route::get('/chefkitchen', 'Backend\KitchenController@index')->name('chefkitchen');
   Route::post('/chefkitchen/changeorderdetails', 'Backend\KitchenController@changeorderdetails')->name('chefkitchen.changeorderdetails');
   //supervisor delivery
   Route::get('/superdelivery', 'Backend\SupervisorDeliveryController@index')->name('superdelivery');
   Route::post('/superdelivery', 'Backend\SupervisorDeliveryController@deliverys')->name('superdelivery.deliverys');
   Route::post('/superdelivery/selectdelivery', 'Backend\SupervisorDeliveryController@selectdelivery')->name('superdelivery.selectdelivery');
   Route::get('/superdelivery/history', 'Backend\SupervisorDeliveryController@history')->name('superdelivery.history');
   Route::post('/superdelivery/orderdetails', 'Backend\SupervisorDeliveryController@order_details')->name('superdelivery.orderdetails');
   //delivery
   Route::get('/delivery', 'Backend\DeliveryController@index')->name('delivery');
   Route::post('/delivery', 'Backend\DeliveryController@details')->name('delivery.orderdetails');
   Route::post('/delivery/startdeliveryorder', 'Backend\DeliveryController@startdeliveryorder')->name('delivery.startdeliveryorder');
   Route::post('/delivery/deliveryorder', 'Backend\DeliveryController@deliveryorder')->name('delivery.deliveryorder');
   Route::get('/delivery/history', 'Backend\DeliveryController@history')->name('delivery.history');
   //reviews
   Route::get('/review', 'Backend\MainController@reviews')->name('review.index');
});
