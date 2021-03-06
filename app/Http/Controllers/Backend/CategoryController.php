<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:انشاء قسم'])->only('store');
        $this->middleware(['auth','permission:الاقسام'])->only('index');
        $this->middleware(['auth','permission:تغير حالة قسم'])->only('status');
        $this->middleware(['auth','permission:تعديل قسم'])->only(['show','update']);
        $this->middleware(['auth','permission:حذف قسم'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn='';
                        if(auth()->user()->can('تغير حالة قسم'))
                        {
                           if ($row->status=='active') {
                               $btn.='<a href="javascript:void(0);" class="edit btn btn-secondary m-1 btn-sm changestatus"  data-id="'.$row->id.'">غلق</a>';
                           }
                           else {
                               $btn.='<a href="javascript:void(0);" class="edit btn btn-info m-1 btn-sm changestatus"  data-id="'.$row->id.'">تشغيل</a>';
                           }
                        }
                        if(auth()->user()->can('تعديل قسم'))
                        {
                           $btn .= '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm editcategory"  data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';
                        }
                        if(auth()->user()->can('حذف قسم'))
                        {
                           $btn .= '<a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                        }
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        Category::findorfail($request->id)->ChangeState();
        return response()->json(['data'=>'success changed']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
       Category::create($request->validated());
       return response()->json(['data'=>'success created'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       return response()->json(['data'=>$category],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategoryRequest $request, Category $category)
    {
      $category->update($request->validated());
      return response()->json(['data'=>'success updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       $category->delete();
       return response()->json(['data'=>'success deleted'],200);
    }
}
