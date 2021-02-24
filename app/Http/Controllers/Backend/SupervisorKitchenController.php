<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupervisorKitchenController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:مشرف في المطبخ']);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders=Order::whereIn('status',['Pending','Processing'])->whereNull('superkitchen_by')->Orwhere('superkitchen_by',auth()->user()->id)->latest()->take(12)->get();
            return response()->json($orders);
        }
        return view('backend.supervisorkitchen.index');
    }
    public function history(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::where('superkitchen_by',auth()->user()->id)->selection();
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
        return view('backend.supervisorkitchen.history');
    }
    public function details(Request $request)
    {
        if ($request->ajax()) {
            $details=OrderDetails::with('product')->where('order_id',$request->id)->get();
            $chefs=User::Role('طباخ')->select(['id','name'])->get();
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
           $orderid=OrderDetails::where('id',$request->id)->first()->order_id;
           Order::where('id',$orderid)->where('superkitchen_by',null)->update(['superkitchen_by'=>auth()->user()->id]);
           return response()->json(['data'=>'changed']);
        }
    }
}
