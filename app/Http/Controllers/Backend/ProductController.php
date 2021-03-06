<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','permission:انشاء منتج'])->only('store');
        $this->middleware(['auth','permission:المنتجات'])->only('index');
        $this->middleware(['auth','permission:مشاهدة منتج'])->only('showproduct');
        $this->middleware(['auth','permission:تغير حالة منتج'])->only('status');
        $this->middleware(['auth','permission:تعديل منتج'])->only(['show','update']);
        $this->middleware(['auth','permission:حذف منتج'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn='';
                        $route=route('showproduct',[$row->id]);
                        if(auth()->user()->can('تغير حالة منتج')){
                           if ($row->status=='active') {
                               $btn.='<a href="javascript:void(0);" class="edit btn btn-secondary m-1 btn-sm changestatus"  data-id="'.$row->id.'">غلق</a>';
                           }
                           else {
                               $btn.='<a href="javascript:void(0);" class="edit btn btn-info m-1 btn-sm changestatus"  data-id="'.$row->id.'">تشغيل</a>';
                           }
                        }
                        if ($row->offer) {
                            if(auth()->user()->can('تعديل عرض'))
                            $btn.='<a href="javascript:void(0);" class="edit btn btn-pink m-1 btn-sm editoffer"  data-id="'.$row->offer->id.'">تعديل عرض</a>';
                            if(auth()->user()->can('حذف عرض'))
                            $btn.='<a href="javascript:void(0);" class="edit btn btn-dark m-1 btn-sm canceloffer"  data-id="'.$row->offer->id.'">الغاء عرض</a>';
                        }
                        else {
                            if(auth()->user()->can('انشاء عرض'))
                            $btn.='<a href="javascript:void(0);" class="edit btn btn-success m-1 btn-sm createoffer"  data-id="'.$row->id.'">انشاء عرض</a>';
                        }
                        if(auth()->user()->can('مشاهدة منتج'))
                        $btn .= '<a href="'.$route.'" class="edit btn btn-success m-1 btn-sm"><i class="fa fa-eye"></i></a>';
                        if(auth()->user()->can('تعديل منتج'))
                        $btn .= '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm editproduct"  data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';
                        if(auth()->user()->can('حذف منتج'))
                        $btn .='<a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $categories=Category::Active()->get();
        $menus=Menu::Active()->get();
        return view('backend.product.index',compact('categories','menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        Product::findorfail($request->id)->ChangeState();
        return response()->json(['data'=>'success changed']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $product=Product::create($request->validated());
        $product->update();
        return response()->json(['data'=>'success created'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json(['data'=>$product],200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showproduct($id)
    {
        $product=Product::findOrfail($id);
        $categories=Category::Active()->get();
        $menus=Menu::Active()->get();
        return view('backend.product.show',compact('product','menus','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json(['data'=>'success updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
