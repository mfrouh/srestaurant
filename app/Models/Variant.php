<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $table='variants';

    protected $with=['values'];

    protected $fillable=['sku','price','quantity','product_id'];

    protected $appends=['p_a_o'];

    public function values()
    {
        return $this->belongsToMany('App\Models\Value', 'variant_value', 'variant_id', 'value_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function getPAOAttribute()
    {
    //    if ($this->product->offer && $this->product->offer->isactive) {
    //      if ($this->product->offer->type=='fixed') {
    //          if (($this->price - $this->product->offer->value)>0) {
    //             return $this->price - $this->product->offer->value;
    //          }
    //          else {
    //             return $this->price;
    //          }
    //      }
    //      if ($this->product->offer->type=='variable') {
    //         return $this->price - (($this->price*$this->product->offer->value)/100);
    //      }
    //   }
       return $this->price;
    }
}
