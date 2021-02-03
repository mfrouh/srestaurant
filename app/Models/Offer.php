<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table='offers';

    protected $fillable=['product_id','type','value','message','start_offer','end_offer'];

    protected $dates=['start_offer','end_offer'];

    protected $appends=['isactive','activestatus','atype'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function getAtypeAttribute()
    {
      return  $this->type=="fixed"?'ثابت':'متغير';
    }
    public function getIsactiveAttribute()
    {
         if ($this->start_offer <= now() && $this->end_offer >= now()) {
             return 1;
         }
         else {
             return 0;
         }
    }
    public function getActivestatusAttribute()
    {
      return   $this->isactive==1?'متاح الان':'غير متاح الان';
    }
    public function ScopeActive($q)
    {
       $q->where('start_offer','<=', now())->where('end_offer','>=',now());
    }
    public function ScopeInactive($q)
    {
       $q->OrWhere('start_offer','>', now())->OrWhere('end_offer','<',now());
    }
}
