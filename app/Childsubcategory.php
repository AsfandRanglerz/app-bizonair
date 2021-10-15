<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Childsubcategory extends Model
{
    use SoftDeletes;

    public function subcategory()
    {
        return $this->belongsTo(\App\Subcategory::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Product::class);
    }

    public function buysell()
    {
        return $this->belongsTo(\App\BuySell::class);
    }
}
