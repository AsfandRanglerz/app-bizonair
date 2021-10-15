<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
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

    public function getSubCategoryName($id)
    {
        $subcategory = $this->find($id);
        return $subcategory->name;
    }

}
