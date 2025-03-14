@extends('layouts.dashboard-master')

@section('title', 'Application For Category Shifting | ' . config('app.name'))

@section('page-header', 'Application For Category Shifting')

@section('dashboard-body')
    <div class="row">
        <form class="row g-3" action="{{ route('cs.store') }}" id="application" autocomplete="off" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Hidden fields start --}}
            <input type="hidden" name="ddo_id" value="{{ $ddoInfo->ddo_id }}">
            <input type="hidden" name="basic_pay_range_value" value="{{ $empPayBandId }}" />
            <input type="hidden" name="grade_pay" value="{{ $hrms_data['gradePay'] }}" />
            {{-- Hidden fields end --}}

            {{-- ------ Personal information ------ --}}
            @include('applications.includes._personal-info')

            {{-- ------ Address ------ --}}
            @include('applications.includes._address-info')

            {{-- ------ Official information ------ --}}
            @include('applications.includes._official-info')

            {{-- ------ Office name and address ------ --}}
            @include('applications.includes._office-name-address')

            {{-- ------ DDO info ------ --}}
            @include('applications.includes._ddo-info')

            {{-- ------ Other section ------ --}}

            <div class="col-md-12 text-center">
                <button type="submit"class="btn btn-success" id="submit-btn">Submit</button>
            </div>
        </form>
    </div>
@endsection

<script src="{{ asset('/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
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
            // if (selectedDor < today) {
            //     error_dor.innerHTML = "Date of retirement cannot be in past";
            //     errors += 1;
            // }
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
</script>
