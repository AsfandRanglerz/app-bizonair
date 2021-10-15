<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerType extends Model
{
     public function banner(){
        return $this->hasMany(Banner::class);
    }
}
