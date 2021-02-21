<?php

namespace App\Models;

class CashierOrder extends Order
{
    protected $fillable=['created_by','status','type','delivery_time','payment_type','total_price','discount','payment_id'];

    public function setPaymentTypeAttribute()
    {
        $this->attributes['payment_type']='cash';
    }

    public function setTypeAttribute()
    {
        $this->attributes['type']='Inrestaurant';
    }

}
