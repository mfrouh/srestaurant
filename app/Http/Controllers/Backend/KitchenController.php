<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class KitchenController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders=Order::whereIn('status',['Pending','Processing'])->latest()->take(12)->get();
            return response()->json($orders);
        }
        return view('backend.kitchen.index');
    }

    public function details(Request $request)
    {
        if ($request->ajax()) {
            $details=OrderDetails::where('order_id',$request->id)->get();
            return response()->json($details);
        }
    }
    public function changeorder(Request $request)
    {
        if ($request->ajax()) {
           Order::where('id',$request->id)->update(['status'=>$request->status]);
            return response()->json(['data'=>$request->id.$request->status]);
        }
    }
    public function changeorderdetails(Request $request)
    {
        if ($request->ajax()) {
            OrderDetails::where('id',$request->id)->update(['status'=>$request->status]);
            return response()->json(['data'=>'changed']);
        }
    }

}
