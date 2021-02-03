<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table='attributes';

    protected $fillable=['product_id','name'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function values()
    {
        return $this->hasMany('App\Models\Value');
    }
}
