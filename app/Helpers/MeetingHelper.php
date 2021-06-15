<?php


namespace App\Helpers;


use App\Meeting;
use Illuminate\Support\Facades\Auth;
class MeetingHelper
{

   public static function CheckTodayMeeting(){
       $cdate = date("m/d/Y");


       $meetings =  Meeting::where('company_id',  Auth::user()->my_office->id)->where('meeting_date',  $cdate)->get()->count();
       if ($meetings>0){
           return false;
       }else{
           return true;
       }



   }


}
