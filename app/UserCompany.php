<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    protected $guarded= [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function company()
    {
        return $this->belongsTo('App\CompanyProfile','company_id','id');
    }
    public function creator()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }



}
