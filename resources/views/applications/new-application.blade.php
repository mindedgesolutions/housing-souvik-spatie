@extends('layouts.dashboard-master')

@section('title', 'Application For New Allotment | ' . config('app.name'))

@section('page-header', 'Application For New Allotment')

@section('dashboard-body')
    <div class="row">
        <form class="row g-3" action="{{ route('hrms.store') }}" id="application" autocomplete="off" method="POST"
            enctype="multipart/form-data">
            @csrf
            {{-- <a href="{{ route('hrms.view', Crypt::encrypt('12')) }}">View</a> --}}
            <div>
                <h5>&#9680; Personal Information (According to Service Book)</h5>
            </div>
            <div class="" id="focus-div"></div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="applicant_name" name ="applicant_name"
                        placeholder="Name of the Applicant" onkeyup="return charOnly(this)"
                        value="{{ array_key_exists('applicantName', $hrms_data) ? $hrms_data['applicantName'] : old('applicant_name') }}"
                        {{ array_key_exists('applicantName', $hrms_data) ? 'readonly' : null }}>
                    <label for="applicant_name">Applicant's Name</label>
                    <span id="error_applicant_name" class="text-danger"></span>
                    @error('applicant_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="father_husband_name"
                        name="father_husband_name"placeholder="Father's / Husband's Name" onkeyup="return charOnly(this)"
                        value="{{ array_key_exists('guardianName', $hrms_data) ? $hrms_data['guardianName'] : old('father_husband_name') }}"
                        {{ array_key_exists('guardianName', $hrms_data) ? 'readonly' : null }}>
                    <label for="father_husband_name">Father's / Husband's Name</label>
                    <span id="error_father_husband_name" class="text-danger"></span>
                    @error('father_husband_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="mobile_no" name="mobile_no"
                        placeholder="Mobile Number" onkeyup="return numberOnly(this)"
                        value="{{ array_key_exists('mobileNo', $hrms_data) ? $hrms_data['mobileNo'] : old('mobile_no') }}"
                        {{ array_key_exists('mobileNo', $hrms_data) ? 'readonly' : null }}>
                    <label for="mobile_no">Mobile Number</label>
                    <span id="error_mobile_no" class="text-danger"></span>
                    @error('mobile_no')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="email" class="form-control form-control-sm" id="email" name="email"
                        placeholder="Email"
                        value="{{ array_key_exists('email', $hrms_data) ? $hrms_data['email'] : old('email') }}"
                        {{ array_key_exists('email', $hrms_data) ? 'readonly' : null }}>
                    <label for="email">Email ID</label>
                    <span id="error_email" class="text-danger"></span>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-floating">
                    <input type="date" class="form-control form-control-sm" id="dob" name="dob"
                        value="{{ $hrmsDob ?? old('dob') }}" {{ $hrmsDob ? 'readonly' : null }}>
                    <label for="dob">Date of Birth (According to Service Book)</label>
                    <span id="error_dob" class="text-danger"></span>
                    @error('dob')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">
                <label>Gender</label>
                <div class="d-flex align-items-center">
                    <div class="form-check me-5">
                        <input type="radio" class="form-check-input" id="gender_male" name="gender" value="Male"
                            {{ $hrmsGender == 'Male' ? 'checked' : null }} {{ $hrmsGender ? 'readonly' : null }}>
                        <label class="form-check-label" for="gender_male">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="gender_female" name="gender" value="Female"
                            {{ $hrmsGender == 'Female' ? 'checked' : null }} {{ $hrmsGender ? 'readonly' : null }}>
                        <label class="form-check-label" for="gender_female">Female</label>
                    </div>
                </div>
                <span id="error_gender" class="text-danger"></span>
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <h5>&#9680; Permanent Address</h5>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="p_address" name="p_address"
                        placeholder="Permanent Address"
                        value="{{ array_key_exists('permanentStreet', $hrms_data) ? $hrms_data['permanentStreet'] : old('p_address') }}"
                        {{ array_key_exists('permanentStreet', $hrms_data) ? 'readonly' : null }}>
                    <label for="p_address">Address</label>
                    <span id="error_p_address" class="text-danger"></span>
                    @error('p_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="p_city_town_village"
                        name="p_city_town_village" placeholder="Permanent City Town Village"
                        value="{{ array_key_exists('permanentCityTownVillage', $hrms_data) ? $hrms_data['permanentCityTownVillage'] : old('p_city_town_village') }}"
                        {{ array_key_exists('permanentCityTownVillage', $hrms_data) ? 'readonly' : null }}>
                    <label for="p_city_town_village">City / Town / Village</label>
                    <span id="error_p_city_town_village" class="text-danger"></span>
                    @error('p_city_town_village')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="p_post_office" name="p_post_office"
                        placeholder="Post Office"
                        value="{{ array_key_exists('permanentPostOffice', $hrms_data) ? $hrms_data['permanentPostOffice'] : old('p_post_office') }}"
                        {{ array_key_exists('permanentPostOffice', $hrms_data) ? 'readonly' : null }}>
                    <label for="p_post_office">Post Office</label>
                    <span id="error_p_post_office" class="text-danger"></span>
                    @error('p_post_office')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="p_district" name="p_district" aria-label="district"
                        name="p_district" {{ array_key_exists('permanentDistrictCode', $hrms_data) ? 'disabled' : null }}>
                        <option value="">- Select -</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_code }}"
                                {{ array_key_exists('permanentDistrictCode', $hrms_data) ? ($hrms_data['permanentDistrictCode'] == $district->district_code ? 'selected' : '') : (old('p_district') == $district->district_code ? 'selected' : '') }}>
                                {{ $district->district_name }}</option>
                        @endforeach
                    </select>
                    <label for="p_district">Select District</label>
                    <span id="error_p_district" class="text-danger"></span>
                    @error('p_district')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="hidden" name="p_district_value"
                        value="{{ array_key_exists('permanentDistrictCode', $hrms_data) ? $hrms_data['permanentDistrictCode'] : '' }}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="p_pin_code" name="p_pin_code"
                        placeholder="Permanent Pin Code" onkeyup="return numberOnly(this)"
                        value="{{ array_key_exists('permanentPincode', $hrms_data) ? $hrms_data['permanentPincode'] : old('p_pin_code') }}"
                        {{ array_key_exists('permanentPincode', $hrms_data) ? 'readonly' : null }}>
                    <label for="p_pin_code">Pin Code</label>
                    <span id="error_p_pin_code" class="text-danger"></span>
                    @error('p_pin_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <h5>&#9680; Present Address</h5>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="same_as_permanent" name="same_as_permanent"
                    onchange="copyPermanentAddress()">
                <label class="form-check-label" for="same_as_permanent"><b>Same as Permanent Address</b></label>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="present_address"
                        name="present_address" placeholder="Present Address"
                        value="{{ array_key_exists('presentStreet', $hrms_data) ? $hrms_data['presentStreet'] : old('present_address') }}"
                        {{ array_key_exists('presentStreet', $hrms_data) ? 'readonly' : null }}>
                    <label for="present_address">Address</label>
                    <span id="error_present_address" class="text-danger"></span>
                    @error('present_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="present_city_town_village"
                        name="present_city_town_village" placeholder="Present City Town Village"
                        value="{{ array_key_exists('presentCityTownVillage', $hrms_data) ? $hrms_data['presentCityTownVillage'] : old('present_city_town_village') }}"
                        {{ array_key_exists('presentCityTownVillage', $hrms_data) ? 'readonly' : null }}>
                    <label for="present_city_town_village">City / Town / Village</label>
                    <span id="error_present_city_town_village" class="text-danger"></span>
                    @error('present_city_town_village')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="present_post_office"
                        name="present_post_office" placeholder="Post Office"
                        value="{{ array_key_exists('presentPostOffice', $hrms_data) ? $hrms_data['presentPostOffice'] : old('present_post_office') }}"
                        {{ array_key_exists('presentPostOffice', $hrms_data) ? 'readonly' : null }}>
                    <label for="present_post_office">Post Office</label>
                    <span id="error_present_post_office" class="text-danger"></span>
                    @error('present_post_office')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="present_district" name="present_district" aria-label="district"
                        {{ array_key_exists('presentDistrictCode', $hrms_data) ? 'disabled' : null }}>
                        <option value="">- Select -</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_code }}"
                                {{ array_key_exists('presentDistrictCode', $hrms_data) ? ($hrms_data['presentDistrictCode'] == $district->district_code ? 'selected' : '') : (old('present_district') == $district->district_code ? 'selected' : '') }}>
                                {{ $district->district_name }}</option>
                        @endforeach
                    </select>
                    <label for="present_district">Select District</label>
                    <span id="error_present_district" class="text-danger"></span>
                    @error('present_district')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="hidden" name="present_district_value"
                        value="{{ array_key_exists('presentDistrictCode', $hrms_data) ? $hrms_data['presentDistrictCode'] : '' }}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="present_pin_code"
                        name="present_pin_code" placeholder="Present Pin Code" onkeyup="return numberOnly(this)"
                        value="{{ array_key_exists('presentPincode', $hrms_data) ? $hrms_data['presentPincode'] : old('present_pin_code') }}"
                        {{ array_key_exists('presentPincode', $hrms_data) ? 'readonly' : null }}>
                    <label for="present_pin_code">Pin Code</label>
                    <span id="error_present_pin_code" class="text-danger"></span>
                    @error('present_pin_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <h5>&#9680; Applicant's Official Information</h5>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="hrms_id" name="hrms_id"
                        placeholder="HRMS ID" onkeyup="return numberOnly(this)"
                        value="{{ array_key_exists('hrmsId', $hrms_data) ? $hrms_data['hrmsId'] : old('hrms_id') }}"
                        {{ array_key_exists('hrmsId', $hrms_data) ? 'readonly' : null }}>
                    <label for="hrms_id">Employee HRMS ID</label>
                    <span id="error_hrms_id" class="text-danger"></span>
                    @error('hrms_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="designation" name="designation"
                        placeholder="Designation"
                        value="{{ array_key_exists('applicantDesignation', $hrms_data) ? $hrms_data['applicantDesignation'] : old('designation') }}"
                        {{ array_key_exists('applicantDesignation', $hrms_data) ? 'readonly' : null }}>
                    <label for="designation">Employee Designation</label>
                    <span id="error_designation" class="text-danger"></span>
                    @error('designation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="basic_pay_range" name="basic_pay_range" aria-label="district"
                        {{ array_key_exists('payBandId', $hrms_data) ? null : null }} disabled>
                        <option value="">- Select -</option>
                        @foreach ($payBands as $payBand)
                            <option value="{{ $payBand->pay_band_id }}"
                                {{ array_key_exists('payBandId', $hrms_data) ? ($hrms_data['payBandId'] == $payBand->pay_band_id ? 'selected' : '') : (old('basic_pay_range') == $payBand->pay_band_id ? 'selected' : '') }}>
                                {{ $payBand->scale_from . '-' . $payBand->scale_to }}</option>
                        @endforeach
                    </select>
                    <label for="basic_pay_range">Pay Band</label>
                    <span id="error_basic_pay_range" class="text-danger"></span>
                    @error('basic_pay_range')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="hidden" name="basic_pay_range_value"
                        value="{{ array_key_exists('payBandId', $hrms_data) ? $hrms_data['payBandId'] : '' }}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="basic_pay" name="basic_pay"
                        placeholder="Basic Pay" onkeyup="return numberOnly(this)"
                        value="{{ array_key_exists('gradePay', $hrms_data) ? $hrms_data['gradePay'] : old('basic_pay') }}"
                        {{ array_key_exists('gradePay', $hrms_data) ? 'readonly' : null }}>
                    <label for="basic_pay">Basic Pay</label>
                    <span id="error_basic_pay" class="text-danger"></span>
                    @error('basic_pay')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="place_of_posting"
                        name="place_of_posting" placeholder="Place of Posting" value="{{ old('place_of_posting') }}">
                    <label for="place_of_posting">Place of Posting</label>
                    <span id="error_place_of_posting" class="text-danger"></span>
                    @error('place_of_posting')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="headquarter" name="headquarter"
                        placeholder="Headquarter"
                        value="{{ array_key_exists('applicantHeadquarter', $hrms_data) ? $hrms_data['applicantHeadquarter'] : old('headquarter') }}"
                        {{ array_key_exists('applicantHeadquarter', $hrms_data) ? 'readonly' : null }}>
                    <label for="headquarter">Headquarter</label>
                    <span id="error_headquarter" class="text-danger"></span>
                    @error('headquarter')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control form-control-sm" id="doj" name="doj"
                        value="{{ $hrmsDoj ?? old('doj') }}" {{ $hrmsDoj ? 'readonly' : null }}>
                    <label for="doj">Date of Joining (According to Service Book)</label>
                    <span id="error_doj" class="text-danger"></span>
                    @error('doj')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control form-control-sm" id="dor" name="dor"
                        value="{{ $hrmsDor ?? old('dor') }}" {{ $hrmsDor ? 'readonly' : null }}>
                    <label for="dor">Date of Retirement (According to Service Book)</label>
                    <span id="error_dor" class="text-danger"></span>
                    @error('dor')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <h5>&#9680; Name & Address of the Office</h5>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="name_of_office" name="name_of_office"
                        placeholder="Name of Office"
                        value="{{ array_key_exists('officeName', $hrms_data) ? $hrms_data['officeName'] : old('name_of_office') }}"
                        {{ array_key_exists('officeName', $hrms_data) ? 'readonly' : null }}>
                    <label for="name_of_office">Name of the office</label>
                    <span id="error_name_of_office" class="text-danger"></span>
                    @error('name_of_office')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_address" name="office_address"
                        placeholder="Office Address"
                        value="{{ array_key_exists('officeStreetCharacter', $hrms_data) ? $hrms_data['officeStreetCharacter'] : old('office_address') }}"
                        {{ array_key_exists('officeStreetCharacter', $hrms_data) ? 'readonly' : null }}>
                    <label for="office_address">Office Address</label>
                    <span id="error_office_address" class="text-danger"></span>
                    @error('office_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_city_town_village"
                        name="office_city_town_village" placeholder="Office City Town Village"
                        value="{{ array_key_exists('officeCityTownVillage', $hrms_data) ? $hrms_data['officeCityTownVillage'] : old('office_city_town_village') }}"
                        {{ array_key_exists('officeCityTownVillage', $hrms_data) ? 'readonly' : null }}>
                    <label for="office_city_town_village">Office City / Town / Village</label>
                    <span id="error_office_city_town_village" class="text-danger"></span>
                    @error('office_city_town_village')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_post_office"
                        name="office_post_office" placeholder="Office Post Office"
                        value="{{ array_key_exists('officePostOffice', $hrms_data) ? $hrms_data['officePostOffice'] : old('office_post_office') }}"
                        {{ array_key_exists('officePostOffice', $hrms_data) ? 'readonly' : null }}>
                    <label for="office_post_office">Post Office</label>
                    <span id="error_office_post_office" class="text-danger"></span>
                    @error('office_post_office')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="o_district" name="o_district" aria-label="office district"
                        {{ array_key_exists('officeDistrict', $hrms_data) ? 'disabled' : null }}>
                        <option value="">- Select -</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_code }}"
                                {{ array_key_exists('officeDistrict', $hrms_data) ? ($hrms_data['officeDistrict'] == $district->district_code ? 'selected' : '') : (old('o_district') == $district->district_code ? 'selected' : '') }}>
                                {{ $district->district_name }}</option>
                        @endforeach
                    </select>
                    <label for="o_district">Select District</label>
                    <span id="error_o_district" class="text-danger"></span>
                    @error('o_district')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <input type="hidden" name="office_district_value"
                        value="{{ array_key_exists('officeDistrict', $hrms_data) ? $hrms_data['officeDistrict'] : 'NA' }}" />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_pin_code"
                        name="office_pin_code" placeholder="Office Pin Code" onkeyup="return numberOnly(this)"
                        value="{{ array_key_exists('officePinCode', $hrms_data) ? $hrms_data['officePinCode'] : old('office_pin_code') }}"
                        {{ array_key_exists('officePinCode', $hrms_data) ? 'readonly' : null }}>
                    <label for="office_pin_code">Pin Code</label>
                    <span id="error_office_pin_code" class="text-danger"></span>
                    @error('office_pin_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_phn_no" name="office_phn_no"
                        placeholder="Office Phone Number" onkeyup="return numberOnly(this)"
                        value="{{ array_key_exists('officePhone', $hrms_data) ? $hrms_data['officePhone'] : old('office_phn_no') }}"
                        {{ array_key_exists('officePhone', $hrms_data) ? 'readonly' : null }}>
                    <label for="office_phn_no">Phone No. (with STD code)</label>
                    <span id="error_office_phn_no" class="text-danger"></span>
                    @error('office_phn_no')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <h5>&#9680; DDO Details</h5>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" id="ddo_district" name="ddo_district" aria-label="ddo district"
                        disabled>
                        <option value="">- Select -</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_code }}" @selected($district->district_code == $ddoInfo->district_code)>
                                {{ $district->district_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="ddo_district">DDO District</label>
                    <span id="error_ddo_district" class="text-danger"></span>
                    @error('ddo_district')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    {{-- <select class="form-select" id="ddo_designation" name="ddo_designation"
                        aria-label="ddo designation">
                        <option value="">- Select -</option>
                    </select> --}}
                    <input type="text" class="form-control form-control-sm" id="ddo_designation"
                        name="ddo_designation" value="{{ $ddoInfo->ddo_designation }}" readonly />
                    <label for="ddo_designation">DDO Designation</label>
                    <span id="error_ddo_designation" class="text-danger"></span>
                    @error('ddo_designation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="DDO Address" name="ddo_address" id="ddo_address" readonly>{{ $ddoInfo->ddo_address ?? 'NA' }}</textarea>
                    <label for="ddo_address">DDO Address</label>
                    <span id="error_ddo_address" class="text-danger"></span>
                    @error('ddo_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <h5>&#9680; Allotment Category</h5>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="flat_type" name="flat_type"
                        placeholder="Flat Type" value="{{ trim($flatType->housingFlatType->flat_type) }}" readonly>
                    <label for="flat_type">Flat Type</label>
                    <span id="error_flat_type" class="text-danger"></span>
                    @error('flat_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" id="allotment_reason" name="allotment_reason"
                        aria-label="allotment reason" name="allotment_reason">
                        <option value="">- Select -</option>
                        @foreach ($allotmentReasons as $reason)
                            <option value="{{ $reason->category }}">{{ $reason->category }}</option>
                        @endforeach
                    </select>
                    <label for="allotment_reason">Select Allotment Reason</label>
                    <span id="error_allotment_reason" class="text-danger"></span>
                    @error('allotment_reason')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <h5>&#9680; Housing Preference</h5>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="first_preference" name="first_preference"
                        aria-label="first preference">
                        <option value="">- Select -</option>
                        @foreach ($estatePreferences as $preference)
                            <option value="{{ $preference->estate_id }}">
                                {{ $preference->estate_name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="first_preference">Select First Preference</label>
                    <span id="error_first_preference" class="text-danger"></span>
                    @error('first_preference')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="second_preference" name="second_preference"
                        aria-label="second preference">
                        <option value="">- Select -</option>
                    </select>
                    <label for="second_preference">Select Second Preference</label>
                    <span id="error_second_preference" class="text-danger"></span>
                    @error('second_preference')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="third_preference" name="third_preference"
                        aria-label="third preference">
                        <option value="">- Select -</option>
                    </select>
                    <label for="third_preference">Select Third Preference</label>
                    <span id="error_third_preference" class="text-danger"></span>
                    @error('third_preference')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <h5>&#9680; Upload Documents</h5>
            </div>
            <div class="col-md-6">
                <h6><b>Upload Your Latest Payslip</b></h6>
                <input type="file" id="doc_payslip" name="doc_payslip" class="form-control"
                    aria-label="Latest Payslip" onchange="validatePayslip()">
                <p><small><b>Allowed Extension: pdf<br>Maximum File Size: 1 MB</b></small></p>
                <span id="error_doc_payslip" class="text-danger"></span>
                @error('doc_payslip')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <h6><b>Upload Your Scanned Signature</b></h6>
                <input type="file" id="doc_signature" name="doc_signature" class="form-control"
                    aria-label="Scanned Signature" onchange="validateSignature()">
                <p><small><b>Allowed Extension: jpg, jpeg<br>Dimensions: 140 pixels (Width) x 60 pixels (Height)<br>Maximum
                            File Size: 50 KB</b></small></p>
                <span id="error_doc_signature" class="text-danger"></span>
            </div>
            <div class="col-md-6" id="supporting_doc_div" style="display: none">
                <h6><b>Upload Allotment Reason Supporting Document</b></h6>
                <input type="file" id="doc_supporting" name="doc_supporting" class="form-control"
                    aria-label="Supporting Document" onchange="validateSupportDoc()">
                <p><small><b>Allowed Extension: pdf<br>Maximum File Size: 1 MB</b></small></p>
                <span id="error_doc_supporting" class="text-danger"></span>
                @error('doc_supporting')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-12 text-center">
                <button type="submit"class="btn btn-success" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
@endsection

<link href="{{ asset('select2/select2.min.css') }}" rel="stylesheet" />

<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
{{-- <script src="{{ asset('js/new-application.js') }}"></script> --}}
{{-- <script src="{{ asset('select2/select2.min.js') }}"></script> --}}

<script>
    // Re: Housing preference related drop-downs start ------
    // Second preference starts ------
    $(document).ready(function() {
        $('#first_preference').on('change', function() {
            $('#loader').show();

            var firstPreference = $('#first_preference').val();
            $('#second_preference').html('');
            $('#third_preference').html('');
            $.ajax({
                url: "{{ route('hrms.getEstatePreference') }}?first=" + firstPreference,
                method: 'get',
                success: function(res) {
                    $('#loader').hide();

                    $('#second_preference').html('<option value="">- Select -</option>');
                    $.each(res.estatePreferences, function(key, value) {
                        $('#second_preference').append('<option value="' + value
                            .estate_id + '")>' + value.estate_name +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error('Error fetching districts:', error);
                }
            });
        })
    });
    // Second preference ends ------

    // Third preference starts ------
    $(document).ready(function() {
        $('#second_preference').on('change', function() {
            $('#loader').show();

            var firstPreference = $('#first_preference').val();
            var seondPreference = $('#second_preference').val();
            $('#third_preference').html('');
            $.ajax({
                url: "{{ route('hrms.getEstatePreference') }}?first=" + firstPreference +
                    '&second=' + seondPreference,
                method: 'get',
                success: function(res) {
                    $('#loader').hide();

                    $('#third_preference').html('<option value="">- Select -</option>');
                    $.each(res.estatePreferences, function(key, value) {
                        $('#third_preference').append('<option value="' + value
                            .estate_id + '")>' + value.estate_name +
                            '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error('Error fetching districts:', error);
                }
            });
        })
    });
    // Third preference ends ------
    // Re: Housing preference related drop-downs end ------

    // Show supporting document upload div starts ------
    $(document).ready(function() {
        $('#allotment_reason').on('change', function() {
            var allotmentReason = $('#allotment_reason').val();
            if (allotmentReason == 'General') {
                $('#supporting_doc_div').hide();
            } else {
                $('#supporting_doc_div').show();
            }
        })
    });
    // Show supporting document upload div ends ------

    function copyPermanentAddress() {
        const checkbox = document.getElementById("same_as_permanent");

        // Get permanent address fields
        const permanentAddress = document.getElementById("p_address").value;
        const permanentCity = document.getElementById("p_city_town_village").value;
        const permanentPostOffice = document.getElementById("p_post_office").value;
        const permanentDistrict = document.getElementById("p_district").value;
        const permanentPinCode = document.getElementById("p_pin_code").value;

        // Set present address fields based on checkbox status
        if (checkbox.checked) {
            document.getElementById("present_address").value = permanentAddress;
            document.getElementById("present_city_town_village").value =
                permanentCity;
            document.getElementById("present_post_office").value =
                permanentPostOffice;
            document.getElementById("present_district").value = permanentDistrict;
            document.getElementById("present_pin_code").value = permanentPinCode;
        } else {
            document.getElementById("present_address").value = "";
            document.getElementById("present_city_town_village").value = "";
            document.getElementById("present_post_office").value = "";
            document.getElementById("present_district").value = "";
            document.getElementById("present_pin_code").value = "";
        }
    }

    // Form validation starts -----

    // Onsubmit validation starts ------
    document.addEventListener("DOMContentLoaded", function() {
        const application = document.querySelector("#application");

        application.addEventListener("submit", function(e) {
            e.preventDefault();
            // Error fields start ------
            let error_applicant_name = document.querySelector(
                "#error_applicant_name"
            );
            let error_father_husband_name = document.querySelector(
                "#error_father_husband_name"
            );
            let error_mobile_no = document.querySelector("#error_mobile_no");
            let error_email = document.querySelector("#error_email");
            let error_dob = document.querySelector("#error_dob");
            let error_gender = document.querySelector("#error_gender");
            let error_p_address = document.querySelector("#error_p_address");
            let error_p_city_town_village = document.querySelector(
                "#error_p_city_town_village"
            );
            let error_p_post_office = document.querySelector(
                "#error_p_post_office"
            );
            let error_p_district = document.querySelector("#error_p_district");
            let error_p_pin_code = document.querySelector("#error_p_pin_code");
            let error_present_address = document.querySelector(
                "#error_present_address"
            );
            let error_present_city_town_village = document.querySelector(
                "#error_present_city_town_village"
            );
            let error_present_post_office = document.querySelector(
                "#error_present_post_office"
            );
            let error_present_district = document.querySelector(
                "#error_present_district"
            );
            let error_present_pin_code = document.querySelector(
                "#error_present_pin_code"
            );
            let error_hrms_id = document.querySelector("#error_hrms_id");
            let error_designation = document.querySelector("#error_designation");
            let error_basic_pay_range = document.querySelector(
                "#error_basic_pay_range"
            );
            let error_basic_pay = document.querySelector("#error_basic_pay");
            let error_place_of_posting = document.querySelector(
                "#error_place_of_posting"
            );
            let error_headquarter = document.querySelector("#error_headquarter");
            let error_doj = document.querySelector("#error_doj");
            let error_dor = document.querySelector("#error_dor");
            let error_name_of_office = document.querySelector(
                "#error_name_of_office"
            );
            let error_office_address = document.querySelector(
                "#error_office_address"
            );
            let error_office_city_town_village = document.querySelector(
                "#error_office_city_town_village"
            );
            let error_office_post_office = document.querySelector(
                "#error_office_post_office"
            );
            let error_o_district = document.querySelector("#error_o_district");
            let error_office_pin_code = document.querySelector(
                "#error_office_pin_code"
            );
            let error_office_phn_no = document.querySelector(
                "#error_office_phn_no"
            );
            let error_ddo_district = document.querySelector("#error_ddo_district");
            let error_ddo_designation = document.querySelector(
                "#error_ddo_designation"
            );
            let error_ddo_address = document.querySelector("#error_ddo_address");
            let error_flat_type = document.querySelector("#error_flat_type");
            let error_allotment_reason = document.querySelector(
                "#error_allotment_reason"
            );
            let error_first_preference = document.querySelector(
                "#error_first_preference"
            );
            let error_second_preference = document.querySelector(
                "#error_second_preference"
            );
            let error_third_preference = document.querySelector(
                "#error_third_preference"
            );
            let error_doc_payslip = document.querySelector("#error_doc_payslip");
            let error_doc_signature = document.querySelector(
                "#error_doc_signature"
            );
            let error_doc_supporting = document.querySelector(
                "#error_doc_supporting"
            );
            // Error fields end ------

            // Default error messages start ------
            error_applicant_name.innerHTML = "";
            error_father_husband_name.innerHTML = "";
            error_mobile_no.innerHTML = "";
            error_email.innerHTML = "";
            error_dob.innerHTML = "";
            error_gender.innerHTML = "";
            error_p_address.innerHTML = "";
            error_p_city_town_village.innerHTML = "";
            error_p_post_office.innerHTML = "";
            error_p_district.innerHTML = "";
            error_p_pin_code.innerHTML = "";
            error_present_address.innerHTML = "";
            error_present_city_town_village.innerHTML = "";
            error_present_post_office.innerHTML = "";
            error_present_district.innerHTML = "";
            error_present_pin_code.innerHTML = "";
            error_hrms_id.innerHTML = "";
            error_designation.innerHTML = "";
            error_basic_pay_range.innerHTML = "";
            error_basic_pay.innerHTML = "";
            error_place_of_posting.innerHTML = "";
            error_headquarter.innerHTML = "";
            error_doj.innerHTML = "";
            error_dor.innerHTML = "";
            error_name_of_office.innerHTML = "";
            error_office_address.innerHTML = "";
            error_office_city_town_village.innerHTML = "";
            error_office_post_office.innerHTML = "";
            error_o_district.innerHTML = "";
            error_office_pin_code.innerHTML = "";
            error_office_phn_no.innerHTML = "";
            error_ddo_district.innerHTML = "";
            error_ddo_designation.innerHTML = "";
            error_ddo_address.innerHTML = "";
            error_flat_type.innerHTML = "";
            error_allotment_reason.innerHTML = "";
            error_first_preference.innerHTML = "";
            error_second_preference.innerHTML = "";
            error_third_preference.innerHTML = "";
            error_doc_payslip.innerHTML = "";
            error_doc_signature.innerHTML = "";
            error_doc_supporting.innerHTML = "";
            // Default error messages end ------

            // Form fields start ------
            const applicant_name = document.querySelector("#applicant_name");
            const father_husband_name = document.querySelector(
                "#father_husband_name"
            );
            const mobile_no = document.querySelector("#mobile_no");
            const email = document.querySelector("#email");
            const dob = document.querySelector("#dob");
            const gender = document.querySelector('input[name="gender"]:checked');
            const p_address = document.querySelector("#p_address");
            const p_city_town_village = document.querySelector(
                "#p_city_town_village"
            );
            const p_post_office = document.querySelector("#p_post_office");
            const p_district = document.querySelector("#p_district");
            const p_pin_code = document.querySelector("#p_pin_code");
            const present_city_town_village = document.querySelector(
                "#present_city_town_village"
            );
            const present_post_office = document.querySelector(
                "#present_post_office"
            );
            const present_district = document.querySelector("#present_district");
            const present_pin_code = document.querySelector("#present_pin_code");
            const hrms_id = document.querySelector("#hrms_id");
            const designation = document.querySelector("#designation");
            const basic_pay_range = document.querySelector("#basic_pay_range");
            const basic_pay = document.querySelector("#basic_pay");
            const place_of_posting = document.querySelector("#place_of_posting");
            const headquarter = document.querySelector("#headquarter");
            const doj = document.querySelector("#doj");
            const dor = document.querySelector("#dor");
            const name_of_office = document.querySelector("#name_of_office");
            const office_address = document.querySelector("#office_address");
            const office_city_town_village = document.querySelector(
                "#office_city_town_village"
            );
            const office_pin_code = document.querySelector("#office_pin_code");
            const office_post_office = document.querySelector(
                "#office_post_office"
            );
            const o_district = document.querySelector("#o_district");
            const office_phn_no = document.querySelector("#office_phn_no");
            const ddo_district = document.querySelector("#ddo_district");
            const ddo_designation = document.querySelector("#ddo_designation");
            const ddo_address = document.querySelector("#ddo_address");
            const flat_type = document.querySelector("#flat_type");
            const allotment_reason = document.querySelector("#allotment_reason");
            const first_preference = document.querySelector("#first_preference");
            const second_preference = document.querySelector("#second_preference");
            const third_preference = document.querySelector("#third_preference");
            const doc_payslip = document.querySelector("#doc_payslip");
            const doc_signature = document.querySelector("#doc_signature");
            const doc_supporting = document.querySelector("#doc_supporting");
            // Form fields end ------

            let errors = 0;

            // Empty field validations start ------
            if (!applicant_name.value) {
                error_applicant_name.innerHTML = "Applicant name is required";
                errors += 1;
            }
            if (!father_husband_name.value) {
                error_father_husband_name.innerHTML =
                    "Father's / Husband's name is required";
                errors += 1;
            }
            if (!mobile_no.value) {
                error_mobile_no.innerHTML = "Mobile no. is required";
                errors += 1;
            }
            if (!email.value) {
                error_email.innerHTML = "Email is required";
                errors += 1;
            }
            if (!dob.value) {
                error_dob.innerHTML = "Date of birth is required";
                errors += 1;
            }
            if (!gender?.value) {
                error_gender.innerHTML = "Gender is required";
                errors += 1;
            }
            if (!p_address.value) {
                error_p_address.innerHTML = "Permanent address is required";
                errors += 1;
            }
            if (!p_city_town_village.value) {
                error_p_city_town_village.innerHTML =
                    "City / Town / Village is required";
                errors += 1;
            }
            if (!p_post_office.value) {
                error_p_post_office.innerHTML = "Post office is required";
                errors += 1;
            }
            if (!p_district.value) {
                error_p_district.innerHTML = "District is required";
                errors += 1;
            }
            if (!p_pin_code.value) {
                error_p_pin_code.innerHTML = "PIN code is required";
                errors += 1;
            }
            if (
                !document.querySelector('input[name="same_as_permanent"]:checked')
                ?.value
            ) {
                if (!present_address.value) {
                    error_present_address.innerHTML = "Present address is required";
                    errors += 1;
                }
                if (!present_city_town_village.value) {
                    error_present_city_town_village.innerHTML =
                        "Present city / town / village is required";
                    errors += 1;
                }
                if (!present_post_office.value) {
                    error_present_post_office.innerHTML =
                        "Present post office is required";
                    errors += 1;
                }
                if (!present_district.value) {
                    error_present_district.innerHTML =
                        "Present district is required";
                    errors += 1;
                }
                if (!present_pin_code.value) {
                    error_present_pin_code.innerHTML =
                        "Present PIN code is required";
                    errors += 1;
                }
            } else {
                error_present_address.innerHTML = "";
                error_present_city_town_village.innerHTML = "";
                error_present_post_office.innerHTML = "";
                error_present_district.innerHTML = "";
                error_present_pin_code.innerHTML = "";
            }
            if (!hrms_id.value) {
                error_hrms_id.innerHTML = "HRMS id is required";
                errors += 1;
            }
            if (!designation.value) {
                error_designation.innerHTML = "Designation is required";
                errors += 1;
            }
            if (!basic_pay_range.value) {
                error_basic_pay_range.innerHTML = "Basic pay range required";
                errors += 1;
            }
            if (!basic_pay.value) {
                error_basic_pay.innerHTML = "Basic pay is required";
                errors += 1;
            }
            if (!place_of_posting.value) {
                error_place_of_posting.innerHTML = "Place of posting is required";
                errors += 1;
            }
            if (!headquarter.value) {
                error_headquarter.innerHTML = "Head quarter is required";
                errors += 1;
            }
            if (!doj.value) {
                error_doj.innerHTML = "Date of joining is required";
                errors += 1;
            }
            if (!dor.value) {
                error_dor.innerHTML = "Date of retirement is required";
                errors += 1;
            }
            if (!name_of_office.value) {
                error_name_of_office.innerHTML = "Name of office is required";
                errors += 1;
            }
            if (!office_address.value) {
                error_office_address.innerHTML = "Office address is required";
                errors += 1;
            }
            if (!office_city_town_village.value) {
                error_office_city_town_village.innerHTML =
                    "Office city / town / village is required";
                errors += 1;
            }
            if (!office_post_office.value) {
                error_office_post_office.innerHTML = "Post office is required";
                errors += 1;
            }
            if (!o_district.value) {
                error_o_district.innerHTML = "District is required";
                errors += 1;
            }
            if (!office_pin_code.value) {
                error_office_pin_code.innerHTML = "PIN code is required";
                errors += 1;
            }
            if (!office_phn_no.value) {
                error_office_phn_no.innerHTML = "Office phone no. is required";
                errors += 1;
            }
            if (!ddo_district.value) {
                error_ddo_district.innerHTML = "DDO district is required";
                errors += 1;
            }
            if (!ddo_designation.value) {
                error_ddo_designation.innerHTML = "DDO designation is required";
                errors += 1;
            }
            if (!ddo_address.value) {
                error_ddo_address.innerHTML = "DDO address is required";
                errors += 1;
            }
            if (!flat_type.value) {
                error_flat_type.innerHTML = "Flat type is required";
                errors += 1;
            }
            if (!allotment_reason.value) {
                error_allotment_reason.innerHTML = "Allotment reason is required";
                errors += 1;
            }
            if (!first_preference.value) {
                error_first_preference.innerHTML = "First preference is required";
                errors += 1;
            }
            if (!second_preference.value) {
                error_second_preference.innerHTML = "Second preference is required";
                errors += 1;
            }
            if (!third_preference.value) {
                error_third_preference.innerHTML = "Third preference is required";
                errors += 1;
            }
            if (!doc_payslip.value) {
                error_doc_payslip.innerHTML = "Pay slip is required";
                errors += 1;
            }
            if (!doc_signature.value) {
                error_doc_signature.innerHTML = "Signature (document) is required";
                errors += 1;
            }
            if (allotment_reason == 'General' && !doc_supporting.value) {
                error_doc_supporting.innerHTML = "Supporting document is required";
                errors += 1;
            }
            // Empty field validations end ------

            // String length validations start ------
            if (
                applicant_name.value &&
                (applicant_name.value.length < 3 ||
                    applicant_name.value.length > 255)
            ) {
                error_applicant_name.innerHTML =
                    "Applicant name must be between 3 to 255 characters";
                errors += 1;
            }
            if (
                father_husband_name.value &&
                (father_husband_name.value.length < 3 ||
                    father_husband_name.value.length > 255)
            ) {
                error_father_husband_name.innerHTML =
                    "Father's / Husband's must be between 3 to 255 characters";
                errors += 1;
            }
            // String length validations end ------

            // Regex format validations start ------
            const mobileFormat = /^[6-9]\d{9}$/;
            const pincodeFormat = /^\d{6}$/;
            const hrmsIdFormat = /^\d{10}$/;

            if (mobile_no.value && !mobileFormat.test(mobile_no.value)) {
                error_mobile_no.innerHTML = "Invalid mobile no.";
                errors += 1;
            }
            if (p_pin_code.value && !pincodeFormat.test(p_pin_code.value)) {
                error_p_pin_code.innerHTML = "Invalid PIN code";
                errors += 1;
            }
            if (
                present_pin_code.value &&
                !pincodeFormat.test(present_pin_code.value)
            ) {
                error_present_pin_code.innerHTML = "Invalid PIN code";
                errors += 1;
            }
            if (
                office_pin_code.value &&
                !pincodeFormat.test(office_pin_code.value)
            ) {
                error_office_pin_code.innerHTML = "Invalid PIN code";
                errors += 1;
            }
            if (hrms_id.value && !hrmsIdFormat.test(hrms_id.value)) {
                error_hrms_id.innerHTML = "Invalid HRMS id";
                errors += 1;
            }
            // Regex format validations end ------

            // Date validations start ------
            const today = new Date();
            const birthdate = new Date(dob.value);
            const ageMs = Date.now() - birthdate.getTime();
            const ageDate = new Date(ageMs);
            const age = Math.abs(ageDate.getUTCFullYear() - 1970);

            if (age < 18) {
                error_dob.innerHTML = "Age cannot be less than 18 years";
                errors += 1;
            }
            const selectedDoj = new Date(doj.value);
            if (selectedDoj > today) {
                error_doj.innerHTML = "Date of joining cannot be in future";
                errors += 1;
            }
            const selectedDor = new Date(dor.value);
            if (selectedDor < today) {
                error_dor.innerHTML = "Date of retirement cannot be in past";
                errors += 1;
            }
            // Date validations end ------

            if (errors > 0) {
                $("html, body").animate({
                    scrollTop: 0
                }, 0);
                return false;
            }
            application.submit();
        });
    });
    // Onsubmit validation ends ------

    // File select validations start ------
    function validatePayslip() {
        const error_doc_payslip = document.querySelector("#error_doc_payslip");
        const payslip = document.querySelector("#doc_payslip");
        const file = payslip.files[0];
        const allowedExtensions = ["pdf"];

        if (file) {
            const fileExtension = file.name.split(".").pop().toLowerCase();
            const isAllowedType = allowedExtensions.includes(fileExtension);

            if (!isAllowedType) {
                error_doc_payslip.innerHTML =
                    "Invalid file type. Please upload a PDF file.";
                payslip.value = "";
                return;
            }
            const maxSize = 1024 * 1024;
            if (file.size > maxSize) {
                error_doc_payslip.innerHTML =
                    "File size exceeds 1 MB. Please upload a smaller file.";
                payslip.value = "";
                return;
            }
            error_doc_payslip.innerHTML = "";
        }
    }

    function validateSignature() {
        const error_doc_signature = document.querySelector("#error_doc_signature");
        const signature = document.querySelector("#doc_signature");
        const file = signature.files[0];
        const allowedExtensions = ["jpg", "jpeg", "png", "webp"];

        if (file) {
            const fileExtension = file.name.split(".").pop().toLowerCase();
            const isAllowedType = allowedExtensions.includes(fileExtension);

            if (!isAllowedType) {
                error_doc_signature.innerHTML =
                    "Invalid file type. Please upload a JPG, JPEG, PNG, or WEBP image.";
                signature.value = "";
                return;
            }
            const maxSize = 50 * 1024;
            if (file.size > maxSize) {
                error_doc_signature.innerHTML =
                    "File size exceeds 50 KB. Please upload a smaller image.";
                signature.value = "";
                return;
            }
            error_doc_signature.innerHTML = "";
        }
    }

    function validateSupportDoc() {
        const error_doc_support = document.querySelector("#error_doc_supporting");
        const supporting = document.querySelector("#doc_supporting");
        const file = supporting.files[0];
        const allowedExtensions = ["pdf"];

        if (file) {
            const fileExtension = file.name.split(".").pop().toLowerCase();
            const isAllowedType = allowedExtensions.includes(fileExtension);

            if (!isAllowedType) {
                error_doc_support.innerHTML =
                    "Invalid file type. Please upload a PDF file.";
                supporting.value = "";
                return;
            }
            const maxSize = 1024 * 1024;
            if (file.size > maxSize) {
                error_doc_support.innerHTML =
                    "File size exceeds 1 MB. Please upload a smaller file.";
                supporting.value = "";
                return;
            }
            error_doc_support.innerHTML = "";
        }
    }
    // File select validations end ------

    // Form validation ends -----
</script>
