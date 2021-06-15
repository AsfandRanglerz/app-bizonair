<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UType extends Model
{
    public function users(){
        return $this->belongsToMany(\App\User::class, 'user_types', 'user_id', 'u_type_id');
    }
}
