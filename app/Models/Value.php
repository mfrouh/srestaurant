<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $table='values';

    protected $fillable=['value','attribute_id'];

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute');
    }
    public function variants()
    {
        return $this->belongsToMany('App\Models\Variant', 'variant_value', 'value_id', 'variant_id');
    }
}
