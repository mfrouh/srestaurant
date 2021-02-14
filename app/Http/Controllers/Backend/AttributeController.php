<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAttributeRequest;
use App\Http\Requests\EditAttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission:انشاء خاصية'])->only('store');
        $this->middleware(['auth','permission:الخصائص'])->only('index');
        $this->middleware(['auth','permission:تعديل خاصية'])->only(['show','update']);
        $this->middleware(['auth','permission:حذف خاصية'])->only('destroy');
    }

    public function index(Request $request)
    {
      if ($request->ajax()) {
         $attributes=Attribute::with('values')->where('product_id',$request->product_id)->get();
         return response()->json($attributes);
       }
    }

    public function store(CreateAttributeRequest $request)
    {
        Attribute::create($request->validated());
        return response()->json(['data'=>'success created'],200);
    }

    public function show(Attribute $attribute)
    {
        return response()->json(['data'=>$attribute]);
    }

    public function update(EditAttributeRequest $request,Attribute $attribute)
    {
        $attribute->update($request->validated());
        return response()->json(['data'=>'success updated'],200);
    }

    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
