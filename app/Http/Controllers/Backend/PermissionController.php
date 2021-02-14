<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','permission:الصلاحيات'])->only('index');
        $this->middleware(['auth','permission:انشاء صلاحية'])->only('store');
        $this->middleware(['auth','permission:تعديل صلاحية'])->only(['show','update']);
        $this->middleware(['auth','permission:حذف صلاحية'])->only('destroy');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm editpermission"  data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>
                                   <a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       return view('Backend.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:permissions'
        ]);
        Permission::create(['name'=>$request->name]);
        return response()->json(['data'=>'success created'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $permission=Permission::findById($id);
       return response()->json(['data'=>$permission],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission=Permission::findById($id);
        return view('Backend.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required|unique:permissions,name,'.$id,
        ]);
        DB::table('permissions')->where('id',$id)->update(['name'=>$request->name]);
        return response()->json(['data'=>'success updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::findById($id)->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
