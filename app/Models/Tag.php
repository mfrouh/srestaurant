<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table='tags';

    protected $fillable=['name','slug'];

    protected $appends=['path'];

    protected $hidden=['created_at','updated_at'];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = str_replace(' ','_',$model->name);
        });
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    public function getPathAttribute()
    {
      return asset('tag/'.$this->slug);
    }
}
