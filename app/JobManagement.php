<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobManagement extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
