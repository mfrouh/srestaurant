<?php

namespace App\Http\Controllers\Backend;

use App\Cart\Cart as Cart;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:كاشير']);
    }
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

    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::where('created_by',auth()->user()->id)->selection();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn='';
                        $btn = '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm details"  data-id="'.$row->id.'">التفاصيل</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.cashier.history');
    }
    public function order_details(Request $request)
    {
       $orderDetails=OrderDetails::with('product')->where('order_id',$request->id)->get();
       return response()->json(['details'=>$orderDetails]);
    }
    public function createorder(Request $request,Cart $cart)
    {
       $product=Product::findOrfail($request->id);
       $cart->CreateORUpdate($product->id,$product->sku);
       return response()->json($cart->content());
    }
    public function getattribute(Request $request)
    {
       $attributes=Attribute::with('values')->where('product_id',$request->id)->get(['id','product_id','name']);
       return response()->json(['attributes'=> $attributes]);
    }

    public function order(Cart $cart)
    {
       return response()->json(['content'=>$cart->content(),'total'=>$cart->total()]);
    }

    public function destroy($id,Cart $cart)
    {
       $cart->destroy($id);
       return response()->json(['data'=>'success deleted'],200);
    }

}
