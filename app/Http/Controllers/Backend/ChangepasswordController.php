<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangepasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:تغير كلمة المرور'])->only(['index','store']);
    }

    public function index()
    {
     return view('Backend.setting.change-password');
    }

   public function store(Request $request)
   {
       $this->validate($request,[
           'old_password'=>'required|min:8',
           'password'=>'required|min:8|confirmed'
       ]);
       $user=User::where('id',auth()->user()->id)->first();
       if (Hash::check($request->old_password,$user->password)) {
           $user->password=Hash::make($request->password);
           $user->save();
               return back()->with('success','تمت تغير كلمة المرور بنجاح');
       }
       else {
               return back()->with('error','نريد كلمة المرور الحالية');
       }
   }


}
