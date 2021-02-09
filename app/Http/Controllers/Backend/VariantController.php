<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateVariantRequest;
use App\Http\Requests\EditVariantRequest;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    public function index(Request $request)
    {
      if ($request->ajax()) {
         $variants=Variant::where('product_id',$request->product_id)->get();
          return response()->json($variants);
       }
    }

    public function store(CreateVariantRequest $request)
    {
        $product=Product::findOrfail($request->product_id);
       $vari='';
       foreach ($request->except(['price','product_id','quantity']) as $key => $value) {
          $vari.='_'.$value;
          $values[]=$value;
       }
       if ($product->attributes->count() == count($values)) {
          $sku='p'.$product->id.$vari;
          $isvari=Variant::where('sku',$sku)->first();
          if (!$isvari)
           {
             $variant= Variant::create(["product_id"=>$request->product_id,"sku"=>$sku,'price'=>$request->price,'quantity'=>$request->quantity]);
             $variant->values()->sync($values);
             return response()->json(['data'=>'success created'],200);
           }
        return response()->json(['data'=>'this is found'],422);
     }
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
