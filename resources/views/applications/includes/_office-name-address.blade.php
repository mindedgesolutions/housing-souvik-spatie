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
        <input type="text" class="form-control form-control-sm" id="office_post_office" name="office_post_office"
            placeholder="Office Post Office"
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
        <input type="text" class="form-control form-control-sm" id="office_pin_code" name="office_pin_code"
            placeholder="Office Pin Code" onkeyup="return numberOnly(this)"
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
