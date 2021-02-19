<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorDeliveryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
         $orders=Order::with('address')->where('type','delivery')->where('status','EndProcessing')->get();
         return response()->json($orders);
        }
        return view('backend.supervisordelivery.index');
    }
    public function deliverys(Request $request)
    {
        if ($request->ajax()) {
            $deliverys=User::Role('عامل توصيل')->select(['id','name'])->get();
            $order=Order::where('id',$request->id)->select(['id','delivery_by'])->first();
            return response()->json(['deliverys'=>$deliverys,'order'=>$order]);
        }
    }
    public function selectdelivery(Request $request)
    {
        if ($request->ajax()) {
           Order::where('id',$request->id)->update(['delivery_by'=>$request->delivery]);
           return response()->json(['data'=>$request->id]);
        }
    }

}
