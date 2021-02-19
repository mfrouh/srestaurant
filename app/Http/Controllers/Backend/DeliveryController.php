<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
}
