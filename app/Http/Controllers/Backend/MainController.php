<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Menu;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:الأراء'])->only('reviews');
        $this->middleware(['auth','permission:الرئيسية'])->only('index');
    }
    public function index()
    {
    $users=User::role('مستخدم')->count();
    $cashiers=User::role('كاشير')->count();
    $deliveries=User::role('عامل توصيل')->count();
    $superdeliveries=User::role('مشرف عمال التوصيل')->count();
    $superchefs=User::role('مشرف في المطبخ')->count();
    $chefs=User::role('طباخ')->count();
    $products=Product::count();
    $actproducts=Product::active()->count();
    $inactproducts=Product::inactive()->count();
    $roles=Role::count();
    $permissions=Permission::count();
    $categories=Category::count();
    $actcategories=Category::active()->count();
    $inactcategories=Category::inactive()->count();
    $menus=Menu::count();
    $actmenus=Menu::active()->count();
    $inactmenus=Menu::inactive()->count();
    $orders=Order::count();
    $offers=Offer::count();
    $actoffers=Offer::active()->count();
    $inactoffers=Offer::inactive()->count();
    $coupons=Coupon::count();
    $actcoupons=Coupon::active()->count();
    $inactcoupons=Coupon::inactive()->count();
    $reviews=Review::count();
    return view('Backend.dashboard.index',
    compact('users','cashiers','deliveries',
    'superdeliveries','superchefs','chefs',
    'roles','permissions','orders',
    'products','actproducts','inactproducts',
    'categories','actcategories','inactcategories',
    'offers','actoffers','inactoffers',
    'menus','actmenus','inactmenus',
    'coupons','actcoupons','inactcoupons','reviews'));
  }
  public function reviews(Request $request)
  {
    if ($request->ajax()) {
        $data = Review::select('*');
        return DataTables::of($data)
                ->make(true);
    }
    return view('Backend.review.index');
  }
}
