<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public function bannerType(){
        return $this->belongsTo(BannerType::class);
    }
    public function addsdimension(){
        return $this->belongsTo(\App\Addsdimension::class);
    }
}
