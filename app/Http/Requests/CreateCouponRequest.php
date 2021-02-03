<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCouponRequest extends FormRequest
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
            'code'=>'required|unique:coupons',
            'start'=>'required|before:end|after_or_equal:'.now(),
            'end'=>'required|after:start',
            'cand'=>'nullable|in:more,less else ',
            'cand_value'=>'required_with:cand|nullable|numeric',
            'type'=>'required|in:fixed,variable',
            'value'=>'required',
            'message'=>'nullable',
            'times'=>'required'
        ];
    }
}
