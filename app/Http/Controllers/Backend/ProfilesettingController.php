<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;

class ProfilesettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:المعلومات الشخصية'])->only(['index','store']);
    }
    public function index()
    {
      return view('Backend.setting.profile-setting');
    }

    public function store(Request $request)
    {
       $this->validate($request,[
           'name'=>'required',
           'email'=>'required|unique:users,email,'.auth()->user()->id,
           'image'=>'image|nullable'
       ]);
       $user=User::where('id',auth()->user()->id)->first();
       $user->name=$request->name;
       $user->email=$request->email;
       if ($request->image) {
           Image::make($request->image)->resize(300, 300)->save('images/users/'.$user->name.'_'.$user->id.'.png');
           $user->image='images/users/'.$user->name.'_'.$user->id.'.png';
       }
       $user->save();
       return back()->with('success','تم التعديل البيانات بنجاح');
    }
}
