<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuySellSpecification extends Model
{
    protected $guarded = [];
    public function buysell(){
        return $this->belongsTo(\App\BuySell::class);
    }
}
