<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class ContactUsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function create_contact_us(Request $request)
    {
        $rules = [
            'inquiryFor' => 'required', 'userName' => 'required',  'emailAddress' => 'required',
            'phoneNumber' => 'required',
            'country' => 'required','description' => 'required',
        ];
        $messages = [
            'inquiryFor.required' => 'contact inquiry is required',
            'userName.required' => 'contact name is required',
            'emailAddress.required' => 'contact email is required',
            'phoneNumber.required' => 'contact phone is required',
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
            $data['$contact']->inquiry_for= request('inquiryFor');
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
                $file = 'assets/front_site/contact-bizonair/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $data['$contact']->image = $path;
            }
            $data['$contact']->save();
            \Mail::to('info@bizonair.com')->send(new \App\Mail\ContactUsMail($data));

            if (1 == 1) {

                $data['feedback'] = "true";
                $data['msg'] = 'Contact saved  successfully !';
                $data['url'] = route('contact-us');


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }

    }

    public function about_us_supplier($id)
    {
        $about_us = \App\CompanyProfile::where('id',$id)->first();
        return view('front_site.user-supplier.user-suppliers-about-us',compact('about_us'));
    }

    public function products_supplier($id)
    {
        $country = new Countries();
        $data['countries'] = $country->all();

        $about_us = \App\CompanyProfile::where('id',$id)->first();
        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types','!=','Service')->where('company_id',$id)->with('product_image')->get();
        return view('front_site.user-supplier.user-suppliers-products',$data,compact('products','about_us'));
    }

    public function services_supplier($id)
    {
        $country = new Countries();
        $data['countries'] = $country->all();
        $about_us = \App\CompanyProfile::where('id',$id)->first();
        $services = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types','Service')->where('company_id',$id)->with('product_image')->get();
        return view('front_site.user-supplier.user-suppliers-services',$data, compact('services','about_us'));
    }

    public function contact_us_supplier($id)
    {
        $about_us = \App\CompanyProfile::where('id',$id)->first();

        $country = new Countries();
        $countries = $country->all();
        $contact_us = \App\CompanyProfile::where('id',$id)->first();
        return view('front_site.user-supplier.user-suppliers-contact-us',compact('contact_us','countries','about_us'));
    }

    public function save_contact_us_supplier(Request $request)
    {
        $rules = [
            'inquiryFor' => 'required', 'userName' => 'required',  'emailAddress' => 'required',
            'phoneNumber' => 'required',
            'country' => 'required','description' => 'required'
        ];
        $messages = [
            'inquiryFor.required' => 'contact inquiry is required',
            'userName.required' => 'contact name is required',
            'emailAddress.required' => 'contact email is required',
            'phoneNumber.required' => 'contact phone is required',
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
            $data['$contact']->inquiry_for= request('inquiryFor');
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
                $file = 'assets/front_site/contact-supplier/';
                $image->move(public_path($file), $image_name);
                $path = $file . $image_name;
                $data['$contact']->image = $path;
            }
            $data['$contact']->save();

            $user = \App\User::where('id',$request->userId)->first();
            \Mail::to($user->email)->send(new \App\Mail\ContactUsMail($data));

            if (1 == 1) {

                $data['feedback'] = "true";
                $data['msg'] = 'Contact saved  successfully !';
                $data['url'] = url()->previous();


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }

    }

}
