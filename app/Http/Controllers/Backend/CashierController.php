<?php

namespace App\Http\Controllers\Backend;

use App\Cart\Cart as Cart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(Request $request)
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

    public function order(Request $request,Cart $cart)
    {
       $product=Product::findOrfail($request->id);
       $cart->CreateORUpdate($product->id,$product->sku);
       return response()->json($cart->content());
    }
}
