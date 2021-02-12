<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table='addresses';

    protected $fillable=['user_id','address','street'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
