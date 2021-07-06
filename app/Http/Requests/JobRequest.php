<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'designation'=>'required',
            'email'=>'required',
            'salary' => 'required',
            'functional_area'=>'required',
            'textile_sector'=>'required',
            'city' => 'required',
            'work_experience' => 'required',
            'datePicker' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'job title is required',
            'designation.required' => 'job designation is required',
            'email.required' => 'email is required',
            'salary.required' => 'job salary is required',
            'city.required' => 'job city name is required',
            'work_experience.required' => 'job experience is required',
            'datePicker.required' => 'job date is required',
        ];
    }
    protected function failedValidation(Validator $validator){
     response()->json(['feedback'=>false,'errors'=>$validator->errors(),'msg'=>'']);
    }
}
