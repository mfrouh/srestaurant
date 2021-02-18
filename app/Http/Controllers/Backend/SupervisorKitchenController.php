<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;

class SupervisorKitchenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:مشرف المطبخ']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders=Order::whereIn('status',['Pending','Processing'])->latest()->take(12)->get();
            return response()->json($orders);
        }
        return view('backend.supervisorkitchen.index');
    }

    public function details(Request $request)
    {
        if ($request->ajax()) {
            $details=OrderDetails::where('order_id',$request->id)->get();
            $chefs=User::Role('طباخ')->get();
            return response()->json(['details'=>$details,'chefs'=>$chefs]);
        }
    }
    public function changeorder(Request $request)
    {
        if ($request->ajax()) {
            Order::where('id',$request->id)->where('status_order_complete','100')->update(['status'=>'EndProcessing']);
            return response()->json(['data'=>$request->id.$request->status]);
        }
    }
    public function selectchef(Request $request)
    {
        if ($request->ajax()) {
           OrderDetails::where('id',$request->id)->update(['created_by'=>$request->chef]);
           return response()->json(['data'=>'changed']);
        }
    }
}
