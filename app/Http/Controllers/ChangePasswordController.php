<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
class ChangePasswordController extends Controller
{
     /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function index()
        {
            //
        }

        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Contracts\Support\Renderable
         */
        public function store(Request $request)
        {
            //dd($request->all());
            $user = auth()->user();
            $rules = [
                'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check(request()->current_password, $user->password)) {
                        return response()->json(['error' => ['The current password does not match our records.'] ]);
                    }
                }],
                'new_password' => 'required',
                'new_confirm_password' => 'required',
            ];
            $messages = [
                'current_password.required' => 'Please select current password',
                'new_password.required' => 'Please select new password',
                'new_confirm_password.required' => 'Please select new confirm password',
            ];
            $validator = \Validator::make(request()->all(), $rules, $messages);
            if ($validator->fails()) {
                // return $validator->errors()->getMessages();
                return json_encode(['feedback' => 'false', 'errors' => $validator->errors()->getMessages(),]);
            }

            $data['password_change'] = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

            if($data['password_change']){
                $data['msg'] = 'Password Changed  Successfully';
                $data['messag'] = 'Your Password has been successfully changed. Re-login with new password to use Bizonair';
                $data['feedback'] = 'true';
                $url = url()->to('/');
                $data['url']= $url;
            }
            auth()->logout();

            return json_encode($data);
        }

}
