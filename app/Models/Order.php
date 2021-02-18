<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $fillable=['user_id','created_by','address_id','status','type','status_order_complete','delivery_time','payment_type','total_price','discount','payment_id','phone_number','note_for_driver'];

    protected $appends=['type_order'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function details()
    {
        return $this->hasMany('App\Models\OrderDetails');
    }
    public function getTypeOrderAttribute()
    {
       switch ($this->type) {
           case 'inrestaurant':
               return 'في المطعم';
               break;
           case 'delivery':
               return 'توصيل للمنازل';
               break;
            case 'takeaway':
               return 'جاهز من المطعم';
               break;
           default:
               return 'في المطعم';
               break;
       }
    }
    public function ScopeChangestatesorder($q,$id)
    {
        $sum= OrderDetails::where('order_id',$id)->pluck('status_order_complete')->sum();
        $count= OrderDetails::where('order_id',$id)->count() * 2;
        $result=($sum / $count)*100;
       if (round($result)==0) {
           $status='Pending';
       }
       elseif (round($result)==100) {
        $status='EndProcessing';
       }
       else
       {
        $status='Processing';
       }
        return $q->where('id',$id)->update(['status'=>$status,'status_order_complete'=>round($result)]);
    }
}
