<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function product_manufacturer()
    {
        return $this->hasOne(\App\ProductManufacturer::class);
    }

    public function machinery_product_info()
    {
        return $this->hasOne(\App\MachineryProductInfo::class);
    }

    public function fabric_product_info()
    {
        return $this->hasOne(\App\FabricProductInfo::class);
    }

    public function fiber_product_info()
    {
        return $this->hasOne(\App\FiberProductInfo::class);
    }

    public function yarn_product_info()
    {
        return $this->hasOne(\App\YarnProductInfo::class);
    }

    public function institutional_product_info()
    {
        return $this->hasOne(\App\InstitutionalProductInfo::class);
    }

    public function garments_product_info()
    {
        return $this->hasOne(\App\GarmentsProductInfo::class);
    }

    public function chemicals_product_infos()
    {
        return $this->hasMany(\App\ChemicalsProductInfo::class);
    }

    public function product_specifications()
    {
        return $this->hasMany(\App\ProductSpecification::class);
    }

    public function product_image()
    {
        return $this->hasMany(\App\ProductImage::class);
    }


    public function getSpecificCategoryProduct($category)
    {
        $products = $this->where('category', $category)->get();
        return $products;
    }

    public function getProduct($id)
    {
        $product = $this->find($id);
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = $this->find($id);
        return $product;
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

    public function company()
    {
        return $this->belongsTo(CompanyProfile::class, 'company_id', 'id');
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
