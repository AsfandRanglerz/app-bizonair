<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfileIndustry extends Model
{
    protected $guarded=[];

    /*public function company(){
        return $this->belongsTo(CompanyProfile::class, 'company_id');
    }
    public function industry(){
        return $this->belongsTo(Category::class, 'industry_id');
    }*/

}
