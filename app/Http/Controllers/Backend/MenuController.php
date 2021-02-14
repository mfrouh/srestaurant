<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMenuRequest;
use App\Http\Requests\EditMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:انشاء قائمة'])->only('store');
        $this->middleware(['auth','permission:القوائم'])->only('index');
        $this->middleware(['auth','permission:تغير حالة قائمة'])->only('status');
        $this->middleware(['auth','permission:تعديل قائمة'])->only(['show','update']);
        $this->middleware(['auth','permission:حذف قائمة'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Menu::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn='';
                        if ($row->status=='active') {
                            $btn.='<a href="javascript:void(0);" class="edit btn btn-secondary m-1 btn-sm changestatus"  data-id="'.$row->id.'">غلق</a>';
                        }
                        else {
                            $btn.='<a href="javascript:void(0);" class="edit btn btn-info m-1 btn-sm changestatus"  data-id="'.$row->id.'">تشغيل</a>';
                        }
                           $btn .= '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm editmenu"  data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>
                                   <a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        Menu::findorfail($request->id)->ChangeState();
        return response()->json(['data'=>'success changed']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMenuRequest $request)
    {
        Menu::create($request->validated());
        return response()->json(['data'=>'success created'],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return response()->json(['data'=>$menu],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(EditMenuRequest $request, Menu $menu)
    {
        $menu->update($request->validated());
        return response()->json(['data'=>'success updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
