<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
       $tags=Tag::all();
       return view('Backend.tag.index',compact('tags'));
    }

    public function deletetags($id)
    {
      Tag::findOrfail($id)->delete();
      return back()->with('success','تم مسح الكلمة بنجاح');
    }

    public function product_tags($name)
    {
      $products=Product::whereHas('tags',function($q) use($name){
          $q->where('name',$name);
      })->get();
      return view('Backend.product.index',compact('products'));
     }
}
