<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFirebaseTokenRequest extends FormRequest
{
//    private $rules;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
//        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        $this->rules = [
//            'user_id'        => ['required', 'integer'],
//            'device_token' => ['required', 'string', 'min:3', 'max:255'],
//        ];
//        return $this->rules;
        return [
            //
        ];
    }
}
