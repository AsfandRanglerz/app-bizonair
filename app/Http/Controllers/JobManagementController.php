<?php

namespace App\Http\Controllers;
use App\JobManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PragmaRX\Countries\Package\Countries;

class JobManagementController extends Controller
{
    public  function get_view_job_management()
    {
        $data['active'] = 'job';
        $data['title'] = 'Jobs';
        $data['user'] = \App\User::find(\auth()->id());
        $data['order'] = 'desc';
        $data['job'] = \App\JobManagement::where('user_id','=',auth()->user()->id);
        $data['count'] = $data['job']->count();
        $data['job'] = $data['job']->get();
        $data['page'] = 'bizoffice.jobs.job-management';


        return view('front_site.' . $data['page'])->with($data);

    }

    public  function get_view_all_cvs()
    {
        $data['active'] = 'CVs';
        $data['title'] = 'CVs';
        $data['user'] = \App\User::find(\auth()->id());
        $data['order'] = 'desc';
        $data['cv'] = \App\UploadCv::where('user_id','=',auth()->user()->id);
        $data['count'] = $data['cv']->count();
        $data['cv'] = $data['cv']->get();
        $data['page'] = 'bizoffice.jobs.cv-management';


        return view('front_site.' . $data['page'])->with($data);

    }

    public  function get_view_form_job_management()
    {

        $data['user'] = \App\User::find(\auth()->id());
        $country = new Countries();
        $data['countries'] = $country->all();
        return view('front_site.bizoffice.jobs.job-management-form', $data);
    }

    public  function store_view_job_management(Request $request)
    {

        $rules = [
            'title' => 'required',
            'designation'=>'required',
            'email'=>'required',
            'salary' => 'required',
            'functional_area'=>'required',
            'textile_sector'=>'required',
            'job_type'=>'required',
            'job_level'=>'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'gender' => 'required',
            'work_experience' => 'required',
            'qualification' => 'required',
            'skills' => 'required',
            'vacancies' => 'required',
            'datePicker' => 'required',
        ];
        $messages = [
            'title.required' => 'job title is required',
            'designation.required' => 'job designation is required',
            'email.required' => 'email is required',
            'salary.required' => 'job salary is required',
            'functional_area.required' => 'job functional area is required',
            'textile_sector.required' => 'job sector is required',
            'city.required' => 'job city name is required',
            'work_experience.required' => 'job experience is required',
            'qualification.required' => 'job qualification is required',
            'skills.required' => 'job skills is required',
            'vacancies.required' => 'job vacancies is required',
            'datePicker.required' => 'job date is required',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {
            $job = new \App\JobManagement();
            $job->title= request('title');
            $job->user_id = \Auth::user()->id;
            $job->designation= request('designation');
            $job->job_description= request('job_description');
            $job->email= request('email');
            $job->salary= request('salary');
            $job->job_type= request('job_type');
            $job->functional_area= request('functional_area');
            $job->textile_sector= request('textile_sector');
            $job->salary_unit= request('unit');
            $job->job_level= request('job_level');
            $job->address= request('address');
            $job->city= request('city');
            $job->country= request('country');
            $job->work_hour= request('work_hour');
            $job->qualification= request('qualification');
            $job->skills= request('skills');
            $job->work_experience= request('work_experience');
            $job->vacancies= request('vacancies');
            $job->closing_date= request('datePicker');
            $job->gender = request('gender');
            if(request('company') == 'Other'){
                $job->company = request('ocompany');
            }else{
                $job->company = request('company');
            }

            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $file = 'assets/front_site/jobs/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $job->image = $path;
            }

            $job->save();

            if (1 == 1) {

                $data['feedback'] = "true";
                $data['msg'] = 'Job has been saved successfully';
                $data['url'] = route('view-job-management');


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }

    public  function edit_job_management($id)
    {
        $data['user'] = \App\User::find(\auth()->id());
        $country = new Countries();
        $data['countries'] = $country->all();
        $data['info'] = \App\JobManagement::where('id','=',$id)->first();

        return view('front_site.bizoffice.jobs.job-management-edit', $data);

    }

    public function update_job_management(Request $request)
    {

        $rules = [
            'title' => 'required',  'salary' => 'required',
            'city' => 'required','work_experience' => 'required','datePicker' => 'required',
        ];
        $messages = [
            'title.required' => 'job title is required',
            'salary.required' => 'job salary is required',
            'city.required' => 'job city name is required',
            'work_experience.required' => 'job experience is required',
            'datePicker.required' => 'job date is required',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {

            $job = JobManagement::find($request->id);
            $job->id= request('id');
            $job->title= request('title');
            $job->user_id = request('user_id');
            $job->designation= request('designation');
            $job->job_description= request('job_description');
            $job->email= request('email');
            $job->salary= request('salary');
            $job->job_type= request('job_type');
            $job->functional_area= request('functional_area');
            $job->textile_sector= request('textile_sector');
            $job->salary_unit= request('unit');
            $job->job_level= request('job_level');
            $job->address= request('address');
            $job->city= request('city');
            $job->country= request('country');
            $job->work_hour= request('work_hour');
            $job->qualification= request('qualification');
            $job->skills= request('skills');
            $job->work_experience= request('work_experience');
            $job->vacancies= request('vacancies');
            $job->closing_date= request('datePicker');
            $job->gender = request('gender');

            if(request('company') == 'Other'){
                $job->company = request('ocompany');
            }else{
                $job->company = request('company');
            }

            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $file = 'assets/front_site/jobs/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $job->image = $path;
            }else{
                $job->image = JobManagement::where('id',$request->id)->first()->image;
            }
            $job->save();

            if (1 == 1) {

                $data['feedback'] = "true";
                $data['msg'] = 'Job has been Updated successfully';
                $data['url'] = route('view-job-management');


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }


    public function company_remove_job_from_group()
    {
        try {
            $job_id = decrypt(request('job_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($job_id) {
            $job = JobManagement::find($job_id);
            $job->delete();

            $data['feedback'] = 'true';
            $data['msg'] = 'Job has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }
        public function remove_cv()
    {
        try {
            $cv_id = decrypt(request('cv_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($cv_id) {

            DB::delete('delete from upload_cvs where id = ?', [$cv_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Cv removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public  function post_ur_cv()
    {

        $data['user'] = \App\User::find(\auth()->id());
        $country = new Countries();
        $data['countries'] = $country->all();
        return view('front_site.bizoffice.jobs.job-post-cv-form', $data);
    }

    public function store_cv(Request $request)
    {
//        dd($request->all());
        $rules = [
            'fname' => 'required',
            'lname'=>'required',
            'phone_no'=>'required',
            'email' => 'required',
            'total_experience'=>'required',
            'edu_level'=>'required',
            'functional_area'=>'required',
            'textile_sector'=>'required',
            'exp_salary' => 'required',
            'unit' => 'required',
            'city' => 'required',
            'country' => 'required',
            'key_skills' => 'required',
        ];
        $messages = [
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
            'phone_no.required' => 'Phone number is required',
            'email.required' => 'Email is required',
            'total_experience.required' => 'Total Experience is required',
            'edu_level.required' => 'Education level is required',
            'functional_area.required' => 'Functional area is required',
            'textile_sector.required' => 'Job sector is required',
            'exp_salary.required' => 'Expected salary is required',
            'unit.required' => 'Salary unit is required',
            'city.required' => 'City is required',
            'country.required' => 'Country is required',
            'key_skills.required' => 'Key Skill is required',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {
            $data['postcv']= new \App\UploadCv();
            $data['postcv']->user_id= auth()->id();
            $data['postcv']->fname= request('fname');
            $data['postcv']->lname = request('lname');
            $data['postcv']->phone_no= request('phone_no');
            $data['postcv']->email= request('email');
            $data['postcv']->total_experience= request('total_experience');
            $data['postcv']->edu_level= request('edu_level');
            $data['postcv']->functional_area= request('functional_area');
            $data['postcv']->textile_sector= request('textile_sector');
            $data['postcv']->exp_salary= request('exp_salary');
            $data['postcv']->sal_unit= request('unit');
            $data['postcv']->city= request('city');
            $data['postcv']->country= request('country');
            $data['postcv']->key_skills= request('key_skills');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(10000, 99999) . time() . '.' . $image->getClientOriginalExtension();
                $file = 'assets/front_site/cvs/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $data['postcv']->image = $path;
            }

            $data['postcv']->save();
            if ($data['postcv']->save()) {
                $data['feedback'] = "true";
                $data['msg'] = 'CV uploaded successfully';
                $data['url'] = route('view-all-cvs');
            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }

    public  function edit_cv_management($id)
    {
        $data['user'] = \App\User::find(\auth()->id());
        $country = new Countries();
        $data['countries'] = $country->all();
        $data['info'] = \App\UploadCv::where('id','=',$id)->first();

        return view('front_site.bizoffice.jobs.cv-management-edit', $data);

    }

    public function update_cv_management(Request $request)
    {
        $rules = [
            'fname' => 'required',
            'lname'=>'required',
            'phone_no'=>'required',
            'email' => 'required',
            'total_experience'=>'required',
            'edu_level'=>'required',
            'functional_area'=>'required',
            'textile_sector'=>'required',
            'exp_salary' => 'required',
            'unit' => 'required',
            'city' => 'required',
            'country' => 'required',
            'key_skills' => 'required',
        ];
        $messages = [
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
            'phone_no.required' => 'Phone number is required',
            'email.required' => 'Email is required',
            'total_experience.required' => 'Total Experience is required',
            'edu_level.required' => 'Education level is required',
            'functional_area.required' => 'Functional area is required',
            'textile_sector.required' => 'Job sector is required',
            'exp_salary.required' => 'Expected salary is required',
            'unit.required' => 'Salary unit is required',
            'city.required' => 'City is required',
            'country.required' => 'Country is required',
            'key_skills.required' => 'Key Skill is required',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {

            $user_id= request('user_id');
            $id= request('id');
            $fname= request('fname');
            $lname = request('lname');
            $phone_no= request('phone_no');
            $email= request('email');
            $total_experience= request('total_experience');
            $edu_level= request('edu_level');
            $functional_area= request('functional_area');
            $textile_sector= request('textile_sector');
            $exp_salary= request('exp_salary');
            $sal_unit= request('unit');
            $city= request('city');
            $country= request('country');
            $key_skills= request('key_skills');
            $image_path = null;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(10000, 99999) . time() . '.' . $image->getClientOriginalExtension();
                $file = 'assets/front_site/cvs/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $image_path = $path;
            }else{
                $image_path = \App\UploadCv::where('id',$request->id)->first()->image;
            }
            DB::update('update upload_cvs set fname="'.$fname.'",user_id="'.$user_id.'",lname="'.$lname.'",phone_no="'.$phone_no.'",email="'.$email.'",total_experience="'.$total_experience.'",edu_level="'.$edu_level.'",functional_area="'.$functional_area.'",textile_sector="'.$textile_sector.'",exp_salary="'.$exp_salary.'",sal_unit="'.$sal_unit.'",city="'.$city.'",country="'.$country.'",key_skills="'.$key_skills.'",image="'.$image_path.'" where id = ?', [$id]);


            if (1 == 1) {

                $data['feedback'] = "true";
                $data['msg'] = 'CV has been Updated successfully';
                $data['url'] = route('view-all-cvs');


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }

}
