<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupervisorDeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:مشرف عمال التوصيل']);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
         $orders=Order::with('address')
         ->where('type','Delivery')->where('status','EndProcessing')
         ->whereNull('superdelivery_by')->Orwhere('superdelivery_by',auth()->user()->id)
         ->get();
         return response()->json($orders);
        }
        return view('backend.supervisordelivery.index');
    }
    public function deliverys(Request $request)
    {
        if ($request->ajax()) {
            $deliverys=User::Role('عامل توصيل')->select(['id','name'])->get();
            $order=Order::where('id',$request->id)->select(['id','delivery_by','created_at'])->first();
            return response()->json(['deliverys'=>$deliverys,'order'=>$order]);
        }
    }
    public function selectdelivery(Request $request)
    {
        if ($request->ajax()) {
           Order::where('id',$request->id)->update(['delivery_by'=>$request->delivery]);
           Order::where('id',$request->id)->where('superdelivery_by',null)->update(['superdelivery_by'=>auth()->user()->id]);
           return response()->json(['data'=>$request->id]);
        }
    }
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::where('superdelivery_by',auth()->user()->id)->selection();
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
        return view('backend.supervisordelivery.history');
    }
    public function order_details(Request $request)
    {
       $orderDetails=OrderDetails::with('product')->where('order_id',$request->id)->get();
       return response()->json(['details'=>$orderDetails]);
    }

}
