<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table='categories';

    protected $fillable=['name','slug','status'];

    protected $appends=['path'];

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
}
