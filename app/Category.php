<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function company()
    {
        return $this->belongsToMany(\App\CompanyProfile::class, 'company_profile_industries', 'company_id', 'industry_id');
    }

    public function getAllCompanies()
    {
        return $this->all();
    }

    public function getCategoryName($id)
    {
        $category = $this->find($id);
        return $category->name;
    }

    public function subcategories()
    {
        return $this->hasMany(\App\Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(\App\Product::class);
    }

    public function buysells()
    {
        return $this->hasMany(\App\BuySell::class);
    }

    public function childsubcategories()
    {
        return $this->hasMany(\App\Childsubcategory::class);
    }

}
