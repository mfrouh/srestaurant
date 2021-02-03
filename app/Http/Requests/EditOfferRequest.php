<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditOfferRequest extends FormRequest
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
            'product_id'=>'required|integer|unique:offers','product_id'.request()->route('offer')->product_id,
            'type'=>'required|in:fixed,variable',
            'value'=>'required|numeric',
            'message'=>'nullable|min:3|max:100',
            'start_offer'=>'required|before:end_offer',
            'end_offer'=>'required|after:start_offer',
        ];
    }
}
