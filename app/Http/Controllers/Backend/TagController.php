<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tag::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm details"  data-id="'.$row->id.'">التفاصيل</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       return view('Backend.tag.index');
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
