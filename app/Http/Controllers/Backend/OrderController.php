<?php

namespace App\Http\Controllers\Backend;

use App\Cart\Cart;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm details"  data-id="'.$row->id.'">التفاصيل</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       return view('Backend.order.index');
    }

    public function store(Request $request,Cart $cart)
    {
       $cart->content();
       $cart->clear();
       return response()->json(['data'=>'success created'],200);
    }

    public function order_details($id)
    {
       $orderDetails=OrderDetails::where('order_id',$id)->get();
       return view('Backend.main.order_details',compact('orderDetails'));
    }
}
