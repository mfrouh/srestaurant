<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:الوظائف'])->only('index');
        $this->middleware(['auth','permission:انشاء وظيفة'])->only('store');
        $this->middleware(['auth','permission:تعديل وظيفة'])->only(['show','update']);
        $this->middleware(['auth','permission:اعطاء صلاحيات'])->only(['show','role_permissions']);
        $this->middleware(['auth','permission:حذف وظيفة'])->only('destroy');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::where('name','!=','سوبر ادمن')->select('*');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn='';
                           if(auth()->user()->can('تعديل وظيفة'))
                           $btn.='<a href="javascript:void(0);" class="edit btn btn-primary m-1 btn-sm editrole"  data-id="'.$row->id.'"><i class="fa fa-edit"></i></a>';
                           if(auth()->user()->can('حذف وظيفة'))
                           {$btn.='<a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';}
                            $btn.='<a href="javascript:void(0);" class="permissions btn btn-success m-1 btn-sm" data-id="'.$row->id.'"> اعطاء صلاحيات '.$row->name.'</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
       return view('Backend.roles.index');
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
            'name'=>'required|unique:roles'
        ]);
        Role::create(['name'=>$request->name]);
        return response()->json(['data'=>'success updated'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $role=Role::findById($id);
       return response()->json(['data'=>$role],200);
    }

    public function getrolepermissions($id)
    {
       $role=Role::findById($id);
       $permissions=Permission::all();
       $rolepermissions=Role::findById($id)->permissions->pluck('id')->toArray();
       return response()->json(['role'=>$role,'permissions'=>$permissions,'rolepermissions'=>$rolepermissions]);
    }

    public function role_permissions(Request $request)
    {
      $this->validate($request,[
          'permissions'=>'required',
          'role_id'=>'required',
      ]);
      $role=Role::findById($request->role_id);
      $role->syncPermissions($request->permissions);
      return back()->with('success','تم تعديل صلاحيات الوظيفة بنجاح');
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
            'name'=>'required|unique:roles,name,'.$id,
        ]);
        DB::table('roles')->where('id',$id)->update(['name'=>$request->name]);
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
        Role::findById($id)->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
