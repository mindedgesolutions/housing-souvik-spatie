<?php

namespace App\Http\Requests\AllotmentApplication;

use Illuminate\Foundation\Http\FormRequest;

class CategoryShiftRequest extends FormRequest
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
        $userId = auth()->id() ? auth()->id() : 0;
        return [
            'applicant_name' => 'required|min:3|max:255',
            'father_husband_name' => 'required|min:3|max:255',
            'mobile_no' => 'required|numeric|regex:/[6-9]\d{9}$/',
            'email' => 'required|email|unique:users,email,' . $userId,
            'dob' => 'required|before:' . now()->subYear(18)->format('Y-m-d'),
            'gender' => 'required',
            'p_address' => 'required',
            'p_city_town_village' => 'required',
            'p_post_office' => 'required',
            'p_district' => 'required_if:p_district_value,""',
            'p_pin_code' => 'required|regex:/^\d{6}$/',
            'present_address' => 'required_unless:same_as_permanent,on',
            'present_city_town_village' => 'required_unless:same_as_permanent,on',
            'present_post_office' => 'required_unless:same_as_permanent,on',
            'present_district' => 'required_if:present_district_value,""',
            'present_pin_code' => 'required_unless:same_as_permanent,on|regex:/^\d{6}$/',
            'hrms_id' => 'required|regex:/^\d{10}$/',
            'designation' => 'required',
            'basic_pay' => 'required|numeric',
            'place_of_posting' => 'required',
            'headquarter' => 'required',
            'doj' => 'required|before:' . now(),
            // 'dor' => 'required|after:' . now(),
            'name_of_office' => 'required',
            'office_address' => 'required',
            'office_city_town_village' => 'required',
            'office_post_office' => 'required',
            'o_district' => 'required_if:office_district_value,"NA"',
            'office_pin_code' => 'required|regex:/^\d{6}$/',
            'office_phn_no' => 'required',
            'ddo_designation' => 'required',
            'ddo_address' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'applicant_name' => 'applicant\'s name',
            'father_husband_name' => 'father\'s / husband\'s name',
            'mobile_no' => 'mobile no.',
            'email' => 'email',
            'dob' => 'date of birth',
            'gender' => 'gender',
            'p_address' => 'permanent address',
            'p_city_town_village' => 'City / Town / Village',
            'p_post_office' => 'post office',
            'p_district' => 'district',
            'p_pin_code' => 'PIN code',
            'present_address' => 'present address',
            'present_city_town_village' => 'present city / town / village',
            'present_post_office' => 'present post office',
            'present_district' => 'present district',
            'present_pin_code' => 'present PIN code',
            'hrms_id' => 'HRMS id',
            'designation' => 'designation',
            'basic_pay' => 'basic pay',
            'place_of_posting' => 'place of posting',
            'headquarter' => 'head quarter',
            'doj' => 'date of joining',
            'dor' => 'date of retirement',
            'name_of_office' => 'name of office',
            'office_address' => 'office address',
            'office_city_town_village' => 'office city / town / village',
            'office_post_office' => 'post office',
            'o_district' => 'district',
            'office_pin_code' => 'office PIN code',
            'office_phn_no' => 'office phone no.',
            'ddo_designation' => 'DDO designation',
            'ddo_address' => 'DDO address',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => ':Attribute is required',
            '*.string' => ':Attribute must be a string',
            '*.min' => ':Attribute must be between 3 to 255 characters',
            '*.max' => ':Attribute must be between 3 to 255 characters',
            '*.numeric' => ':Attribute must be a number',
            'mobile_no.regex' => 'Invalid mobile no.',
            'dob.before' => 'Applicant must be at least 18 years old',
            'p_pin_code.regex' => 'PIN code must be 6 digit',
            '*.required_unless' => ':Attribute is required',
            'present_pin_code.regex' => 'PIN code must be 6 digit',
            'doj.before' => 'Date of joining cannot be in future',
            'dor.after' => 'Date of retirement cannot be in past',
            'office_pin_code.regex' => 'PIN code must be 6 digit',
        ];
    }
}
