<?php

namespace App\Http\Controllers;

use App\BuySell;
use App\Mail\resetPassword;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use App\User;
use App\EmailVerification;
use App\Journal;
use App\NewsManagement;
use App\Product;
use App\Banner;
use http\Exception;
use Illuminate\Http\Request;
use App\Mail\EmailConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use PragmaRX\Countries\Package\Countries;
use PragmaRX\Countries\Update\States;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexx()
    {
        $bnr_row1 = Banner::where('addsdimensions', 'width 419.66 * height 79.94')->where('status', 1)->limit(3)->get();
        $bnr_slider = Banner::where('addsdimensions', 'width 629.5 * height 437.45')->where('status', 1)->get();
        $bnrlupr = Banner::where('addsdimensions', 'width 299.75 * height 109.36')->where('description','2nd row , Left Upper')->where('status', 1)->limit(1)->get();
        $bnrlwr = Banner::where('addsdimensions', 'width 299.75 * height 306')->where('description','2nd row , Left Lower')->where('status', 1)->limit(1)->get();
        $bnrupr = Banner::where('addsdimensions', 'width 299.75 * height 306')->where('description','2nd row , Right Upper')->where('status', 1)->limit(1)->get();
        $bnrwr = Banner::where('addsdimensions', 'width 299.75 * height 109.36')->where('description','2nd row , Right Lower')->where('status', 1)->limit(1)->get();

        $bnrthirdrow = Banner::where('addsdimensions', 'width 1349 * height 236')->where('description','3rd row')->where('status', 1)->limit(1)->get();

        $news =\DB::table('news_management')->orderBy('created_at', 'desc')->get()->take(3);

        $topproduct = \App\Product::where('product_service_types','!=','Service')->with('product_image')->latest()->limit(10)->get();
        $topservice = \App\Product::where('product_service_types','Service')->with('product_image')->latest()->limit(10)->get();
        $topbuysell = \DB::table('buy_sells')->where('product_service_types','!=','Service')->latest()->limit(10)->get();

        $latestjoin = \App\User::select('users.*', 'users.created_at as creation_date')->latest()->first();

        $featuredmember = \App\CompanyProfile::oldest()->limit(8)->get();
        $textile_partners = \App\TextilePartner::all();


        return view('front_site.index', [
            'bnr_row1' => $bnr_row1, 'bnr_slider' => $bnr_slider, 'bnrlupr' => $bnrlupr, 'bnrlwr' => $bnrlwr, 'bnrupr' => $bnrupr, 'bnrwr' => $bnrwr, 'bnrthirdrow' => $bnrthirdrow,
            'news' => $news,'topproduct' => $topproduct,'topbuysell' => $topbuysell,
            'topservice' => $topservice,'latestjoin' => $latestjoin,'featuredmember' => $featuredmember,'textile_partners' => $textile_partners
        ]);
    }

    public function index(){

        $bnr_row1 = Banner::where('addsdimensions', 'width 419.66 * height 79.94')->where('status', 1)->limit(3)->get();
        $bnr_slider = Banner::where('addsdimensions', 'width 629.5 * height 437.45')->where('status', 1)->get();
        $bnrlupr = Banner::where('addsdimensions', 'width 299.75 * height 109.36')->where('description','2nd row , Left Upper')->where('status', 1)->limit(1)->get();
        $bnrlwr = Banner::where('addsdimensions', 'width 299.75 * height 306')->where('description','2nd row , Left Lower')->where('status', 1)->limit(1)->get();
        $bnrupr = Banner::where('addsdimensions', 'width 299.75 * height 306')->where('description','2nd row , Right Upper')->where('status', 1)->limit(1)->get();
        $bnrwr = Banner::where('addsdimensions', 'width 299.75 * height 109.36')->where('description','2nd row , Right Lower')->where('status', 1)->limit(1)->get();

        $bnrthirdrow = Banner::where('addsdimensions', 'width 1349 * height 236')->where('description','3rd row')->where('status', 1)->limit(1)->get();

        $news =\DB::table('news_management')->orderBy('created_at', 'desc')->get()->take(3);

        $topproduct = \App\Product::where('product_service_types','!=','Service')->with('product_image')->latest()->limit(10)->get();
        $topservice = \App\Product::where('product_service_types','Service')->with('product_image')->latest()->limit(10)->get();
        $topbuysell = \DB::table('buy_sells')->where('product_service_types','!=','Service')->latest()->limit(10)->get();

        $latestjoin = \App\User::select('users.*', 'users.created_at as creation_date')->latest()->first();

        $featuredmember = \App\CompanyProfile::oldest()->limit(8)->get();
        $textile_partners = \App\TextilePartner::all();


        return view('front_site.index', [
            'bnr_row1' => $bnr_row1, 'bnr_slider' => $bnr_slider, 'bnrlupr' => $bnrlupr, 'bnrlwr' => $bnrlwr, 'bnrupr' => $bnrupr, 'bnrwr' => $bnrwr, 'bnrthirdrow' => $bnrthirdrow,
            'news' => $news,'topproduct' => $topproduct,'topbuysell' => $topbuysell,
            'topservice' => $topservice,'latestjoin' => $latestjoin,'featuredmember' => $featuredmember,'textile_partners' => $textile_partners
        ]);
    }

    public function getEmail()
    {
        return view('front_site.other.forgot-password');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        $data['savereset'] = \DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        $data['sendmail'] = \Mail::to($request->email)->send(new resetPassword($token));

        if($data['savereset']){
            $data['msg'] = 'We have e-mailed your password reset link please check';
            $data['feedback'] = 'true';

        }
        return json_encode($data);
    }

    public function getPassword($token) {

        return view('front_site.other.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users',
            'password' => 'required',
            'password_confirmation' => 'same:password',

        ];
        $messages = [
            'title.required' => 'title is required',
            'password.required' => 'password is required',
            'password_confirmation.same:password' => 'password_confirmation must be same as password',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {
            $updatePassword = DB::table('password_resets')
                ->where(['email' => $request->email, 'token' => $request->token])
                ->first();

            $data['password_change'] = User::where('email', $request->email)->update(['password'=> bcrypt($request->password)]);

            \DB::table('password_resets')->where(['email'=> $request->email])->delete();

            if($data['password_change']){
                $data['msg'] = 'Password Changed  Successfully';
                $data['feedback'] = 'true';
                $data['url'] = route('home');

            }

        }

        return json_encode($data);
    }

    public function bizonair_404()
    {
        return view('front_site.404-error');
    }

    public function email_confirmation()
    {
        $data['title'] = 'Sign Up';
        return view('front_site.other.email-confirmation', $data);
    }

    public function get_email_verification_code()
    {
        $email = request('email');
        $exst = \App\User::where('email', $email)->first();

        if (!$exst) {
            do {
                $verification_code = mt_rand(399999, 799999);
                $user_code = \App\EmailVerification::where('verification_code', $verification_code)->first();
            } while (!empty($user_code));
            $email_verification = new \App\EmailVerification();
            $email_verification->email = request('email');
            $email_verification->verification_code = $verification_code;
            $email_verification->save();
            \Mail::to(request('email'))->send(new EmailConfirmation($verification_code));
            $time = strtotime('+5 minutes');
            Session::put("expire_time", $time);
            $data['feedback'] = 'true';
            $data['msg'] = 'OTP has been sent to your email address successfully. Please confirm authenticity of your email address.' . '<br>' . 'If you are unable to find email, please;' . '<ol style="margin-left: 2em;">' . '<li>Recheck provided email address</li>' . '<li>Check the Spam/Junk folder in your emails</li>' . '<li>Get intouch with us at info@bizonair.com</li>' . '</ol>';
        } else {
            $data['feedback'] = 'invalid';
            $data['msg'] = 'Email already exists';
        }
        return json_encode($data);
    }

    public function verify_otp($code)
    {
        $data['code'] = $code;
        return view('front_site.other.verify-otp', $data);
    }

    public function check_verification_code(Request $request)
    {
        $userinpcode = $request->get('digit-1').$request->get('digit-2').$request->get('digit-3').$request->get('digit-4').$request->get('digit-5').$request->get('digit-6');
        if($request->get('verifyOtp') == $userinpcode)
        {
            if (Session::has('verified_email')) {
                Session::forget('verified_email');
            }

            $user_code = \App\EmailVerification::where('verification_code', $userinpcode)->orderBy('created_at', 'desc')->first();
            if ($user_code) {
                $expire_time = strtotime($user_code->created_at);
                $current_time = strtotime('-3 days', time());
                if ($current_time > $expire_time) {
                    $data['feedback'] = 'invalid';
                    $data['msg'] = 'The verification link has been expired!';
                    return view('front_site.other.email-confirmation-failed', $data);
                } else {
                    $data['feedback'] = 'true';
                    $data['msg'] = 'Email is verified successfully!';
                    $data['url'] =route('registeration-step-1');
                    Session::put('verified_email', $user_code->email);
//                    $user_code->delete();
                    return json_encode($data);
                }
            } else {
                $data['feedback'] = 'invalid';
                $data['msg'] = 'The verification link does not exist!';
                return view('front_site.other.email-confirmation-failed', $data);
            }
        }else {
            $data['feedback'] = "other";
            $data['custom_msg'] = 'Failed to authenticate . Otp code is invalid';
        }

        return json_encode($data);

    }

    public function log_in_pre()
    {
        return view('front_site.other.login_pre');
    }

    public function do_login_pre()
    {
        $rules = ['email_login' => 'required', 'login_password' => 'required'];
        $messages = [
            'email_login.required' => 'Email is required', 'login_password.required' => 'Password is required'
        ];
        $validator = \Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            // return redirect()->back()->withErrors($validator);
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = 'false';
            return json_encode($data);
        }
        if (Auth::attempt([
            'email' => request('email_login'), 'password' => request('login_password'), 'role_id' => 2
        ])) {
            if (\Auth::user()->is_blocked != 1) {
                $data['user'] = \App\User::find(Auth::user()->id);
                $data['user']->save();
                $data['msg'] = 'Logged in successfully !';
                $data['feedback'] = 'true';
                DB::table('notifications')
                    ->where('user_id', auth()->id())
                    ->update(['is_display' => 1]);
                $usercompany = \App\UserCompany::where('user_id',Auth::id())->first();
                if($usercompany){
                    \session()->put('company_id',$usercompany->company_id);
                    $data['usercompany'] = \App\UserCompany::where('user_id',Auth::id())->where('company_id',session()->get('company_id'))->first();
                    if ($data['usercompany']->is_owner == 0 && $data['usercompany']->is_admin == 0 && $data['usercompany']->is_member == 0) {
                        if ($data['user']->step_1 == null) {
                            $data['url'] = route('my-account', [$data['user']->id]);
                        } elseif ($data['user']->step_2 == null) {
                            $data['url'] = route('company-profile');
                        } else {
                            $data['url'] = url()->previous();
                        }
                    } else {
                        $data['url'] = url()->previous();
                    }
                }else{

                    \session()->put('company_id','');
                    if (auth()->user()) {
                        if ($data['user']->step_1 == null) {
                            $data['url'] = route('my-account', [$data['user']->id]);
                        } elseif ($data['user']->step_2 == null) {
                            $data['url'] = url()->previous();
                        } else {
                            $data['url'] = url()->previous();
                        }
                    } else {
                        $data['url'] = url()->previous();
                    }
                }

            } else {
                \Auth::logout();
                $data['msg'] = "Sorry, you have been blocked";
                $data['feedback'] = 'invalid';
            }
        } else {
            $data['msg'] = "Invalid Credentials";
            $data['feedback'] = 'invalid';
        }
        return json_encode($data);
    }


    public function registeration_step_1()
    {
        $data['title'] = 'Registration';
        $data['countries'] = \App\Country::all();
        $data['email'] = '';
        if (Session::has('verified_email')) {
            $data['email'] = Session::get('verified_email');
            // Session::forget('verified_email');
            $data['current_country'] = get_country_by_ip();
            return view('front_site.other.registration-form', $data);
        } else {
            return redirect()->route('email-confirmation');
        }
    }

    public function register_user()
    {
        // dd(request()->all());
        $rules = [
            'password' => 'required|min:8', 'confirm_password' => 'required|same:password', 'country_id' => 'required',
            'user_type' => 'required', 'first_name' => 'required',
            'last_name' => 'required', 'registration_phone_no' => 'required|min:10', 'birthday' => 'required',
        ];
        $messages = [
            'password.required' => 'Password is required', 'password.min' => 'Minimum 8 characters required',
            'confirm_password.required' => 'Please re-enter password',
            'confirm_password.same' => 'Password did not matched', 'country_id.required' => 'Please select country',
            'user_type.required' => 'Please select user type', 'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'registration_phone_no.required' => 'Phone number is required',
            'birthday.required' => 'Please select date of birth',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        }
        $exsts = \App\User::where('email', '=', request('email'))->withTrashed()->first();
        if ($exsts) {
            $data['feedback'] = 'other_error';
            // $data['msg'] = steps_form_error_message();
            $data['custom_msg'] = 'This Email already exists';
            $data['id'] = 'email_error';
            return json_encode($data);
        }
        /*if(request('password')){
            $data['feedback'] = 'other_error';
            $data['id'] = 'password_error';
            $data['custom_msg'] = 'Minimum 8 characters required';
            return json_encode($data);
        }*/
        /*if(request('password') != request('confirm_password')){
            $data['feedback'] = 'other_error';
            $data['id'] = 'confirm_password_error';
            $data['custom_msg'] = 'You have entered wrong password';
            return json_encode($data);
        }*/
        $num = preg_replace('/^(?:\+?' . request('registration_phone_no_country_code') . '|0)?/', request('registration_phone_no_country_code'), request('registration_phone_no'));
        $num = ($num == request('registration_phone_no_country_code')) ? '' : $num;
        $user = new \App\User();
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->name = request('first_name') . ' ' . request('last_name');
        $user->email = request('email');
        $user->enc_password = encrypt(request('password'));
        $user->password = Hash::make(request('password'));
        $user->country_id = request('country_id');
        $user->company_name = request('company_name');
        $user->registration_phone_no = str_replace(' ', '', $num);
        $user->birthday = date('Y-m-d H:i:s', strtotime(request('birthday')));
        if (request('industry_information_check'))
            $user->industry_information_check = 1;
        if ($user->save()) {
            if (count(request('user_type')) > 0) {
                foreach (request('user_type') as $key => $value) {
                    $new = new \App\UserType();
                    $new->u_type_id = $value;
                    $new->user_id = $user->id;
                    $new->save();
                    if ($value == 4 && count(request('userservices')) > 0) {
                        foreach (request('userservices') as $key => $value) {
                            $new1 = new \App\UserServices();
                            $new1->user_id = $user->id;
                            $new1->subservice_id = $value;
                            $new1->u_type_id = 4;
                            $new1->save();
                        }
                    }
                }
            }
            \Auth::login($user);
            $data['feedback'] = "true";
            $data['msg'] = 'User has been registered successfully';
            $data['url'] = route('my-account', [$user->id]);
        } else {
            $data['feedback'] = "other";
            $data['custom_msg'] = 'User is not registered';
        }
        return json_encode($data);
    }

    public function my_account($id)
    {
        $data['title'] = 'My Account';

        $country = new Countries();
        $data['countries'] = $country->all();
        // $data['email'] = '';
        if (Session::has('verified_email')) {
            // $data['email'] = Session::get('verified_email');
            Session::forget('verified_email');
        }
        $data['user'] = \App\User::find($id);
        return view('front_site.account.add_form', $data);
    }

    public function save_my_account()
    {
//         dd(request('sub_category'));
        $rules = [
            'country' => 'required', 'first_name' => 'required', 'last_name' => 'required',
            'phone_no' => 'required|min:11', 'state' => 'required', 'city' => 'required', // 'category' => 'required',
            // 'sub_category' => 'required',
        ];
        $messages = [
            'country.required' => 'Please select country', 'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required', 'phone_no.required' => 'Phone number is required',
            'city.required' => 'Please enter your City', 'state.required' => 'Please enter your State',
            // 'category.required' => 'Please select category',
            // 'sub-category.required' => 'Please select sub-category'
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        }
        $user = \App\User::find(request('id'));
        if ($user) {
            $num = preg_replace('/^(?:\+?' . request('whatsapp_number_country_code') . '|0)?/', request('whatsapp_number_country_code'), request('whatsapp_number'));
            $num = ($num == request('whatsapp_number_country_code')) ? '' : $num;
            $telephone_num = preg_replace('/^(?:\+?' . request('telephone_country_code') . '|0)?/', request('telephone_country_code'), request('telephone'));
            $telephone_num = ($num == request('telephone_country_code')) ? '' : $telephone_num;
            $user->first_name = request('first_name');
            $user->last_name = request('last_name');
            $user->website = request('website');
            // $user->phone_no = request('phone_no');
            $user->whatsapp_number = str_replace(' ', '', $num);
            $user->telephone = str_replace(' ', '', $telephone_num);
            $user->fax = request('fax');
            $user->country = request('country');
            $user->state = request('state');
            $user->city = request('city');
            $user->postcode = request('postcode');
            $user->designation = request('designation');
            $user->other_designation = request('other_designation');
            $user->gender = request('gender');
            if (request('sub_category')) {
                foreach (request('sub_category') as $key => $value) {
                    $new = new \App\UserInterest();
                    $new->user_id = $user->id;
                    $new->subcategory_id = $value;
                    $new->save();
                }
            }
            if ($user->save()) {
                $user->step_1 = 1;
                $user->save();
                $data['feedback'] = "true";
                $data['msg'] = 'Account details has been saved successfully';

                $data['url'] = route('user-dashboard');
            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Account details are not saved';
            }
        } else {
            $data['feedback'] = "other";
            $data['custom_msg'] = 'Something went wrong';
        }
        return json_encode($data);
    }

    public function editAccount()
    {
        $title = 'My Account';
        $country = new Countries();
        $countries = $country->all();
        $user = \Auth::user();
        return view('front_site.bizoffice.members.edit-my-account', compact(['title', 'user','countries']));
    }

    public function updateAccount(Request $request)
    {
        $rules = [//            'email' => 'required|email',
                  'first_name' => 'required', 'last_name' => 'required',
                  //            'user_type' => 'required',
                  //            'mobile' => function ($attribute, $value, $fail) {
                  //                if ($value === '+92') {
                  //                    $fail('Mobile number is required.');
                  //                }
                  //            },
                  'mobileNumber' => 'required|min:10', 'city' => 'required', 'state' => 'required',
                  'country' => function ($attribute, $value, $fail) {
                      if ($value === 'Country') {
                          $fail('Country required.');
                      }
                  },
        ];
        $messages = [//            'email.required' => 'Email is required',
                     'email.email' => 'Invalid email', 'first_name.required' => 'First name is required',
                     'first_name.alpha' => 'Only alphabets are allowed',
                     'last_name.required' => 'Last name is required', 'last_name.alpha' => 'Only alphabets are allowed',
                     //            'user_type.required' => 'Please select user type',
                     'mobileNumber.required' => 'Mobile number is required', 'city.required' => 'City is required',
                     'state.required' => 'State is required', 'country.required' => 'Please select country',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['feedback' => 'validation_error', 'errors' => $validator->errors()->getMessages(),]);
        }
        $num = preg_replace('/^(?:\+?' . request('mobile_country_code') . '|0)?/', request('mobile_country_code'), request('mobileNumber'));
        $num = ($num == request('mobile_country_code')) ? '' : $num;
        $whatsappnum = preg_replace('/^(?:\+?' . request('whatsapp_country_code') . '|0)?/', request('whatsapp_country_code'), request('whatsapp'));
        $whatsappnum = ($whatsappnum == request('whatsapp_country_code')) ? '' : $whatsappnum;
        $telephonenum = preg_replace('/^(?:\+?' . request('telephone_country_code') . '|0)?/', request('telephone_country_code'), request('telephone'));
        $telephonenum = ($telephonenum == request('telephone_country_code')) ? '' : $telephonenum;
        $user = \App\User::find(\Auth::id());
        $user->email = $request->email;
        $user->designation = $request->designation;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->registration_phone_no = str_replace(' ', '', $num);
        $user->street_address = $request->street_address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->whatsapp_number = str_replace(' ', '', $whatsappnum);
        $user->telephone = str_replace(' ', '', $telephonenum);
        $user->fax = $request->fax;
        $user->postcode = $request->postcode;
        $user->website = $request->url;
//        dd($user->country_id);
        if ($user->save()) {
            if (!empty($request->user_type)) {
                $user->types()->detach();
                if (count($request->user_type) > 0) {
                    foreach ($request->user_type as $user_type) {
                        $type = new \App\UserType();
                        $type->u_type_id = $user_type;
                        $type->user_id = $user->id;
                        $type->save();
                    }
                }
            }
        }
        return json_encode(['feedback' => 'updated', 'url' => route('my-account-detail'),]);
    }

    public function get_sub_category()
    {
        if (request('categories')) {
            $sub_categories = \App\Subcategory::whereIn('category_id', request('categories'))->get();
            // dd($categories);
            $output = "<option value='' ></option>";
            foreach ($sub_categories as $key => $value) {
                if (request('sub_categories') && count(request('sub_categories')) > 0) {
                    if (\in_array($value->id, request('sub_categories'))) {
                        $output .= "<option selected value='" . $value->id . "'>" . $value->name . "</option>";
                    } else {
                        $output .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
                    }
                } else {
                    $output .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
                }
            }
            $data['output'] = $output;
        } else {
            $data['output'] = '';
        }
        $data['feedback'] = "true";
        return json_encode($data);
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = \App\User::find(\Auth::id());

        return view('front_site.bizoffice.user_dashboard', $data);
    }

    public function livesearch(Request $request){
        $term = $request->get('inpdata');
        $results= [];
        $productsell = DB::table('products')
            ->where('product_service_types','sell')
            ->where("product_service_name","LIKE","%$term%")->first();
        if($productsell){
                $results[] = ['value' => $productsell->product_service_name, 'link' => url('/search-product?category=Regular+Supplier&keywords='.$term),'category' => 'Regular Supplier'];
        }
        $productbuy = DB::table('products')
            ->where('product_service_types','buy')
            ->where("product_service_name","LIKE","%$term%")->first();
        if($productbuy){
                $results[] = ['value' => $productbuy->product_service_name, 'link' => url('/search-product?category=Regular+Buyer&keywords='.$term),'category' => 'Regular Buyer'];
        }
        $productserv = DB::table('products')
            ->where('product_service_types','service')
            ->where("product_service_name","LIKE","%$term%")->first();
        if($productserv){
                $results[] = ['value' => $productserv->product_service_name, 'link' => url('/search-product?category=Regular+Services&keywords='.$term),'category' => 'Service Providers'];
        }
        $buysell = DB::table('buy_sells')
            ->where('product_service_types','sell')
            ->where('date_expire','>', now())->whereNull('deleted_at')
            ->where("product_service_name","LIKE","%$term%")->first();
        if($buysell){
                $results[] = ['value' => $buysell->product_service_name, 'link' => url('/search-product?category=One-Time+Supplier&keywords='.$term),'category' => 'One-Time Supplier'];
        }
        $buysellbuy = DB::table('buy_sells')
            ->where('product_service_types','buy')
            ->where('date_expire','>', now())->whereNull('deleted_at')
            ->where("product_service_name","LIKE","%$term%")->first();
        if($buysellbuy){
                $results[] = ['value' => $buysellbuy->product_service_name, 'link' => url('/search-product?category=One-Time+Buyer&keywords='.$term),'category' => 'One-Time Buyer'];
        }
        $buysellserv = DB::table('buy_sells')
            ->where('product_service_types','service')
            ->where('date_expire','>', now())->whereNull('deleted_at')
            ->where("product_service_name","LIKE","%$term%")->first();
        if($buysellserv){
                $results[] = ['value' => $buysellserv->product_service_name, 'link' => url('/search-product?category=One-Time+Services&keywords='.$term),'category' => 'Service Seekers'];
        }
        $articles = Journal::where('title','Like','%'.$term.'%')->where('journal_type_name','articles')->first();

        if($articles){
                $results[] = ['value' => $articles->title, 'link' => url('/search-product?category=articles&keywords='.$term),'category' => 'Articles'];
        }
        $news = NewsManagement::where('title','Like','%'.$term.'%')->first();
        if($news){
                $results[] = ['value' => $news->title, 'link' => url('/search-product?category=news&keywords='.$term),'category' => 'News'];
        }
        $events = Journal::where('title','Like','%'.$term.'%')->where('journal_type_name','Upcomming Events')->first();
        if($events){
                $results[] = ['value' => $events->title, 'link' => url('/search-product?category=events&keywords='.$term),'category' => 'Events'];
        }
        return json_encode($results);
    }

    public function searchProduct(Request $request)
    {
        $country = new Countries();
        $countries = $country->all();

        $search = $request->query('keywords');
        $category = $request->query('category');
        if ($category =='One-Time Buyer'){
            $buysell = BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%')
                    ->orwhere('product_service_name','Like','%'.$search.'%');
            })->where('product_service_types','buy')->where('date_expire','>', now())->whereNull('deleted_at')->get();

            return view('front_site.product.product-search')->with(['countries'=>$countries,'buysell'=>$buysell,'category'=>$category,'search'=>$search]);
        }elseif ($category =='Regular Buyer'){
            $products = Product::select('products.*', 'products.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%')
                    ->orwhere('product_service_name','Like','%'.$search.'%');
            })->where('product_service_types','buy')->get();
            return view('front_site.product.product-search')->with(['countries'=>$countries,'products'=>$products,'category'=>$category,'search'=>$search]);
        }elseif ($category =='One-Time Supplier'){
            $buysell = BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%')
                    ->orwhere('product_service_name','Like','%'.$search.'%');
            })->where('product_service_types','sell')->where('date_expire','>', now())->whereNull('deleted_at')->get();
            return view('front_site.product.product-search')->with(['countries'=>$countries,'buysell'=>$buysell,'category'=>$category,'search'=>$search]);
        }elseif ($category =='Regular Supplier'){
            $products = Product::select('products.*', 'products.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%')
                    ->orwhere('product_service_name','Like','%'.$search.'%');
            })->where('product_service_types','sell')->get();
            return view('front_site.product.product-search')->with(['countries'=>$countries,'products'=>$products,'category'=>$category,'search'=>$search]);
        }elseif ($category =='One-Time Services'){
            $buysell = BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%')
                    ->orwhere('product_service_name','Like','%'.$search.'%');
            })->where('product_service_types','service')->where('date_expire','>', now())->whereNull('deleted_at')->get();
            return view('front_site.product.product-search')->with(['countries'=>$countries,'buysell'=>$buysell,'category'=>$category,'search'=>$search]);
        }elseif ($category =='Regular Services'){
            $products = Product::select('products.*', 'products.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%')
                    ->orwhere('product_service_name','Like','%'.$search.'%');
            })->where('product_service_types','service')->get();
            return view('front_site.product.product-search')->with(['countries'=>$countries,'products'=>$products,'category'=>$category,'search'=>$search]);
        }elseif ($category =='Reference Number'){
            $products = Product::select('products.*', 'products.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%');
            })->get();
            $buysell = BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('reference_no','Like','%'.$search.'%');
            })->get();
            return view('front_site.product.product-search')->with(['countries'=>$countries,'products'=>$products,'buysell'=>$buysell,'category'=>$category,'search'=>$search]);
        }elseif ($category =='Keywords'){
            $products = Product::select('products.*', 'products.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%');
            })->get();
            $buysell = BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where(function ($q) use ($search){
                $q->where('subject','Like','%'.$search.'%')
                    ->orwhere('keywords','Like','%'.$search.'%');
            })->get();
            return view('front_site.product.product-search')->with(['countries'=>$countries,'products'=>$products,'buysell'=>$buysell,'category'=>$category,'search'=>$search]);
        }elseif ($category =='articles'){
            $articles = Journal::where('title','Like','%'.$search.'%')->where('journal_type_name','articles')->get();
            return view('front_site.journals.articles')->with(['articles'=>$articles,'category'=>$category,'search'=>$search]);
        }elseif ($category =='news'){
            $news = NewsManagement::where('title','Like','%'.$search.'%')->get();
            return view('front_site.journals.news')->with(['data'=>$news,'category'=>$category,'search'=>$search]);
        }elseif ($category =='events'){
            $events = Journal::where('title','Like','%'.$search.'%')->where('journal_type_name','Upcomming Events')->get();
            return view('front_site.journals.events')->with(['articles'=>$events,'category'=>$category,'search'=>$search]);
        }

    }

    public function getStateList(Request $request)
    {
//        $data['states'] = \App\State::where("country_id",$request->country_id)
//            ->get(["name","id"]);
        $countries = new Countries();
        $data['states'] = $countries->where('name.common', $request->country_id)
            ->first()
            ->hydrateStates()
            ->states
            ->pluck('name');
        $data['cities'] = $countries->where('name.common', $request->country_id)
            ->first()
            ->hydrate('cities')
            ->cities
            ->pluck('name');
        return json_encode($data);
    }

    public function getCityList(Request $request)
    {
        $countries = new Countries();
        $city = $countries->where('name.common', $request->state_id)
            ->first()
            ->hydrate('cities')
            ->cities
            ->pluck('name');
        return response()->json(['cities'=>$city]);
    }

    public function notification(){

        if(!auth()->check()){
            $notify='0';
        }else {

            if(strpos(request('current_url'), 'group-chat') != false){
                DB::table('notifications')
                    ->where('user_id', auth()->id())
                    ->where('prod_comp_id',\session()->get('company_id'))
                    ->where('table_name','chats')
                    ->where('table_data','message')
                    ->update(['is_display' => 1,'is_read'=>1]);
            }

            $notify = \App\Notification::where('is_read', 0)->where('user_id', \Auth::user()->id)->count();
            $notifiactions = \App\Notification::where('user_id', auth()->id())->where('is_display', 0)->latest()->first();

            $meetnoti = \App\Notification::where('is_read', 0)->where('table_name', 'meetings')->where('prod_comp_id', session()->get('company_id'))->where('user_id', \Auth::user()->id)->count();
            $chatnoti = \App\Notification::where('is_read', 0)->where('table_name', 'chats')->where('user_id', \Auth::user()->id)->where('prod_comp_id', session()->get('company_id'))->count();

            $leadinq = \App\Notification::where('is_read', 0)->where('table_name', 'inquiries')->where('table_data', 'Lead')->where('user_id', \Auth::user()->id)->where('prod_comp_id', session()->get('company_id'))->count();
            $dealinq = \App\Notification::where('is_read', 0)->where('table_name', 'inquiries')->where('table_data', 'Deal')->where('user_id', \Auth::user()->id)->count();

            $fleadinq = \App\Notification::where('is_read', 0)->where('table_name', 'favourites')->where('table_data', 'Lead')->where('user_id', \Auth::user()->id)->where('prod_comp_id', session()->get('company_id'))->count();
            $fdealinq = \App\Notification::where('is_read', 0)->where('table_name', 'favourites')->where('table_data', 'Deal')->where('user_id', \Auth::user()->id)->count();
            $latest_notification = \App\Notification::where('is_read', 0)->where('user_id', \Auth::user()->id)->latest()->first();
            $output = '';
            foreach(\App\Notification::where('user_id',auth()->id())->where('is_read',0)->latest()->get() as $notifi) {
                $output .= '<li class="links-container">';
                $output .= '<input type="hidden" name="read" value="'.$notifi->id.'"/>';
                if ($notifi->table_name == 'favourites' && $notifi->table_data == 'Lead') {
                    $href = route('get-lead-fav');
                } elseif ($notifi->table_name == 'favourites' && $notifi->table_data == 'Deal')
                    $href = route('get-one-time-fav');
                elseif ($notifi->table_name == 'inquiries' && $notifi->table_data == 'Lead')
                    $href = route('product-inquiries');
                elseif ($notifi->table_name == 'inquiries' && $notifi->table_data == 'Deal')
                    $href = route('buysell-inquiries');
                elseif ($notifi->table_name == 'meetings' && $notifi->table_data == 'schedule')
                    $href = route('company-get-meetings');
                elseif ($notifi->table_name == 'chats' && $notifi->table_data == 'message')
                    $href = route('company-group-chat');

                $output .= '<a href="'.$href. '"class="text-decoration-none is-read"> <p class="small text-uppercase mb-2">'.date("F d,Y", strtotime($notifi->created_at)).'</p> <p class="mb-0">'.$notifi->notification_text.'</p> </a> </li>';
            }
        }
        return  response()->json(['output'=>$output,'notify'=>$notify,'notifiactions'=>$notifiactions,'meetnoti'=>$meetnoti,'chatnoti'=>$chatnoti,'leadinq'=>$leadinq,'dealinq'=>$dealinq,'fleadinq'=>$fleadinq,'fdealinq'=>$fdealinq]);
    }

}
