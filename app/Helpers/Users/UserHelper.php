<?php


    namespace App\Helpers\Users;


    class UserHelper
    {
        public function uploadAvatar($request){
            $avatar=$request->file('avatar');
            if($avatar){
                $avatar_name=rand(1000, 9999) . time().'.'.$avatar->getClientOriginalExtension();
                $avatar->move('assets/front_site/images/users', $avatar_name);
                $user=auth()->user();

                $user->update([
                   'avatar'=> 'users/'.$avatar_name
                ]);
            }
        }

    }
