<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
   public function index(Request $request)
   {
    if ($request->ajax()) {
        $roles=Role::whereNotIn('name',['سوبر ادمن','مستخدم'])->get();
        $data = User::role($roles)->select('*');
        return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn='';

                    if(auth()->user()->can('حذف موظف'))
                    {
                       $btn .= '<a href="javascript:void(0);" class="delete btn btn-danger m-1 btn-sm" data-id="'.$row->id.'"><i class="fa fa-trash"></i></a>';
                    }
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
      return view('backend.employee.index');
   }

   public function store(CreateEmployeeRequest $request)
   {
      $user=User::create($request->validated());
      $user->assignRole($request->role);
      return response()->json(['success created'],200);
   }

   public function roles()
   {
    $roles=Role::whereNotIn('name',['سوبر ادمن','مستخدم'])->pluck('name')->toArray();
    return response()->json($roles);
   }

   public function destroy($id)
   {
      $user=User::findOrfail($id);
      $user->delete();
      return response()->json(['data'=>'success deleted'],200);
   }
}
