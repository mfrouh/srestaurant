<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class SettingController extends Controller
{
    public function index()
   {
    $setting=Setting::first();
    return view('Backend.setting.index',compact('setting'));
   }

   public function store(Request $request)
   {
    $this->validate($request,[
        'name'=>'required',
        'logo'=>"nullable",
        'description'=>'required',
        'facebook'=>'url|nullable',
        'twitter'=>'url|nullable',
        'youtube'=>'url|nullable',
        'twitter'=>'url|nullable',
    ]);
    $setting=Setting::first();
    if($setting)
    {
        $setting=Setting::first();
    }
    else {
        $setting=new Setting();
    }
    $setting->name=$request->name;
    if ($request->logo) {
        Image::make($request->logo)->resize(800, 300)->save('images/logo/'.$setting->name.'_'.$setting->id.'.png');
        $setting->logo='images/logo/'.$setting->name.'_'.$setting->id.'.png';
    }
    $setting->description=$request->description;
    $setting->facebook=$request->facebook;
    $setting->twitter=$request->twitter;
    $setting->instagram=$request->instagram;
    $setting->youtube=$request->youtube;
    $setting->save();
    return back()->with('success','تم تعديل الموقع بنجاح');
   }
}
