<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table='categories';

    protected $fillable=['name','slug','status'];

    protected $appends=['path','stat'];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = str_replace(' ','_',$model->name);
        });
    }
    public function products()
    {
      return $this->hasMany(Product::class);
    }

    public function getPathAttribute()
    {
      return asset('category/'.$this->slug);
    }
    public function ScopeActive($q)
    {
     return  $q->where('status','active');
    }
    public function ScopeInActive($q)
    {
      return  $q->where('status','inactive');
    }
    public function getStatAttribute()
    {
      return  $this->status=="active"?'مفعل':'مغلق';
    }
    public function ScopeChangeState()
    {
      $status= $this->status=='active'?'inactive':'active';
      return  $this->update(['status'=>$status]);
    }
}
