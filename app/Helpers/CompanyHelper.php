<?php


    namespace App\Helpers;


    use App\CompanyImage;
    use http\Env\Request;

    class CompanyHelper
    {
        public function validateCompany(){
            $rules= [
                'company_name'=>'required',
                'industry'=>'required',
                'business_type'=>'required',
                // 'annual_turnover'=>'required',
                // 'no_of_employees'=>'required',
                // 'company_introduction'=>'required|min:10',
                // 'export_market'=>'required',
                // 'other_business_type'=>'required_if:business_type,Others',
            ];
            $messages = [
                'company_name.required'=>'Please add your company name',
                'industry.required'=>'Please select an Industry',
                'business_type.required'=>'Please add your business type',
                // 'annual_turnover.required'=>'Please add annual turnover',
                // 'no_of_employees.required'=>'Please add your no of employees',
                // 'company_introduction.required'=>'Please add introduction of your company (min 10 characters)',
                // 'company_introduction.min'=>'Please add introduction of your company (min 10 characters)',
                // 'export_market.required'=>'Please add atleast one export Market',
            ];
            $validator = \Validator::make(request()->all() , $rules, $messages);
            if($validator->fails()){
                $data['feedback'] = 'false';
                $data['errors'] = $validator->errors()->getMessages();
                $data['msg'] = '';
                return json_encode($data);
            }

        }

        public function uploadLogo($request){
            $logo=$request->file('logo_image');
            if($logo){
                $logo_name=rand(1000, 9999) . time().'.'.$logo->getClientOriginalExtension();
                $logo->move('public/assets/front_site/images/company-images', $logo_name);
                return $logo_name;
            }else{
                $logo_name='no-image.png';
                return $logo_name;
            }
        }

        public function uploadCompanyImages( $request){
            $images=$request->file('company_images');
            dd($images);
        }
    }
