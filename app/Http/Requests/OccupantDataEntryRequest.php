<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OccupantDataEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'rhe_name' => 'required|exists:housing_estate,estate_id',
            'flat_type' => 'required|exists:housing_flat,flat_type_id',
            'block_name' => 'required|exists:housing_flat,block_id',
            'flat_no' => 'required|exists:housing_flat,flat_id',
            'occupant_name' => 'required|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
            'occupant_father_name' => 'required|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
            'permanent_street' => 'required|min:3|max:255',
            'permanent_city_town_village' => 'required|min:3|max:255',
            'permanent_post_office' => 'required|min:3|max:255',
            'permanent_district' => 'required|in:' . implode(',', array_keys(config('lookup.districts'))),
            'permanent_pincode' => 'required|regex:/^\d{6}$/',
            'present_street' => 'required|min:3|max:255',
            'present_city_town_village' => 'required|min:3|max:255',
            'present_post_office' => 'required|min:3|max:255',
            'present_district' => 'required|in:' . implode(',', array_keys(config('lookup.districts'))),
            'present_pincode' => 'required|regex:/^\d{6}$/',
            'mobile_no' => 'required|regex:/[6-9]\d{9}$/',
            'email ' => 'required|email',
            'dob' => 'required|before:' . now()->subYear(18)->format('Y-m-d'),
        ];
    }

    public function attributes()
    {
        return [
            'rhe_name' => 'housing estate',
            'flat_type' => 'flat type',
            'block_name' => 'block name',
            'flat_no' => 'flat no.',
            'occupant_name' => 'occupant name',
            'occupant_father_name' => 'occupant father name',
            'permanent_street' => 'permanent street',
            'permanent_city_town_village' => 'permanent city/town/village',
            'permanent_post_office' => 'permanent post office',
            'permanent_district' => 'permanent district',
            'permanent_pincode' => 'permanent pincode',
            'present_street' => 'present street',
            'present_city_town_village' => 'present city/town/village',
            'present_post_office' => 'present post office',
            'present_district' => 'present district',
            'present_pincode' => 'present pincode',
            'mobile_no' => 'mobile no.',
            'email' => 'email',
            'dob' => 'date of birth'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':Attribute is required',
            'rhe_name.exists' => ':Attribute is invalid',
            'flat_type.exists' => ':Attribute is invalid',
            'block_name.exists' => ':Attribute is invalid',
            'flat_no.exists' => ':Attribute is invalid',
            '*.min' => ':Attribute must be at least :min characters',
            '*.max' => ':Attribute may not be greater than :max characters',
            'occupant_name.regex' => ':Attribute must contain only alphabets and spaces',
            'occupant_father_name.regex' => ':Attribute must contain only alphabets and spaces',
            'permanent_pincode.regex' => ':Attribute must be 6 digits',
            'present_pincode.regex' => ':Attribute must be 6 digits',
            'mobile_no.regex' => 'Invalid mobile no.',
            'email.email' => 'Invalid email',
            'dob.before' => 'Applicant must be at least 18 years old',
            '*.in' => ':Attribute is invalid'
        ];
    }
}
