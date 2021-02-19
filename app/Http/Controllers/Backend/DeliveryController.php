<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders=Order::where('type','delivery')->where('status','EndProcessing')->where('delivery_by',auth()->user()->id)->get();
            return response()->json($orders);
        }
        return view('backend.delivery.index');
    }
    public function details(Request $request)
    {
        if ($request->ajax()) {
            $details=OrderDetails::where('order_id',$request->id)->get();
            return response()->json(['details'=>$details]);
        }
    }
}
