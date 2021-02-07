<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name'=>'required:unique:products',
            'description'=>'required|min:50',
            'price'=>'required|numeric',
            'status'=>'nullable|in:active,inactive',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_url'=>'nullable|url',
            'quantity'=>'required|numeric',
        ];
    }
}
