<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table='images';

    protected $fillable=['imageable_id','imageable_type','url'];

    protected $appends=['path'];

    public function imageable()
    {
      return $this->morphTo();
    }

    public function getPathAttribute()
    {
      return asset($this->url);
    }
}
