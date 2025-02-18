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
            'mobile' => 'required|regex:/[6-9]\d{9}$/',
            'app_email ' => 'email',
            'dob' => 'required|before:' . now()->subYear(18)->format('Y-m-d'),
            'hrms_id' => 'required|regex:/^\d{10}$/',
            'designation' => 'required',
            'basic_pay_range' => 'required',
            'basic_pay' => 'required|numeric',
            'posting_place' => 'required',
            'headquarter' => 'required',
            'doj' => 'required|before:' . now(),
            // 'dor' => 'required|after:' . now(),
            'office_name' => 'required',
            'office_address' => 'required',
            'office_city' => 'required',
            'office_po' => 'required',
            'office_district' => 'required_if:office_district_value,"NA"',
            'office_pin' => 'required|regex:/^\d{6}$/',
            'office_phone' => 'required',
            'ddo_district' => 'required',
            'ddo_designation' => 'required',
            'license_no' => 'required',
            'issue_date' => 'required',
            'occupant_status' => 'required',
            'current_license' => 'required|max:1024',
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
            'app_email' => 'email',
            'dob' => 'date of birth',
            'hrms_id' => 'HRMS id',
            'designation' => 'designation',
            'basic_pay' => 'basic pay',
            'posting_place' => 'place of posting',
            'headquarter' => 'head quarter',
            'doj' => 'date of joining',
            'dor' => 'date of retirement',
            'office_name' => 'name of office',
            'office_address' => 'office address',
            'office_city' => 'office city / town / village',
            'office_po' => 'post office',
            'office_district' => 'district',
            'office_pin' => 'office PIN code',
            'office_phone' => 'office phone no.',
            'ddo_district' => 'DDO district',
            'ddo_designation' => 'DDO designation',
            'ddo_address' => 'DDO address',
            'license_no' => 'license no.',
            'issue_date' => 'license issue date',
            'occupant_status' => 'status',
            'current_license' => 'current license',
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
            '*.in' => ':Attribute is invalid',
            'current_license.mimes' => 'Only .pdf files are allowed',
            'current_license.size' => 'Max. file size 1 MB',
        ];
    }
}
