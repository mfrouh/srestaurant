<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'user_id'=>'required_unless:type,inrestaurant',
            'created_by'=>'required_if:type,inrestaurant',
            'address_id'=>'required_if:type,delivery',
            'status'=>'nullable|in:Pending,Shipped,Delivered,Processing',
            'type'=>'required|in:delivery,takeaway,inrestaurant',
            'delivery_time'=>'nullable',
            'total_price'=>'required|numeric',
            'discount'=>'nullable',
            'payment_type'=>'required|in:cash,online',
            'payment_id'=>'required_if:payment_type,online',
            'phone_number'=>'required_unless:type,inrestaurant',
            'note_for_driver'=>'nullable',
        ];
    }
}
