<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVariantRequest;
use App\Http\Requests\EditVariantRequest;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index(Request $request)
    {
      if ($request->ajax()) {
         $variants=Variant::where('product_id',$request->product_id)->get();
         return response()->json(['data'=>$variants],200);
       }
    }

    public function store(CreateVariantRequest $request)
    {
        Variant::create($request->validated());
        return response()->json(['data'=>'success created'],200);
    }

    public function show(Variant $variant)
    {
        return response()->json();
    }

    public function update(EditVariantRequest $request,Variant $variant)
    {
        $variant->update($request->validated());
        return response()->json(['data'=>'success updated'],200);
    }

    public function destroy(Variant $variant)
    {
        $variant->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
