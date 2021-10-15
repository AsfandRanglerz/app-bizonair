<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $email=User::where('email', $user->getEmail())->first();

            $finduser = User::where([['google_id', $user->getId()],['email',$user->getEmail()]])->first();
            if($finduser){
                Auth::login($finduser);
                return redirect('my-account/'.$finduser->id);
            }else{
                \session()->put('verified_email', $user->getEmail());
                return redirect()->route('registeration-step-1');
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            $finduser = User::where([['facebook_id', $user->getId()],['email',$user->getEmail()]])->first();
            if($finduser){
                Auth::login($finduser);
                return redirect('my-account/'.$finduser->id);
            }else{
                \session()->put('verified_email', $user->getEmail());
                return redirect()->route('registeration-step-1');
            }
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
    }


    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }
    public function handleLinkedinCallback(Request $request)
    {

        try {
            $user = Socialite::driver('linkedin')->user();

            $finduser = User::where([['linkedin_id', $user->getId()],['email',$user->getEmail()]])->first();
            if($finduser){
                Auth::login($finduser);
                return redirect('my-account/'.$finduser->id);
            }else{
                \session()->put('verified_email', $user->getEmail());
                return redirect()->route('registeration-step-1');
            }
        } catch (Exception $e) {
            return redirect('/');
        }
    }


    public function getPassword(){
        $data['title'] = 'Sign Up';
        return view('front_site.other.enter-password', $data);
    }
    public function savePassword(Request $request){

        $rules= [
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
        $messages = [
            'password.required' => 'Password is required',
            'c_password.required' => 'Confirm your password',
            'c_password.same' => 'Passwords dont match. Try Again',
        ];

        $validator = Validator::make(request()->all() , $rules);
        if(!$validator->fails()){
            $user=\session()->get('new_user');
            \session()->forget('new_user');

            $u=User::create([
                'name'=>$user->getName(),
                'google_id'=>$user->getId(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt($request->password),
                'role_id'=>2,
            ]);
            \auth()->login($u);
            $data['feedback'] = "true";
            $data['msg'] = 'User has been registered successfully';
            $data['url'] = route('my-account',[$u->id]);

        }else{
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
        }
        return json_encode($data);
    }
}
