<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutForm extends FormRequest
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
            'billing_name'=>'required',
            'billing_email'=>'required',
            'billing_phone_number'=>'required',
            'country'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'billing_name.required'=>'billing_name is needed',
            'billing_email.required'=>'billing_email is needed',
            'billing_phone_number.required'=>'billing_phone_number is required',
            'country.required'=>'country is required'
        ];
    }
}
