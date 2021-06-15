<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function users(){
        return $this->hasMany(User::class);
    }

    public function cities()
    {
        return $this->hasMany(\App\City::class);
    }

    public function states()
    {
        return $this->hasMany(\App\State::class);
    }
}
