<?php

namespace App\Http\Controllers;

use App\JobManagement;
use App\UploadCv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PragmaRX\Countries\Package\Countries;

class CareerController extends Controller
{
    public function jobs_directory(Request $request)
    {

        if ($request->has('byfunction') && !empty($request->query('byfunction'))){
            $jobs = JobManagement::where('functional_area','Like','%'.$request->query('byfunction').'%')->get();
        }elseif ($request->has('bylocation') && !empty($request->query('bylocation'))){
            $jobs = JobManagement::where('city','Like','%'.$request->query('bylocation').'%')->get();
        }elseif ($request->has('bysector') && !empty($request->query('bysector'))){
            $jobs = JobManagement::where('textile_sector','Like','%'.$request->query('bysector').'%')->get();
        }elseif ($request->has('job-title') && !empty($request->query('job-title')) && $request->has('job-location') && !empty($request->query('job-location'))){
            $title = $request->query('job-title');
            $location =$request->query('job-location');
                $jobs = JobManagement::where(function ($q)use($title){
                    $q->where('title','Like','%'.$title.'%');
                    $q->orwhere('skills','Like','%'.$title.'%');
                    $q->orwhere('company','Like','%'.$title.'%');
                    $q->orwhere('other_company','Like','%'.$title.'%');
                })->where(function ($q)use($location){
                    $q->where('address','Like','%'.$location.'%');
                    $q->orwhere('city','Like','%'.$location.'%');
                    $q->orwhere('country','Like','%'.$location.'%');
                })->get();
        }else{
            $jobs = \App\JobManagement::all();
        }
        $data['jobs'] = $jobs;
        $data['page'] = 'jobs.job-directory';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function cv_directory(Request $request)
    {
        if ($request->has('cv-title') && !empty($request->query('cv-title')) && $request->has('cv-location') && !empty($request->query('cv-location'))){
            $title = $request->query('cv-title');
            $location =$request->query('cv-location');
            $cvs = UploadCv::where(function ($q)use($title){
                $q->where('fname','Like','%'.$title.'%');
                $q->orwhere('key_skills','Like','%'.$title.'%');
                $q->orwhere('functional_area','Like','%'.$title.'%');
                $q->orwhere('textile_sector','Like','%'.$title.'%');
            })->where(function ($q)use($location){
                $q->orwhere('city','Like','%'.$location.'%');
                $q->orwhere('country','Like','%'.$location.'%');
            })->get();
        }else{
            $cvs = \App\UploadCv::all();
        }

        $data['cvs'] = $cvs;
        $data['page'] = 'jobs.cv-directory';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function jobs_portal()
    {
        $data['latest_jobs'] = \App\JobManagement::latest()->take(6)->get();
        $data['jobs'] = JobManagement::all();
        $data['page'] = 'jobs.job-portal';
        $country = new Countries();
        $data['countries'] = $country->all();
        $data['bfarea'] = \App\JobManagement::select('functional_area', DB::raw('count(*) as total'))
            ->groupBy('functional_area')->orderBy('total','desc')->limit(10)->get();
        $data['bcity'] = \App\JobManagement::select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(10)->get();
        $data['bsector'] = \App\JobManagement::select('textile_sector', DB::raw('count(*) as total'))
            ->groupBy('textile_sector')->orderBy('total','desc')->limit(10)->get();
        return view('front_site.' . $data['page'])->with($data);


    }

    public function jobs_detail($id)
    {
        $data['jobsdet'] = \App\JobManagement::where('id',$id)->get();
        $data['suggestions'] = JobManagement::where('functional_area','Like','%'.$data['jobsdet'][0]->functional_area.'%')->take(6)->get();
        $data['page'] = 'jobs.job-detail';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function cvs_detail($id)
    {
        $data['cvsdet'] = \App\UploadCv::where('id',$id)->get();
        $data['suggestions'] = UploadCv::where('key_skills','Like','%'.$data['cvsdet'][0]->key_skills.'%')->where('functional_area','Like','%'.$data['cvsdet'][0]->functional_area.'%')
            ->where('textile_sector','Like','%'.$data['cvsdet'][0]->textile_sector.'%')->take(6)->get();
        $data['page'] = 'jobs.cvs-detail';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function jobSearchFilter(Request $request)
    {
        $min = $request->query('min-value');
        $max = $request->query('max-value');
        $data['jobs'] = JobManagement::whereBetween('salary',[intval($min),intval($max)])
                                ->when($request->title,function ($q)use($request){
                                    $q->where('title','Like','%'.$request->title.'%');
                                })
                                ->when($request->functional_area,function ($q)use($request){
                                    $q->where('functional_area',$request->functional_area);
                                })
                                ->when($request->textile_sector,function ($q)use($request){
                                    $q->where('textile_sector',$request->textile_sector);
                                })
                                ->when($request->experience,function ($q)use($request){
                                    $q->where('work_experience',$request->experience);
                                })
                                ->when($request->experience,function ($q)use($request){
                                    $q->where('skills','Like','%'.$request->skills.'%');
                                })
                                ->when($request->job_type,function ($q)use($request){
                                    $q->whereIn('job_type',$request->job_type);
                                })->get();

        $data['page'] = 'jobs.job-directory';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function cvSearchFilter(Request $request)
    {
        $min = $request->query('min-value');
        $max = $request->query('max-value');
        $data['cvs'] = \App\UploadCv::whereBetween('exp_salary',[intval($min),intval($max)])
            ->when($request->functional_area,function ($q)use($request){
                $q->where('functional_area',$request->functional_area);
            })
            ->when($request->job_sector,function ($q)use($request){
                $q->where('textile_sector','Like','%'.$request->job_sector.'%');
            })
            ->when($request->experience,function ($q)use($request){
                $q->where('total_experience','Like','%'.$request->experience.'%');
            })
            ->when($request->experience,function ($q)use($request){
                $q->where('key_skills','Like','%'.$request->skills.'%');
            })
            ->when($request->edu_level,function ($q)use($request){
                $q->where('edu_level','Like','%'.$request->edu_level.'%');
            })->get();

        $data['page'] = 'jobs.cv-directory';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function store_job(Request $request)
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
            $data['job']= new \App\JobManagement();
            $data['job']->title= request('title');
            $data['job']->user_id = \Auth::user()->id;
            $data['job']->designation= request('designation');
            $data['job']->job_description= request('job_description');
            $data['job']->email= request('email');
            $data['job']->salary= request('salary');
            $data['job']->job_type= request('job_type');
            $data['job']->functional_area= request('functional_area');
            $data['job']->textile_sector= request('textile_sector');
            $data['job']->salary_unit= request('unit');
            $data['job']->job_level= request('job_level');
            $data['job']->address= request('address');
            $data['job']->city= request('city');
            $data['job']->country= request('country');
            $data['job']->work_hour= request('work_hour');
            $data['job']->qualification= request('qualification');
            $data['job']->skills= request('skills');
            $data['job']->work_experience= request('work_experience');
            $data['job']->vacancies= request('vacancies');
            $data['job']->closing_date= request('datePicker');
            $data['job']->gender = request('gender');
            $data['job']->company = request('company');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $file = 'front_site/jobs/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $data['job']->image = $path;
            }

            $data['job']->save();
            if ($data['job']->save()) {
                $data['feedback'] = "true";
                $data['msg'] = 'Job has been saved successfully';
            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }

    public function store_cv(Request $request)
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
            $data['postcv']= new \App\UploadCv();
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
                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $file = 'front_site/CVs/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $data['postcv']->image = $path;
            }

            $data['postcv']->save();
            if ($data['postcv']->save()) {
                $data['feedback'] = "true";
                $data['msg'] = 'CV uploaded successfully';
            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }

    public function donload_file($file)
    {
        dd($file);
    }
}
