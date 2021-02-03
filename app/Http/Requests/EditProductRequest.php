<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id'=>'required|integer',
            'menu_id'=>'required|integer',
            'name'=>'required|unique:products,name,'.request()->route('product')->id,
            'description'=>'required|min:50',
            'price'=>'required|numeric',
            'status'=>'required|in:active,inactive',
            'tags'=>'required',
            'images'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required',
            'video_url'=>'nullable|url',
            'images.*'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity'=>'required|numeric',

        ];
    }
}
