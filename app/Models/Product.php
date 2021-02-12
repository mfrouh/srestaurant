<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
class Product extends Model
{
    use HasFactory;

    protected $table='products';

    protected $fillable=['category_id','menu_id','name','description','price','status','slug','sku','image','video_url','quantity'];

    protected $appends=['priceafteroffer','variantprice','variantpriceafteroffer','stat','category_name','menu_name','image_path'];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = str_replace(' ','_',$model->name);
           // $model->sku = 'p'.$model->id;
        });
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }
    public function ScopeActive($q)
    {
     return  $q->where('status','active');
    }
    public function ScopeInActive($q)
    {
      return  $q->where('status','inactive');
    }
    public function getstatAttribute()
    {
      return  $this->status=="active"?'مفعل':'مغلق';
    }
    // public function setImageAttribute($value)
    // {
    //     Image::make($value)->resize(500,500)->save('images/products/'.$this->name.$this->catgory_id.'.png');
    //     $this->attributes['image']='images/products/'.$this->name.$this->catgory_id.'.png';
    // }
    public function gallery()
    {
      return $this->morphMany(Image::class,'imageable');
    }
    public function offer()
    {
        return $this->hasOne(Offer::class);
    }
    public function getCategoryNameAttribute()
    {
        return $this->category->name;
    }
    public function getImagePathAttribute()
    {
        return asset($this->image);
    }
    public function getMenuNameAttribute()
    {
        return $this->menu->name;
    }
    public function variants()
    {
        return $this->hasMany('App\Models\Variant');
    }
    public function attributes()
    {
        return $this->hasMany('App\Models\Attribute');
    }
    public function getPriceafterofferAttribute()
    {
       if ($this->offer && $this->offer->isactive) {
         if ($this->offer->type=='fixed') {
             if (($this->price - $this->offer->value)>0) {
                return $this->price - $this->offer->value;
             }
             else {
                return $this->price;
             }
         }
         if ($this->offer->type=='variable') {
            if ($this->price - (($this->price*$this->offer->value)/100)>0) {
                return $this->price - (($this->price*$this->offer->value)/100);
            }
            else {
                return $this->price;
             }
         }
       }
       return $this->price;
    }
    public function getvariantpriceAttribute()
    {
       if ($this->variants->count()!=0) {
          $min=min($this->variants->pluck('price')->toArray());
          $max=max($this->variants->pluck('price')->toArray());
        if ($min==$max) {
         return $min;
      }
      return '('.$min.','.$max.')';
     }
     return $this->price;
    }
    public function  getvariantpriceafterofferAttribute()
    {
        if ($this->variants->count()!=0) {
            $min=min($this->variants->pluck('priceafteroffer')->toArray());
          $max=max($this->variants->pluck('priceafteroffer')->toArray());
          if ($min==$max) {
            return $min;
           }
           return '('.$min.','.$max.')';
      }
           return $this->price;
    }
    public function ScopeChangeState()
    {
      $status= $this->status=='active'?'inactive':'active';
      return  $this->update(['status'=>$status]);
    }
}
