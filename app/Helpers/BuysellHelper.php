<?php
namespace App\Helpers;
use App\BuySell;
use App\BuySellSpecification;
use App\User;
use App\BuysellImage;

 Class BuysellHelper{

 	public static function getFirstImage($id)
 	{
 		# code...
 		$buysell =  BuysellImage::where('buy_sell_id' , $id)->first();
 		return $buysell->image;
 	}


 	public static function getImages($id)
 	{
 		# code...
        $buysell =  BuysellImage::where('buy_sell_id' , $id)->get();
 		return $buysell;
 	}

     public static function getSheets($id)
     {
         # code...
         $buysell =  BuySellSpecification::where('buy_sell_id' , $id)->get();
         return $buysell;
     }

 	public static function createdBy(BuySell $buysell){
        $user =  User::find($buysell->createdBy);
        return $user->first_name.' '.$user->last_name;
    }

 }
