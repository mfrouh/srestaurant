<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $fillable=['user_id','created_by','address_id','status','type','delivery_time','payment_type','total_price','discount','payment_id','phone_number','note_for_driver'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function details()
    {
        return $this->hasMany('App\Models\OrderDetails');
    }
}
