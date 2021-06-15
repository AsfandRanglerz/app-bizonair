<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function state()
    {
        return $this->belongsTo(\App\State::class);
    }
    public function country()
    {
        return $this->belongsTo(\App\Country::class);
    }
}
