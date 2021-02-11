<?php

namespace App\Http\Controllers\Backend;

use App\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
       return response()->json(['content'=>$cart->content(),'total'=>$cart->total()]);
    }

    public function store(Request $request,Cart $cart)
    {
        $product=Product::findOrfail($request->id);
        $cart->CreateORUpdate($product->id,$product->sku);
        return response()->json(['data'=>'success created'],200);
    }

    public function clear(Cart $cart)
    {
       $cart->clear();
       return response()->json(['data'=>'success cleared'],200);
    }

    public function destroy($id,Cart $cart)
    {
       $cart->destroy($id);
       return response()->json(['data'=>'success deleted'],200);
    }
}
