<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addsdimension extends Model
{
    public function banner(){
        return $this->hasMany(\App\Banner::class);
    }
}
