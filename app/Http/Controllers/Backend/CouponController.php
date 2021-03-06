<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\EditCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:انشاء خصم'])->only('store');
        $this->middleware(['auth','permission:الخصومات'])->only('index');
        $this->middleware(['auth','permission:تعديل خصم'])->only(['show','update']);
        $this->middleware(['auth','permission:حذف خصم'])->only('destroy');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Coupon::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ='';
                        if(auth()->user()->can('تعديل خصم'))
                           $btn .= '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm editcoupon"  data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';
                        if(auth()->user()->can('حذف خصم'))
                           $btn .= '<a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.coupon.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCouponRequest $request)
    {
       Coupon::create($request->validated());
       return response()->json(['data'=>'success created'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return response()->json(['data'=>$coupon],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(EditCouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->validated());
        return response()->json(['data'=>'success updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
