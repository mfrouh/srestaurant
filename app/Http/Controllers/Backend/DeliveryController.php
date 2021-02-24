<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:عامل توصيل']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders=Order::with('address')
            ->where('type','delivery')
            ->whereIn('status',['EndProcessing','Delivery'])
            ->where('delivery_by',auth()->user()->id)
            ->get();
            return response()->json($orders);
        }
        return view('backend.delivery.index');
    }
    public function details(Request $request)
    {
        if ($request->ajax()) {
            $details=OrderDetails::with('product')->where('order_id',$request->id)->get();
            return response()->json(['details'=>$details]);
        }
    }
    public function startdeliveryorder(Request $request)
    {
        if ($request->ajax()) {
            $details=Order::where('id',$request->id)->update(['status'=>'Delivery','delivery_start'=>now()]);
            return response()->json(['details'=>$details]);
        }
    }
    public function deliveryorder(Request $request)
    {
        if ($request->ajax()) {
            $order=Order::where('id',$request->id)->where('code',$request->code)->update(['status'=>'Completed','delivery_end'=>now()]);
            return response()->json(['details'=>$order]);
        }
    }
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::where('delivery_by',auth()->user()->id)->selection();
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
        return view('backend.delivery.history');
    }
}
