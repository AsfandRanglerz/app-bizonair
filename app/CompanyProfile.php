<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $guarded = [];

    public function user_companies()
    {
        return $this->hasMany('App\UserCompany','id','company_id');
    }

    public function industry()
    {
        return $this->belongsToMany(\App\Category::class, 'company_profile_industries', 'company_id', 'industry_id');
    }

    public function images()
    {
        return $this->hasMany(\App\CompanyImage::class, 'company_id', 'id');
    }



    public function scopeTop($query)
    {
        return $query->where('year_established', '<', 2000)->with('images');
    }
}
