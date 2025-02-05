<div>
    <h5>&#9680; Applicant's Official Information</h5>
</div>
<div class="col-md-4">
    <div class="form-floating">
        <input type="text" class="form-control form-control-sm" id="hrms_id" name="hrms_id" placeholder="HRMS ID"
            onkeyup="return numberOnly(this)"
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
        <select class="form-select" id="basic_pay_range" name="basic_pay_range" aria-label="district" disabled>
            <option value="">- Select -</option>
            @foreach ($payBands as $key => $payBand)
                <option value="{{ $key }}" @selected($key == $empPayBandId)>
                    {{ $payBand }}</option>
            @endforeach
        </select>
        <label for="basic_pay_range">Basic Pay Range</label>
        <span id="error_basic_pay_range" class="text-danger"></span>
        @error('basic_pay_range')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-floating">
        <input type="text" class="form-control form-control-sm" id="basic_pay" name="basic_pay"
            placeholder="Basic Pay" onkeyup="return numberOnly(this)"
            value="{{ array_key_exists('payInThePayBand', $hrms_data) ? $hrms_data['payInThePayBand'] : old('basic_pay') }}"
            {{ array_key_exists('payInThePayBand', $hrms_data) ? 'readonly' : null }}>
        <label for="basic_pay">Basic Pay</label>
        <span id="error_basic_pay" class="text-danger"></span>
        @error('basic_pay')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-floating">
        <input type="text" class="form-control form-control-sm" id="place_of_posting" name="place_of_posting"
            placeholder="Place of Posting" value="{{ old('place_of_posting') }}">
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
