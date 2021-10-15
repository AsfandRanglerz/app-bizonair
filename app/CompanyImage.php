<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyImage extends Model
{
    protected $guarded = [];

    public function image()
    {
        return $this->belongsTo(\App\CompanyProfile::class);
    }

}
