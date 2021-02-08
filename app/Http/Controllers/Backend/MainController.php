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
  public function image($id)
  {
    $image=Image::findorfail($id);
    Storage::delete($image->url);
    $image->delete();
    return back()->with('success','تم حذف الصورة بنجاح');
  }
  public function cashier(Request $request)
  {
       if ($request->ajax()) {
          $products=Product::query();
          if ($request->product && $request->product!='') {
             $products->where('name','like','%'.$request->product.'%');
          }
          if ($request->category_id) {
             $products->whereIn('category_id',$request->category_id);
          }
          if ($request->menu_id) {
             $products->whereIn('menu_id',$request->menu_id);
          }
        $products=$products->Active()->latest()->take(12)->get();
          return response()->json($products);
       }
       $categories=Category::Active()->get();
       $menus=Menu::Active()->get();
    return view('backend.cashier.index',compact('categories','menus'));
  }
}
