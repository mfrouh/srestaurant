<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateValueRequest;
use App\Http\Requests\EditValueRequest;
use App\Models\Value;
use Illuminate\Http\Request;

class ValueController extends Controller
{
    public function index(Request $request)
    {
      if ($request->ajax()) {
         $values=Value::where('product_id',$request->product_id)->get();
         return response()->json(['data'=>$values],200);
       }
    }

    public function store(CreateValueRequest $request)
    {
        Value::create($request->validated());
        return response()->json(['data'=>'success created'],200);
    }

    public function show(Value $value)
    {
        return response()->json(['data'=>$value],200);
    }

    public function update(EditValueRequest $request,Value $value)
    {
        $value->update($request->validated());
        return response()->json(['data'=>'success updated'],200);
    }

    public function destroy(Value $value)
    {
        $value->variants()->delete();
        $value->delete();
        return response()->json(['data'=>'success deleted'],200);
    }
}
