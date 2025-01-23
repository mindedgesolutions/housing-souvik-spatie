@extends('layouts.dashboard-master')

@section('page-header')
    Application For New Allotment
@endsection

@section('dashboard-body')
    <div class="row">
        <form class="row g-3" action="{{ route('hrms.store') }}" method="POST">
            @csrf
            <div>
                <h5>&#9680; Personal Information (According to Service Book)</h5>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="applicant_name" name ="applicant_name"
                        placeholder="Name of the Applicant"
                        value="{{ array_key_exists('applicantName', $hrms_data) == true ? $hrms_data['applicantName'] : old('applicant_name') }}"
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
                        name="father_husband_name"placeholder="Father's / Husband's Name"
                        value="{{ array_key_exists('guardianName', $hrms_data) == true ? $hrms_data['guardianName'] : old('father_husband_name') }}"
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
                    <input type="number" class="form-control form-control-sm" id="mobile_no" name="mobile_no"
                        placeholder="Mobile Number" pattern="\d{10}" maxlength="10" value="{{ old('mobile_no') }}">
                    <label for="mobile_no">Mobile Number</label>
                    @error('mobile_no')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="email" class="form-control form-control-sm" id="email" name="email"
                        placeholder="Email" value="{{ old('email') }}">
                    <label for="email">Email ID</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-floating">
                    <input type="date" class="form-control form-control-sm" id="dob" name="dob"
                        value="{{ old('dob') }}">
                    <label for="dob">Date of Birth (According to Service Book)</label>
                    @error('dob')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-5">
                <label>Gender</label>
                <div class="d-flex align-items-center">
                    <div class="form-check me-5">
                        <input type="radio" class="form-check-input" id="gender_male" name="gender" value="male">
                        <label class="form-check-label" for="gender_male">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="gender_female" name="gender" value="female">
                        <label class="form-check-label" for="gender_female">Female</label>
                    </div>
                </div>
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
                        placeholder="Permanent Address" value="{{ old('p_address') }}">
                    <label for="p_address">Address</label>
                    @error('p_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="p_city_town_village"
                        name="p_city_town_village" placeholder="Permanent City Town Village">
                    <label for="p_city_town_village">City / Town / Village</label>
                    @error('p_city_town_village')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="p_post_office" name="p_post_office"
                        placeholder="Post Office" value="{{ old('p_post_office') }}">
                    <label for="p_post_office">Post Office</label>
                    @error('p_post_office')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="p_district" name="p_district" aria-label="district"
                        name="p_district">
                        <option value="">- Select -</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_code }}"
                                {{ old('p_district') == $district->district_code ? 'selected' : '' }}>
                                {{ $district->district_name }}</option>
                        @endforeach
                    </select>
                    <label for="p_district">Select District</label>
                    <span id="error_p_district" class="text-danger"></span>
                    @error('p_district')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="p_pin_code" name="p_pin_code"
                        placeholder="Permanent Pin Code" value="{{ old('p_pin_code') }}">
                    <label for="p_pin_code">Pin Code</label>
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
                        name="present_address" placeholder="Present Address" value="{{ old('present_address') }}">
                    <label for="present_address">Address</label>
                    @error('present_address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="present_city_town_village"
                        name="present_city_town_village" placeholder="Present City Town Village"
                        value="{{ old('present_city_town_village') }}">
                    <label for="present_city_town_village">City / Town / Village</label>
                    @error('present_city_town_village')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="present_post_office"
                        name="present_post_office" placeholder="Post Office" value="{{ old('present_post_office') }}">
                    <label for="present_post_office">Post Office</label>
                    @error('present_post_office')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="present_district" name="present_district" aria-label="district">
                        <option value="">- Select -</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_code }}"
                                {{ old('present_district') == $district->district_code ? 'selected' : '' }}>
                                {{ $district->district_name }}</option>
                        @endforeach
                    </select>
                    <label for="present_district">Select District</label>
                    @error('present_district')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="present_pin_code"
                        name="present_pin_code" placeholder="Present Pin Code" pattern="\d{6}" maxlength="6"
                        value="{{ old('present_pin_code') }}">
                    <label for="present_pin_code">Pin Code</label>
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
                    <input type="number" class="form-control form-control-sm" id="hrms_id" name="hrms_id"
                        placeholder="HRMS ID" pattern="\d{10}" maxlength="10"
                        value="{{ array_key_exists('hrmsId', $hrms_data) == true ? $hrms_data['hrmsId'] : old('hrms_id') }}"
                        {{ array_key_exists('hrmsId', $hrms_data) ? 'readonly' : null }}>
                    <label for="hrms_id">Employee HRMS ID</label>
                    @error('hrms_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="designation" name="designation"
                        placeholder="Designation" value="{{ old('designation') }}">
                    <label for="designation">Employee Designation</label>
                    @error('designation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="basic_pay_range"
                        name="basic_pay_range" placeholder="Basic Pay Range" value="{{ old('basic_pay_range') }}">
                    <label for="basic_pay_range">Basic Pay Range</label>
                    @error('basic_pay_range')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="number" class="form-control form-control-sm" id="basic_pay" name="basic_pay"
                        placeholder="Basic Pay" value="{{ old('basic_pay') }}">
                    <label for="basic_pay">Basic Pay</label>
                    @error('basic_pay')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="place_of_posting"
                        name="place_of_posting" placeholder="Place of Posting">
                    <label for="place_of_posting">Place of Posting</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="headquarter" name="headquarter"
                        placeholder="Headquarter">
                    <label for="headquarter">Headquarter</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control form-control-sm" id="doj" name="doj">
                    <label for="doj">Date of Joining (According to Service Book)</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control form-control-sm" id="dor" name="dor">
                    <label for="dor">Date of Retirement (According to Service Book)</label>
                </div>
            </div>
            <div>
                <h5>&#9680; Name & Address of the Office</h5>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="name_of_office" name="name_of_office"
                        placeholder="Name of Office">
                    <label for="name_of_office">Name of the office</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_address" name="office_address"
                        placeholder="Office Address">
                    <label for="office_address">Office Address</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_city_town_village"
                        name="office_city_town_village" placeholder="Office City Town Village">
                    <label for="office_city_town_village">Office City / Town / Village</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_post_office"
                        name="office_post_office" placeholder="Office Post Office">
                    <label for="office_post_office">Post Office</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating">
                    <select class="form-select" id="o_district" name="o_district" aria-label="office district"
                        name="o_district">
                        <option selected="">- Select -</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
                        @endforeach
                    </select>
                    <label for="o_district">Select District</label>
                    <span id="error_o_district" class="text-danger"></span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="office_pin_code"
                        name="office_pin_code" placeholder="Office Pin Code" pattern="\d{6}" maxlength="6">
                    <label for="office_pin_code">Pin Code</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="number" class="form-control form-control-sm" id="office_phn_no" name="office_phn_no"
                        placeholder="Office Phone Number">
                    <label for="office_phn_no">Phone No. (with STD code)</label>
                </div>
            </div>
            <div>
                <h5>&#9680; DDO Details</h5>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" id="ddo_district" name="ddo_district" aria-label="ddo district"
                        name="ddo_district">
                        <option selected="">- Select -</option>
                        <!-- @foreach ($districts as $district)
    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
    @endforeach -->
                    </select>
                    <label for="ddo_district">Select DDO District</label>
                    <span id="error_ddo_district" class="text-danger"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" id="ddo_designation" name="ddo_designation" aria-label="ddo designation"
                        name="ddo_designation">
                        <option selected="">- Select -</option>
                        <!-- @foreach ($districts as $district)
    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
    @endforeach -->
                    </select>
                    <label for="ddo_designation">Select DDO Designation</label>
                    <span id="error_ddo_designation" class="text-danger"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="DDO Address" id="ddo_address"></textarea>
                    <label for="ddo_address">DDO Address</label>
                </div>
            </div>
            <div>
                <h5>&#9680; Allotment Category</h5>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control form-control-sm" id="flat_type" name="flat_type"
                        placeholder="Flat Type">
                    <label for="flat_type">Flat Type</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select class="form-select" id="allotment_reason" name="allotment_reason"
                        aria-label="allotment reason" name="allotment_reason">
                        <option selected="">- Select -</option>
                        <!-- @foreach ($districts as $district)
    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
    @endforeach -->
                    </select>
                    <label for="allotment_reason">Select Allotment Reason</label>
                    <span id="error_allotment_reason" class="text-danger"></span>
                </div>
            </div>
            <div>
                <h5>&#9680; Housing Preference</h5>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="first_preference" name="first_preference"
                        aria-label="first preference" name="first_preference">
                        <option selected="">- Select -</option>
                        <!-- @foreach ($districts as $district)
    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
    @endforeach -->
                    </select>
                    <label for="first_preference">Select First Preference</label>
                    <span id="error_first_preference" class="text-danger"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="second_preference" name="second_preference"
                        aria-label="second preference" name="second_preference">
                        <option selected="">- Select -</option>
                        <!-- @foreach ($districts as $district)
    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
    @endforeach -->
                    </select>
                    <label for="second_preference">Select Second Preference</label>
                    <span id="error_second_preference" class="text-danger"></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <select class="form-select" id="third_preference" name="third_preference"
                        aria-label="third preference" name="third_preference">
                        <option selected="">- Select -</option>
                        <!-- @foreach ($districts as $district)
    <option value="{{ $district->district_code }}">{{ $district->district_name }}</option>
    @endforeach -->
                    </select>
                    <label for="third_preference">Select Third Preference</label>
                    <span id="error_third_preference" class="text-danger"></span>
                </div>
            </div>
            <div>
                <h5>&#9680; Upload Documents</h5>
            </div>
            <div class="col-md-6">
                <h6><b>Upload Your Latest Payslip</b></h6>
                <input type="file" class="form-control" aria-label="Latest Payslip">
                <p><small><b>Allowed Extension: pdf<br>Maximum File Size: 1 MB</b></small></p>
            </div>
            <div class="col-md-6">
                <h6><b>Upload Your Scanned Signature</b></h6>
                <input type="file" class="form-control" aria-label="Scanned Signature">
                <p><small><b>Allowed Extension: jpg, jpeg<br>Dimensions: 140 pixels (Width) x 60 pixels (Height)<br>Maximum
                            File Size: 50 KB</b></small></p>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit"class="btn btn-success" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
@endsection

<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script>
    // $(document).ready(function() {
    //     $('#submit-btn').click(function() {

    //         var error_applicant_name = '';
    //         var error_father_husband_name = '';

    //         if ($.trim($('#applicant_name').val()).length == 0) {
    //             error_applicant_name = 'Field is required';
    //             $('#error_applicant_name').text(error_applicant_name);
    //             $('#applicant_name').addClass('has-error');
    //         } else {
    //             error_applicant_name = '';
    //             $('#error_applicant_name').text(error_title);
    //             $('#applicant_name').removeClass('has-error');
    //         }

    //         if ($.trim($('#father_husband_name').val()).length == 0) {
    //             error_father_husband_name = 'Field is required';
    //             $('#error_father_husband_name').text(error_father_husband_name);
    //             $('#father_husband_name').addClass('has-error');
    //         } else {
    //             error_father_husband_name = '';
    //             $('#error_father_husband_name').text(error_father_husband_name);
    //             $('#father_husband_name').removeClass('has-error');
    //         }

    //         if (error_applicant_name != '' || error_father_husband_name != '') {
    //             return false;
    //         } else {
    //             return true;
    //         }
    //     });
    // });

    function copyPermanentAddress() {
        const checkbox = document.getElementById('sameAsPermanent');

        // Get permanent address fields
        const permanentAddress = document.getElementById('p_address').value;
        const permanentCity = document.getElementById('p_city_town_village').value;
        const permanentPostOffice = document.getElementById('p_post_office').value;
        const permanentDistrict = document.getElementById('p_district').value;
        const permanentPinCode = document.getElementById('p_pin_code').value;

        // Set present address fields based on checkbox status
        if (checkbox.checked) {
            document.getElementById('present_address').value = permanentAddress;
            document.getElementById('present_city_town_village').value = permanentCity;
            document.getElementById('present_post_office').value = permanentPostOffice;
            document.getElementById('present_district').value = permanentDistrict;
            document.getElementById('present_pin_code').value = permanentPinCode;
        } else {
            document.getElementById('present_address').value = '';
            document.getElementById('present_city_town_village').value = '';
            document.getElementById('present_post_office').value = '';
            document.getElementById('present_district').value = '';
            document.getElementById('present_pin_code').value = '';
        }
    }
</script>
