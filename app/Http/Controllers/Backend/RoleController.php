<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','role_or_permission:SuperAdmin|:الوظائف'])->only('index');
    //     $this->middleware(['auth','role_or_permission:SuperAdmin|:انشاء وظيفة'])->only(['create','store']);
    //     $this->middleware(['auth','role_or_permission:SuperAdmin|:مشاهد وظيفة'])->only('show');
    //     $this->middleware(['auth','role_or_permission:SuperAdmin|:تعديل وظيفة'])->only(['edit','update']);
    //     $this->middleware(['auth','role_or_permission:SuperAdmin|:حذف وظيفة'])->only('destroy');
    // }
    public function index()
    {
       $roles=Role::where('name','!=','SuperAdmin')->get();
       return view('Backend.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.roles.create');
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
        Role::create(['name'=>$request->name,'guard_name'=>'admin']);
        return redirect('/roles')->with('success','تم انشاء الوظيفة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $role=Role::findById($id,'admin');
       if ($role->name!=="SuperAdmin") {
       $permissions=Permission::all();
       $rolepermissions=Role::findById($id,'admin')->permissions->pluck('id')->toArray();
       return view('Backend.roles.show',compact('role','permissions','rolepermissions'));
       }
       return abort('404');
    }
    public function role_permissions(Request $request)
    {
      $this->validate($request,[
          'permissions'=>'required',
          'role_id'=>'required',
      ]);
      $role=Role::findById($request->role_id);
      if ($role->name!=="SuperAdmin") {
      $role->syncPermissions($request->permissions);
      return back()->with('success','تم تعديل صلاحيات الوظيفة بنجاح');
      }
      return abort('404');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::findById($id);
        if ($role->name!=="SuperAdmin") {
        return view('Backend.roles.edit',compact('role'));
        }
        return abort('404');
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
        DB::table('roles')->where('id',$id)->update(['name'=>$request->name,'guard_name'=>'admin']);
        return redirect('/roles')->with('success','تم تعديل الوظيفة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findById($id,'admin')->delete();
        return back()->with('success','تم حذف الوظيفة بنجاح');
    }
}
