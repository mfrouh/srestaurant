<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Image;
use App\Models\Menu;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:الاراء'])->only('reviews');
        $this->middleware(['auth','permission:الرئيسية'])->only('index');
    }
    public function index()
    {
    $users=User::count();
    $products=Product::count();
    $actproducts=Product::active()->count();
    $inactproducts=Product::inactive()->count();
    $tags=Tag::count();
    $roles=Role::count();
    $permissions=Permission::count();
    $categories=Category::count();
    $actcategories=Category::active()->count();
    $inactcategories=Category::inactive()->count();
    $orders=Order::count();
    $offers=Offer::count();
    $actoffers=Offer::active()->count();
    $inactoffers=Offer::inactive()->count();
    $coupons=Coupon::count();
    $actcoupons=Coupon::active()->count();
    $inactcoupons=Coupon::inactive()->count();
    return view('Backend.dashboard.index',
    compact('users',
    'products','tags','roles',
    'permissions','categories',
    'actproducts','inactproducts',
    'actcategories','inactcategories',
    'orders',
    'offers','actoffers','inactoffers',
    'coupons','actcoupons','inactcoupons'));
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
