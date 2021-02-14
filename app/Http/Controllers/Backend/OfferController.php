<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOfferRequest;
use App\Http\Requests\EditOfferRequest;
use App\Models\Menu;
use App\Models\Offer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:انشاء عرض'])->only('store');
        $this->middleware(['auth','permission:العروض'])->only('index');
        $this->middleware(['auth','permission:تعديل عرض'])->only(['show','update']);
        $this->middleware(['auth','permission:حذف عرض'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Offer::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                         $btn='';
                         if(auth()->user()->can('تعديل عرض'))
                           $btn .= '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm editoffer"  data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';
                         if(auth()->user()->can('حذف عرض'))
                           $btn .= '<a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.offer.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOfferRequest $request)
    {
        Offer::create($request->validated());
        return response()->json(['data'=>'success created'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return response()->json(['data'=>$offer],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(EditOfferRequest $request, Offer $offer)
    {
        $offer->update($request->validated());
        return response()->json(['data'=>'success updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
