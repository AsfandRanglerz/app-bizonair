<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Invite;
use App\CompanyImage;
use App\CompanyProfile;
use App\Notification;
use App\UserCompany;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\CompanyHelper;
use App\CompanyProfileIndustry;
use App\Mail\InviteMemberEmail;
use App\Mail\acceptInvitation;
use App\Mail\MeetingReminderEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCompanyRequest;
use App\Jobs\MeetingReminderJob;
use App\User;
use Facades\App\User as UserFacade;

class CompanyController extends Controller
{

    protected $paginator = 0;

    public function __construct()
    {
        $this->paginator = 2;
    }


    public function companyProfile()
    {
        if(auth()->user()){
            $data['title'] = 'Company Profile';
            $data['countries'] = \App\Country::all();
            $data['user'] = \App\User::find(\auth()->id());
            return view('front_site.account.company-profile', $data);
        }else{
            return view('front_site.other.login');
        }
    }

    public function saveCompany(Request $request, CompanyHelper $companyHelper)
    {
        //dd($request->all());
        $validator = $companyHelper->validateCompany();
        if ($validator) {
            return $validator;
        } else {
//            $num = preg_replace('/^(?:\+?' . request('alternate_contact_country_code') . '|0)?/', request('alternate_contact_country_code'), request('alternate_contact'));
//            $num = ($num == request('alternate_contact_country_code')) ? '' : $num;
            $export_market = "";
//            $logo_name="";
//            if($request->hasFile('logo_image')){
//                $image = $request->file('logo_image');
//                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
//                $image->storeAs('companies/',$image_name,'s3');
//                $path = 'companies'.'/'.$image_name;
//                $logo_name = Storage::disk('s3')->url($path);
//            }
            if ($request->export_market) {
                $export_market = implode(',', $request->export_market);
            }
            $certifications = "";
            if ($request->certifications) {
                $certifications = implode(',', $request->certifications);
            }
            $business_type = implode(',', $request->business_type);
            $other_business_type = null;

            if (in_array('Others', $request->business_type)) {
                $other_business_type = $request->other_business_type;
            }
            $other_business_nature = null;
            if ($request->business_nature == 'Other') {
                $other_business_nature = $request->other_business_nature;
            }
            if(empty($request->bavatar31_url)){
                $logo= 'https://bizonairfiles.s3.ap-south-1.amazonaws.com/1627548199287.png';
            }else{
                $logo= $request->bavatar31_url;
            }
            $company = CompanyProfile::create([
                'user_id' => auth()->id(),
                'company_name' => $request->company_name,
                'office_code' =>  $request->office_code,
                'business_nature' => $request->business_nature,
                'registeration_no' => $request->registeration_no,
                'year_established' => $request->year_established,
                'no_of_employees' => $request->no_of_employees,
                'business_type' => $business_type,
                'export_market' => $export_market,
                'other_business_type' => $other_business_type,
                'other_business_nature' => $other_business_nature,
                'logo' => $logo,
                'certifications' => $certifications,
                'annual_turnover' => $request->annual_turnover,
                'company_introduction' => $request->company_introduction,
                'business_owner' => $request->business_owner,
                'alternate_contact' => $request->alternate_contact,
                'alternate_email' => $request->alternate_email,
                'alternate_address' => $request->alternate_address,
            ]);

            $images =  [$request->sheet16_url,$request->sheet17_url,$request->sheet18_url,$request->sheet19_url,$request->sheet20_url,$request->sheet21_url,$request->sheet22_url,$request->sheet23_url,$request->sheet24_url,$request->sheet25_url,$request->sheet26_url,$request->sheet27_url,$request->sheet28_url,$request->sheet29_url,$request->sheet30_url];
            foreach ($images as $image) {
                if ($image) {
                    \App\CompanyImage::create(['company_id' => $company->id, 'image' => $image]);
                }
            }

            foreach ($request->industry as $i) {
                CompanyProfileIndustry::create(['company_id' => $company->id, 'industry_id' => $i,]);
            }
            if ($company) {
                $usercompany = new \App\UserCompany();
                $usercompany->user_id = \Auth::id();
                $usercompany->company_id = $company->id;
                $usercompany->company_name = $company->company_name;
                $usercompany->is_owner = 1;
                $usercompany->is_admin = 1;
                $usercompany->is_member = 0;
                $usercompany->save();

                session()->forget('company_id');
                \session()->put('company_id',$company->id);


                $data['feedback'] = "true";
                $data['msg'] = 'Company has been created successfully';
                $data['url'] = route('user-dashboard');

                $data['company_id'] = $company->id;

            } else {
                $data['feedback'] = "false";
                $data['msg'] = 'Company has not created successfully';
                $data['url'] = route('company-profile');
            }
            return json_encode($data);

        }
    }

    public function editCompany($id)
    {
        $title = 'Company Profile';
        $user = \Auth::user();
        $company = \App\CompanyProfile::where('id',$id)->first();
        // dd($company->images);
        return view('front_site.account.edit-company-profile', compact(['title', 'user', 'company']));
    }

    public function updateCompany(Request $request)
    {
        //dd($request->all());
        $rules = ['company_name' => 'required', 'industry' => 'required', 'business_type' => 'required',];
        $messages = [
            'company_name.required' => 'Company name is required',
            'industry.required' => 'Please select atleast one industry',
            'business_type.required' => 'Please select atleast one business type',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['feedback' => 'validation_error', 'errors' => $validator->errors()->getMessages(),]);
        }
        $company = \App\CompanyProfile::find($request->company_id);
        $company->company_name = $request->company_name;
        // dd($request->business_type);
        if (in_array("Others", $request->business_type)) {
            $company->other_business_type = $request->other_business_type;
        } else {
            $company->other_business_type = null;
        }
//        dd($request->certifications);
        $company->business_type = implode(',', $request->business_type);
        $company->business_nature = $request->business_nature;
        $company->registeration_no = $request->license_reg_no;
        $company->year_established = $request->year_established;
        $company->no_of_employees = $request->no_of_employees;
        $company->annual_turnover = $request->annual_turnover;
        if ($request->export_market != null) {
            $company->export_market = implode(',', $request->export_market);
        }
        if ($request->certifications != null) {
            $company->certifications = implode(',', $request->certifications);
        }

//        if ($request->file('logo_image')) {
//            $logo_name = rand(1000, 9999) . time() . '.' . $request->file('logo_image')->getClientOriginalExtension();
//            $request->file('logo_image')->storeAs('companies/',$logo_name,'s3');
//            $path = 'companies'.'/'.$logo_name;
//            $url = Storage::disk('s3')->url($path);
//            $company->logo = $url;
//        }

        if($request->bavatar31_url){
            $logo= $request->bavatar31_url;
        }else{
            $logo= $company->logo;
        }
//        $num = preg_replace('/^(?:\+?' . request('alternate_contact_country_code') . '|0)?/', request('alternate_contact_country_code'), request('alternate_contact'));
//        $num = ($num == request('alternate_contact_country_code')) ? '' : $num;
        $company->company_introduction = $request->company_introduction;
        $company->business_owner = $request->business_owner;
        $company->alternate_contact = $request->alternate_contact;
        $company->alternate_email = $request->alternate_email;
        $company->alternate_address = $request->alternate_address;
        $company->logo = $logo;

        $images =  [$request->sheet16_url,$request->sheet17_url,$request->sheet18_url,$request->sheet19_url,$request->sheet20_url,$request->sheet21_url,$request->sheet22_url,$request->sheet23_url,$request->sheet24_url,$request->sheet25_url,$request->sheet26_url,$request->sheet27_url,$request->sheet28_url,$request->sheet29_url,$request->sheet30_url];
        foreach ($images as $image) {
            if ($image) {
                \App\CompanyImage::create(['company_id' => $company->id, 'image' => $image]);
            }
        }

        if ($company->save()) {
            $comp = \App\UserCompany::where('company_id',$request->company_id)->get();
            foreach ($comp as $compan){
                $compan->company_name = $request->company_name;
                $compan->save();
            }

            $company->industry()->detach();
            foreach ($request->industry as $industry) {
                CompanyProfileIndustry::create(['company_id' => $company->id, 'industry_id' => $industry,]);
            }
        }

        return json_encode([
            'feedback' => 'updated', 'url' => route('my-bizoffices'), 'company_id' => $company->id,
        ]);
    }

    public function imageRemove()
    {
        try {
            $sheet_id = decrypt(request('sheet_id'));

        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($sheet_id) {
            DB::delete('delete from company_images where id = ?', [$sheet_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Company attachment has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);

    }

    public function companyImages(Request $request)
    {
        if($request->hasFile('avatar')) {
            $image = request()->file('avatar');
            $imageName = rand(1000, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image);
            $img->resize(379, 295, function ($constraint) {
                $constraint->aspectRatio();
            });
            //detach method is the key! Hours to find it... :/
            $resource = $img->stream()->detach();
            \Illuminate\Support\Facades\Storage::disk('s3')->put('companies/' . $imageName, $resource);
            $url = Storage::disk('s3')->url('companies' . '/' . $imageName);
            return response()->json(['url' => $url]);
        }

//        if ($request->file) {
//            $image = $request->file('file');
//            $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
//            $image->storeAs('companies/',$image_name,'s3');
//            $path = 'companies'.'/'.$image_name;
//            $url = Storage::disk('s3')->url($path);
//            CompanyImage::create([
//                'image' => $url, 'title' => $image->getClientOriginalName(), 'company_id' => $request->companyId,
//            ]);
//        }
    }

    public function get_office_code()
    {
        $data['title'] = 'Bizoffice Code';
        $data['user'] = \App\User::find(\Auth::id());
        return view('front_site.bizoffice.edit-office-code', $data);
    }

    public function change_office_code()
    {
        try {
            $company_id = decrypt(request('id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        $rules = ['office_code' => 'required|min:6|max:6',];
        $message = [
            'office_code.required' => 'Please enter Bizoffice code',
            'office_code.min' => 'Office code should not less than 6 digits',
            'office_code.max' => 'Office code should not greater than 6 digits',
        ];
        $validator = Validator::make(\request()->all(), $rules);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            return json_encode($data);
        } else {
            $company = \App\CompanyProfile::find($company_id);

            if ($company->office_code)
                $data['custom_msg'] = 'Office code has been updated successfully'; else
                $data['custom_msg'] = 'Office code has been added successfully';

            $company->office_code = request('office_code');
            if ($company->save()) {
                $data['feedback'] = 'true';

            } else {
                $data['feedback'] = 'other';
                $data['custom_msg'] = 'Something went wrong';
            }
        }
        return json_encode($data);
    }


    ////////////////////////////Members/////////////////////////////////////////////

    public function create()
    {
        if(auth()->user()){
            $data['title'] = 'Add a Member';
            $data['user'] = \App\User::find(\Auth::id());
            return view('front_site.bizoffice.manage-accounts.create', $data);
        }else{
            return view('front_site.other.login');
        }
    }

    public function get_members()
    {
        $data['active'] = 'members';
        $data['title'] = 'Members Directory';
        $data['user'] = \App\User::find(\Auth::id());

        $data['sortBy'] = request('sortby', 'created_at');
        $data['order'] = 'asc';
//        $data['title'] = ucwords(request('condition', 'active') .
//            ' ' . \Str::plural('Members', 2));
        $data['listing'] = \App\UserCompany::where('company_id', '=', session()->get('company_id'));
        if (!empty(request('condition'))) {

            if (request('condition') == 'archived') {
                $data['listing'] = $data['listing']->where('student_status', '!=', null)->orWhere([
                    [
                        'expiry_date', '<', date('m/d/Y')
                    ], [
                        'rto_id', '=', \Auth::user()->userable->id
                    ]
                ]);
            } elseif (request('condition') == 'active') {
                $data['listing'] = $data['listing']->where([
                    ['student_status', '=', null], ['expiry_date', '>', date('m/d/Y')]
                ]);
                rto_student_search($data);
            }
        }

        $data['listing'] = $data['listing']->orderBy($data['sortBy'], $data['order']);
        $data['count'] = $data['listing']->count();
        $data['listing'] = $data['listing']->paginate();
        $data['page'] = 'bizoffice.members.listing';
//         dd($data['listing']);
        return view('front_site.' . $data['page'])->with($data);
    }

    public function inviteMember(Request $request)
    {

//        dd('ok');
        $rules = ['email' => 'required|email'];
        $validator = Validator::make(\request()->all(), $rules);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            return json_encode($data);
        } else {
            $exists = \App\User::where('email', request('email'))->first();

            do {
                $token = \Illuminate\Support\Str::random(12);
                $verification_code = mt_rand(799999, 999999);
            } while (Invite::where('token', $token)->first());

            $invite = Invite::create([
                'email' => $request->email, 'token' => $token, 'company_id' => session()->get('company_id'),'verification_code' => $verification_code,
            ]);

            $user = auth()->user();

            // $code=generate_verification_code();
            \Mail::to($request->get('email'))->send(new InviteMemberEmail($invite, $user));
            if (\Mail::failures()) {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
                return json_encode($data);
            } else {
                $data['feedback'] = 'true';
                $data['custom_msg'] = 'Invitation is sent successfully';
                return json_encode($data);
            }
        }
    }

    public function acceptToken($token, $email)
    {
        $invite = Invite::where('token', $token)->first();
        if (!$invite) {
            abort(404);
        }

        $user = User::where('email', $invite->email)->first();
        $company = CompanyProfile::where('id',$invite->company_id)->first();

        if ($user) {

            \session()->put('company_id', $invite->company_id);

            return view('front_site.bizoffice.members.bizz-office-code', compact('user', 'company', 'token'));
        } else {
            \session()->put('verified_email', $invite->email);
            \session()->put('reciver_email', $email);
            \session()->put('invitation_token', $token);
            \session()->put('office_code', $company->office_code);
            \session()->put('company_id', $invite->company_id);
            return redirect()->route('registeration-step-2');
        }
    }


    public function registeration_step_2()
    {
        $data['title'] = 'Member Registration';
        $data['countries'] = \App\Country::all();
        $data['email'] = '';
        $data['reciever_mail'] = '';
        if (Session::has('verified_email')) {
            $data['email'] = Session::get('verified_email');
            if (Session::has('reciver_email')) {
                $data['reciever_mail'] = Session::get('reciver_email');
            }
            $data['current_country'] = get_country_by_ip();
            return view('front_site.other.registration-member-form', $data);
        } else {
            return redirect()->route('email-confirmation');
        }
    }

    public function assignoffice(Request $request)
    {
//        dd($user);
//        $exist = \App\CompanyProfile::where('office_code', request->office_code)->first();

        $invite = Invite::where('token', $request->token)->first();
        if ($invite) {

            $exist = CompanyProfile::where('office_code', $request->code)->first();
            $user = User::find($request->user);
            if ($exist && $exist->id == $invite->company_id) {
                $usercompany = new \App\UserCompany();
                $usercompany->user_id = $user->id;
                $usercompany->company_id = $exist->id;
                $usercompany->company_name = $exist->company_name;
                $usercompany->is_member = 1;
                $usercompany->save();

                session()->put('company_id',$exist->id);
                Auth::login($user);
                $invite->delete();
                return json_encode(['feedback' => 'success', 'url' => route('user-dashboard'),]);
//            return redirect()->route('user-dashboard');
            } else {
//            dd('error');
                return json_encode(['feedback' => 'error', 'msg' => 'Invalid invitation code.',]);
            }
        } else {
            return json_encode(['feedback' => 'error', 'msg' => 'Invitation is expired.',]);
        }
    }

    public function register_member()
    {

//        dd(request('email'));
        $rules = [
            'password' => 'required|min:8', 'confirm_password' => 'required|same:password',
            'user_type' => 'required',
            // 'company_name' => 'required',
            // 'designation' => 'required',
            'registration_phone_no' => 'required',
            //            'office_code' => 'required',
            'gender' => 'required', 'birthday' => 'required',
        ];
        $messages = [
            'password.required' => 'Password is required', 'password.min' => 'Minimum 8 characters required',
            'confirm_password.required' => 'Please re-enter password',
            'confirm_password.same' => 'Password did not matched',
            // 'designation.required' => 'Please select your designation',
            'user_type.required' => 'Please select user type',
            'registration_phone_no.required' => 'Phone number is required',
            // 'company_name.required' => 'Company name is required',
            //            'office_code.required' => 'Biz office code is required for members',
            'gender.required' => 'Please select gender', 'birthday.required' => 'Please select date of birth',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        }
        $exsts = \App\User::where('email', '=', request('email'))->withTrashed()->first();
        if ($exsts && $exsts->my_office) {
            $data['feedback'] = 'other_error';
            // $data['msg'] = steps_form_error_message();
            $data['custom_msg'] = 'This Email already exists';
            $data['id'] = 'email_error';
            return json_encode($data);
        }
        /*if(!preg_match("/^(?=.*[a-z])(?=.*\d)[a-zA-Z0-9].{7,}$/", request('password'))){
            $data['feedback'] = 'other_error';
            $data['id'] = 'password_error';
            $data['custom_msg'] = '8 characters minimum, alphabets and numeric';
            return json_encode($data);
        }
        if(request('password') != request('confirm_password')){
            $data['feedback'] = 'other_error';
            $data['id'] = 'confirm_password_error';
            $data['custom_msg'] = 'You have entered wrong password';
            return json_encode($data);
        }*/
//        $exist = \App\CompanyProfile::where('office_code', request('office_code'))->first();
        $invite = Invite::where('token', Session::get('invitation_token'))->first();
        if (!$invite) {
            $data['feedback'] = 'other_error';
            $data['id'] = 'office_code_error';
            $data['custom_msg'] = 'Invitation is expired.';
            return json_encode($data);
        }
//        if (!$exist) {
//            $data['feedback'] = 'other_error';
//            $data['id'] = 'office_code_error';
//            $data['custom_msg'] = 'Invalid office code';
//            return json_encode($data);
//        }
//        if ($exist->id != $invite->company_id) {
//            $data['feedback'] = 'other_error';
//            $data['id'] = 'office_code_error';
//            $data['custom_msg'] = 'Invalid office code';
//            return json_encode($data);
//        }

        $em = request('email');
        $user = User::where('email', $em)->first();
//        dd($user);
        if ($user) {
//            $user = User::where('email',Auth::user()->email)->get()->first();
        } else {
            $user = new User();
            $user->email = request('email');
        }


        $user->enc_password = encrypt(request('password'));
        $user->password = Hash::make(request('password'));
        $user->country_id = request('country_id');
        $user->designation = request('designation');
        $user->company_name = request('company_name');
        $user->registration_phone_no = request('registration_phone_no');
        if(request()->hasFile('avatar')){
            $image = request()->file('avatar');
            $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('users/',$image_name,'s3');
            $path = 'users'.'/'.$image_name;
            $url = Storage::disk('s3')->url($path);
            $user->avatar = $url;

        }else{
            if(request('gender') == 'Female'){
                $user->avatar = 'https://bizonairfiles.s3.ap-south-1.amazonaws.com/users/82441633072560.png';
            }else{
                $user->avatar = 'https://bizonairfiles.s3.ap-south-1.amazonaws.com/users/85581631173146.png';
            }
        }
        $user->gender = request('gender');
        $user->birthday = \Carbon\Carbon::parse(request('birthday'))->startOfDay();
        $user->is_member = 1;
        $user->company_id = $invite->company_id;

        if ($user->save()) {
            //resend mail

            \Mail::to(\request('reciever'))->send(new acceptInvitation(request('email')));

            if (\Mail::failures()) {
                return 'mail not send successfully';
            }

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

            $comprofile = \App\CompanyProfile::where('id',$invite->company_id)->first();
            $usercompany = new \App\UserCompany();
            $usercompany->user_id = $user->id;
            $usercompany->company_id = $comprofile->id;
            $usercompany->company_name = $comprofile->company_name;
            $usercompany->is_member = 1;
            $usercompany->save();
            \session()->put('company_id',$usercompany->company_id);
            \Auth::login($user);

            $data['feedback'] = "true";
            $data['msg'] = 'User has been registered successfully';
            $data['url'] = route('my-account',auth()->id());
            if (Session::has('verified_email')) {
                // $data['email'] = Session::get('verified_email');
                Session::forget('verified_email');
            }

        } else {
            $data['feedback'] = "other";
            $data['custom_msg'] = 'User is not registered';
        }
        return json_encode($data);
    }

    public function company_remove_user_from_group()
    {
        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($user_id) {
            $user = \App\User::where('id',$user_id)->first();
            $usercompany = \App\UserCompany::where('user_id',$user_id)->where('company_id',session()->get('company_id'))->first();

            \Mail::to($user->email)->send(new \App\Mail\CompanyRemoveUserGroup($usercompany));
            if ($usercompany) {
//                $usercompany->company_id = null;
//                $usercompany->is_member = 0;
//                $usercompany->save();
                $usercompany->delete();
                $data['feedback'] = 'true';
                $data['msg'] = 'Member has been removed successfully';
            } else {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function change_user_member_status()
    {
        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($user_id) {
            $usercompany = \App\UserCompany::where('user_id',$user_id)->where('company_id',\session()->get('company_id'))->first();
            if ($usercompany) {
                if ($usercompany->is_admin == 1) {
                    $usercompany->is_admin = 0;
                    $usercompany->save();
                    $data['feedback'] = 'true';
                    $data['msg'] = 'User has been unmarked as admin successfully';
                } else {
                    $usercompany->is_admin = 1;
                    $usercompany->save();
                    $data['feedback'] = 'true';
                    $data['msg'] = 'User has been marked as admin successfully';
                }
            } else {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function leave_office(Request $request)
    {
        $usercompany = \App\UserCompany::where('user_id',request('user_id'))->where('company_id',request('company_id'))->first();
        \DB::delete('delete from user_companies where id = ?',[$usercompany->id]);
        session()->forget('company_id');
        $usercomp = \App\UserCompany::where('user_id',Auth::id())->first();
        if($usercomp){
            \session()->put('company_id',$usercomp->company_id);
        }else{
            \session()->put('company_id','');
        }

        if ($usercompany) {
            $data['feedback'] = 'true';
            $data['msg'] = 'Office Leaved';
            $data['url'] = route('user-dashboard');

        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }


    ///////////////////////////User Avatar////////////////////////////

    public function uploadAvatar(Request $request)
    {
        $user = \App\User::find(\Auth::id());
        if($request->hasFile('avatar')){
            $image = $request->file('avatar');
            $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('users/',$image_name,'s3');
            $path = 'users'.'/'.$image_name;
            $url = Storage::disk('s3')->url($path);
            $user->avatar = $url;
            $user->save();
            return response()->json(['url'=>$url]);
        }

    }

    /////////////////////////Group Chat//////////////////////////////

    public function group_chat()
    {
        if(auth()->user()){
            $data['title'] = 'Group Chat';
            $data['user'] = \App\User::find(\Auth::id());
            DB::table('notifications')
                ->where('user_id', auth()->id())
                ->where('prod_comp_id',\session()->get('company_id'))
                ->where('table_name','chats')
                ->where('table_data','message')
                ->update(['is_display' => 1,'is_read'=>1]);
            return view('front_site.bizoffice.group-chat.chat', $data);
        }else{
            return view('front_site.other.login');
        }
    }

    public function fetch_messages()
    {
        $messages = \App\Message::where('company_id', session()->get('company_id'))->with('user')->get();
        // dd($messages);
        $data = [];
        foreach ($messages as $key => $value) {

            $qoute_msg = null;
            if($value->quote_msg_id)
                $qoute_msg = \App\Message::where('id',$value->quote_msg_id)->first();


            array_push($data, [
                'id' => $value->id,
                'sender_id' => $value->sender_id,
                'company_id' => $value->company_id,
                'message' => $value->message,
                'file_path' => $value->file_path,
                'file_ext' => $value->file_type,
                'extension' => $value->extension,
                'file_name' => $value->file_name,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
                'user' => [
                    'id' => $value->user->id,
                    'name' => $value->user->name,
                    'first_name' => $value->user->first_name,
                    'last_name' => $value->user->last_name,
                    'avatar' => ($value->user->avatar != 'https://bizonairfiles.s3.ap-south-1.amazonaws.com/users/85581631173146.png') ?  $value->user->avatar : 'https://bizonairfiles.s3.ap-south-1.amazonaws.com/users/85581631173146.png',
                ],
                'quote' => $qoute_msg? ['id' => $qoute_msg->id , 'message' => $qoute_msg->message, 'file_path' => $qoute_msg->file_path , 'file_type' => $qoute_msg->file_type , 'extension' => $qoute_msg->extension] : null
            ]);
        }
        return $data;
    }

    public function send_message()
    {
        $user = \Auth::user();
        $message = new \App\Message();
        $message->sender_id = $user->id;
        $message->company_id = session()->get('company_id');
        $message->message = request('message', '');
        if(request('quote_msg_id') != 0){
            $message->quote_msg_id = request('quote_msg_id');
        }
        if (request()->file('attachment')) {
            $file = request()->file('attachment');
            $file_name = rand(10000, 99999) . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('chat/',$file_name,'s3');
            $path = 'chat'.'/'.$file_name;
            $url = Storage::disk('s3')->url($path);
            $message->file_path = $url;
            $message->file_type = request('file_type');
            $message->extension = request('extension');
            $message->file_name = request('file_name');

        }

        $company = \App\UserCompany::where('user_id','!=',auth()->id())->where('company_id', session()->get('company_id'))->get();

        foreach ($company as $comp) {
            $noti = \App\Notification::where('table_name','chats')->where('user_id',$comp->user_id)->where('is_read',0)->count();
            $inc = $noti+1;
            $notification = new Notification();
            $notification->user_id = $comp->user_id;
            $notification->table_name = 'chats';
            $notification->table_data = 'message';
            $notification->prod_comp_id = $comp->company_id;
            $notification->notification_text = ' You have unread messages on group ' . $comp->company_name;
            $notification->save();
        }
        $message->save();

        $quoted_message = \App\Message::where('id', $message->quote_msg_id)->first();

        broadcast(new \App\Events\MessageSent($user, $message, $quoted_message))->toOthers();

        return ['status' => 'Message Sent!', 'id' => $message->id];
    }

    public function download_message_attachment()
    {
        $message = \App\Message::where('company_id', session()->get('company_id'))->where('id', request('id'))->first();
        if ($message) {
            return response()->download($message->file_path);
        }
    }

    public function get_user()
    {
        // dd(request('user'));
        return \App\User::find(request('user'));
    }

    //////////////////////////////Meetings////////////////////

    public function get_meetings()
    {
        if(auth()->user()){
            $data['active'] = 'meeting';
            $data['title'] = 'Planned Meetings';
            $data['user'] = \App\User::find(\Auth::id());
            $data['sortBy'] = request('sortby', 'meetingtime');
            $data['order'] = 'desc';
            //        $data['title'] = ucwords(request('condition', 'active') .
            //            ' ' . \Str::plural('Meetings', 2));
            $data['listing'] = \App\Meeting::select(\DB::raw("TIMESTAMPDIFF(SECOND,TIMESTAMP(STR_TO_DATE(meeting_date, '%d-%m-%Y'), STR_TO_DATE(meeting_time, '%H:%i')), now()) as meetingtime, meetings.*, case when TIMESTAMPDIFF(SECOND,TIMESTAMP(STR_TO_DATE(meeting_date, '%d-%m-%Y'), STR_TO_DATE(meeting_time, '%H:%i')), now()) < 0 THEN 1 else 0 end as isgreater"))->where('company_id', session()->get('company_id'));
            // if(!empty(request('condition')))
            // {

            //     if(request('condition') == 'archived')
            //     {
            //         $data['listing'] = $data['listing']->where('student_status','!=' , null)->orWhere([['expiry_date', '<', date('m/d/Y')],['rto_id','=', \Auth::user()->userable->id]]);
            //     }elseif(request('condition') == 'active'){
            //         $data['listing'] = $data['listing']->where([['student_status','=' , null],['expiry_date','>', date('m/d/Y')]]);
            //             rto_student_search($data);
            //     }
            // }
            $data['listing'] = $data['listing']->orderBy('isgreater', 'desc');
            $data['listing'] = $data['listing']->orderBy($data['sortBy'], $data['order']);
            $data['count'] = $data['listing']->count();
            $data['listing'] = $data['listing']->paginate();
            $data['page'] = 'bizoffice.meetings.listing';
            //         dd($data['listing']);
            DB::table('notifications')
                ->where('user_id', auth()->id())
                ->where('prod_comp_id',\session()->get('company_id'))
                ->where('table_name','meetings')
                ->where('table_data','schedule')
                ->update(['is_display' => 1,'is_read'=>1]);
            return view('front_site.' . $data['page'])->with($data);
        }else{
            return view('front_site.other.login');
        }
    }

    public function create_meeting()
    {
        $data['title'] = 'Schedule Meeting';
        $data['user'] = \App\User::find(\Auth::id());
        return view('front_site.bizoffice.meetings.create', $data);
    }

    public function save_meeting()
    {
//        dd(request('reminde_before'));
        $rules = [
            'title' => 'required', 'detail' => 'required', 'meeting_date' => 'required', 'reminde_before' => 'required',
            'meeting_time' => 'required',
        ];
        $messages = [
            'title.required' => 'Meeting title is required', 'detail.required' => 'Meeting detail is required',
            'meeting_date.required' => 'Meeting date is required',
            'reminde_before.required' => 'Select reminder day is required',
            'meeting_time.required' => 'Meeting time is required',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {
            $meeting = new \App\Meeting();
            $meeting->title = request('title');
            $meeting->detail = request('detail');
            $meeting->meeting_date = request('meeting_date');
            $meeting->reminde_before = request('reminde_before');
            $meeting->meeting_time = request('meeting_time');
            $meeting->company_id = session()->get('company_id');
            $meeting->created_by = \Auth::id();

            if ($meeting->save()) {
                //         if (1 == 1) {
                $company = \App\UserCompany::where('user_id','!=',auth()->id())->where('company_id', session()->get('company_id'))->get();
                foreach ($company as $comp){

                    $notification = new Notification();
                    $notification->user_id = $comp->user_id;
                    $notification->table_name = 'meetings';
                    $notification->table_data = 'schedule';
                    $notification->prod_comp_id = $comp->company_id;
                    $notification->notification_text = ' Meeting ' . $meeting->title . ' created by ' . auth()->user()->name;
                    $notification->save();
                }
                $companyId = session()->get('company_id');
                $members = UserCompany::where('company_id',$companyId)->with('user')->get();

                $member_emails = [];
                foreach ($members as $member){
                    array_push($member_emails,$member->user->email);
                }
//                dd($member_emails);
                $days = (now()->startOfDay()->diffInDays($meeting->meeting_date)) - $meeting->reminde_before;
                \Mail::to(\Auth::user()->email)->cc($member_emails)->send(new MeetingReminderEmail($meeting));
                foreach ($members as $member) {
                    MeetingReminderJob::dispatch($member->user, $meeting)->delay(now()->startOfDay()->addDays($days))->onQueue('default');
                }

                $data['feedback'] = "true";
                $data['msg'] = 'Meeting has been saved successfully';
                $data['url'] = route('company-get-meetings');

            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }

    public function my_biz_office()
    {
        $user = \Auth::user();
        return view('front_site.bizoffice.my-biz-office', compact('user'));
    }

    public function my_bizoffices()
    {
        $data['active'] = 'My Biz Offices';
        $data['title'] = 'My Biz Offices';
        $data['user'] = \App\User::find(\auth()->id());
        $data['order'] = 'desc';
        $data['company'] = \App\UserCompany::where('user_id','=',auth()->user()->id)->with('company');
        $data['count'] = $data['company']->count();
        $data['company'] = $data['company']->paginate(10);
        $data['page'] = 'bizoffice.members.my-bizoffices';


        return view('front_site.' . $data['page'])->with($data);
    }

    public function change_company($id)
    {
        session()->forget('company_id');
        session()->put('company_id', $id);
        return redirect()->back();
    }

    public function remove_company()
    {
        try {
            $companies_id = decrypt(request('companies_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($companies_id) {

            if(session()->get('company_id') == $companies_id){
                session()->forget('company_id');
                DB::delete('delete from company_profiles where id = ?', [$companies_id]);
                DB::delete('delete from user_companies where company_id = ?', [$companies_id]);
                $user = \App\UserCompany::where('user_id',auth()->id())->first();
                if($user){
                    session()->put('company_id', $user->company_id);
                }
            }else{
                DB::delete('delete from company_profiles where id = ?', [$companies_id]);
                DB::delete('delete from user_companies where company_id = ?', [$companies_id]);
            }

            $data['feedback'] = 'true';
            $data['msg'] = 'Company has been deleted successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function get_company_online_users()
    {
        $ids = request()->online_users;
        $users = UserFacade::allOnline();
        $users = $users->whereIn('id', $ids)->pluck('id');
        echo json_encode($users->toArray());
    }

    public function ajax_company_id_get(Request $request)
    {
        $data = $request->all();
        session()->put('company_id', $request->company_id);
        $data['url'] = route('my-company-profile',$request->company_id);
        return json_encode($data);
    }
}
