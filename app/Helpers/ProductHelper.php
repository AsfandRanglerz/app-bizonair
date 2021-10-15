<?php
namespace App\Helpers;
use App\Product;
use App\User;
use App\ProductImage;
use App\ProductSpecification;

 Class ProductHelper{

 	public static function getFirstImage($id)
 	{
 		# code...
 		$product =  ProductImage::where('product_id' , $id)->first();
 		return $product->image;
 	}


 	public static function getImages($id)
 	{
 		# code...
 		$product =  ProductImage::where('product_id' , $id)->get();
 		return $product;
 	}
     public static function getSheets($id)
     {
         # code...
         $product =  ProductSpecification::where('product_id' , $id)->get();
         return $product;
     }

 	public static function createdBy(Product $product){
        $user =  User::find($product->createdBy);
        return $user->first_name.' '.$user->last_name;
    }

 }
