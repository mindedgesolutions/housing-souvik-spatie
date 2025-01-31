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
        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email"
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
