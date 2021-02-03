<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $fillable=['user_id','status','delivery_time','total_price','discount','payment_id','address','street','phone_number','note_for_driver'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
