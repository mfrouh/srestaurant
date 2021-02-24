<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KitchenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:طباخ']);
    }
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = OrderDetails::with(['order:id,type,created_at','product'])->where('created_by',auth()->user()->id)->select('*');
            return DataTables::of($data)
                    ->make(true);
        }
        return view('backend.kitchen.history');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders=OrderDetails::with(['order:id,type,created_at','product'])->where('created_by',auth()->user()->id)->whereIn('status',['Pending','Prepare'])->latest()->take(12)->get();
            return response()->json($orders);
        }
        return view('backend.kitchen.index');
    }

    public function changeorderdetails(Request $request)
    {
        if ($request->ajax()) {
           OrderDetails::where('id',$request->id)->changestatus($request->status);
           $orderid=OrderDetails::find($request->id)->order_id;
           Order::changestatesorder($orderid);
           return response()->json(['data'=>'changed']);
        }
    }
}
