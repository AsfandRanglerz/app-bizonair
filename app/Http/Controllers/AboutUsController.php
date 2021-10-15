<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\User;
use Storage;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class AboutUsController extends Controller
{
    public function about_us()
    {
        $about_us = \App\CompanyProfile::where('id',session()->get('company_id'))->first();
        return view('front_site.supplier.suppliers-about-us',compact('about_us'));
    }

    public function products()
    {
        $country = new Countries();
        $data['countries'] = $country->all();
        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types','!=','Service')->where('company_id',session()->get('company_id'))->with('product_image')->get();
        return view('front_site.supplier.suppliers-products',$data, compact('products'));
    }

    public function services()
    {
        $country = new Countries();
        $data['countries'] = $country->all();
        $services = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types','Service')->where('company_id',session()->get('company_id'))->with('product_image')->get();
        return view('front_site.supplier.suppliers-services',$data, compact('services'));
    }

    public function contact_us()
    {
        $country = new Countries();
        $countries = $country->all();
        $contact_us = \App\CompanyProfile::where('id',session()->get('company_id'))->first();
        return view('front_site.supplier.suppliers-contact-us',compact('contact_us','countries'));
    }

    public function create_contact_us_user(Request $request)
    {

        $rules = [
            'inquiry_for' => 'required', 'userName' => 'required',  'emailAddress' => 'required',
            'company_name' => 'required','phoneNumber' => 'required','designation' => 'required',
            'country' => 'required','description' => 'required',
        ];
        $messages = [
            'inquiry_for.required' => 'contact inquiry is required',
            'userName.required' => 'contact name is required',
            'emailAddress.required' => 'contact email is required',
            'company_name.required' => 'contact company name is required',
            'phoneNumber.required' => 'contact phone is required',
            'designation.required' => 'contact designation is required',
            'country.required' => 'contact country is required',
            'description.required' => 'contact description is required',
        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {
            $data['$contact'] = new \App\ContactUs();
            $data['$contact']->inquiry_for= request('inquiry_for');
            $data['$contact']->type= request('type');
            $data['$contact']->name= request('userName');
            $data['$contact']->email= request('emailAddress');
            $data['$contact']->company= request('company_name');
            $data['$contact']->phone= request('phoneNumber');
            $data['$contact']->designation= request('designation');
            $data['$contact']->country= request('country');
            $data['$contact']->description= request('description');
            $data['$contact']->terms_service= request('terms');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('contact-us/',$image_name,'s3');
                $path = 'contact-us'.'/'.$image_name;
                $url = Storage::disk('s3')->url($path);
                $data['$contact']->image = $url;
            }
            $data['$contact']->save();

            $user = \App\User::where('id',$request->userId)->first();
            \Mail::to($user->email)->send(new \App\Mail\ContactUsMail($data));

            if (1 == 1) {

                $data['feedback'] = "true";
                $data['msg'] = 'Contact Submitted Successfully !';
                $data['url'] = url()->previous();


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }

    }

}
