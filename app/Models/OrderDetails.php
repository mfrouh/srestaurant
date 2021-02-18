<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table='order_details';

    protected $fillable=['order_id','product_id','name','price','status_order_complete','total_price','status','quantity'];

    protected $appends=['status_order'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    public function ScopeChangestatus($q,$value)
    {
        switch ($value) {
            case 'Pending':
                $status='0';
                break;
            case 'Prepare':
                $status='1';
                break;
            case 'Completed':
                $status='2';
                break;
            default:
                $status='0';
                break;
        }
        return $q->update(['status'=>$value,'status_order_complete'=>$status]);
    }
    public function getStatusOrderAttribute()
    {
       switch ($this->status) {
           case 'Pending':
               return 'لم يطهي بعد';
               break;
           case 'Prepare':
               return 'يطهي الان';
               break;
            case 'Completed':
               return 'اكتمل الطهي';
               break;
           default:
               return 'لم يطهي بعد';
               break;
       }
    }
}
