<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BuySell extends Model
{
    use SoftDeletes;

    protected $guarded = [];

//    public function product_manufacturer()
//    {
//        return $this->hasOne(\App\ProductManufacturer::class);
//    }

    public function buysell_specifications()
    {
        return $this->hasMany(\App\BuySellSpecification::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function buysell_images()
    {
        return $this->hasMany(\App\BuysellImage::class);
    }

    public function machineryBuySellInfo()
    {
        return $this->hasOne(\App\MachineryBuySellInfo::class);
    }

    public function getSpecificCategoryBuySell($category)
    {
        $buysells = $this->where('category', $category)->get();
        return $buysells;
    }

    public function getProduct($id)
    {
        $buysell = $this->find($id);
        return $buysell;
    }

    public function deleteProduct($id)
    {
        $buysell = $this->find($id);
        return $buysell;
    }

    public function getCreatedAtAttribute($value)
    {
        if ($value != null) {
            return \Carbon\Carbon::parse($value)->format('d-M-Y\<\/\b\r\>h:i A');
        } else {
            return '';
        }
    }

    public function getUpdatedAtAttribute($value)
    {
        if ($value != null) {
            return \Carbon\Carbon::parse($value)->format('d-M-Y\<\/\b\r\>h:i A');
        } else {
            return '';
        }
    }

    public function category()
    {
        return $this->belongsTo(\App\Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(\App\Subcategory::class);
    }

    public function childsubcategory()
    {
        return $this->belongsTo(\App\Childsubcategory::class);
    }
}
