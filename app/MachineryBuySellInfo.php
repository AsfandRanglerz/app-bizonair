<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineryBuySellInfo extends Model
{
    protected $guarded = [];
    public function buysell(){
        return $this->belongsTo(\App\BuySell::class);
    }
}
