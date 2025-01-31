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
        <input type="text" class="form-control form-control-sm" id="p_city_town_village" name="p_city_town_village"
            placeholder="Permanent City Town Village"
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
        <select class="form-select" id="p_district" name="p_district" aria-label="district" name="p_district"
            {{ array_key_exists('permanentDistrictCode', $hrms_data) ? 'disabled' : null }}>
            <option value="">- Select -</option>
            @foreach ($districts as $district)
                <option value="{{ $district->hrms_district_id }}"
                    {{ array_key_exists('permanentDistrictCode', $hrms_data) ? ($hrms_data['permanentDistrictCode'] == $district->hrms_district_id ? 'selected' : '') : (old('p_district') == $district->hrms_district_id ? 'selected' : '') }}>
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
        <input type="text" class="form-control form-control-sm" id="present_address" name="present_address"
            placeholder="Present Address"
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
                <option value="{{ $district->hrms_district_id }}"
                    {{ array_key_exists('presentDistrictCode', $hrms_data) ? ($hrms_data['presentDistrictCode'] == $district->hrms_district_id ? 'selected' : '') : (old('present_district') == $district->hrms_district_id ? 'selected' : '') }}>
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
        <input type="text" class="form-control form-control-sm" id="present_pin_code" name="present_pin_code"
            placeholder="Present Pin Code" onkeyup="return numberOnly(this)"
            value="{{ array_key_exists('presentPincode', $hrms_data) ? $hrms_data['presentPincode'] : old('present_pin_code') }}"
            {{ array_key_exists('presentPincode', $hrms_data) ? 'readonly' : null }}>
        <label for="present_pin_code">Pin Code</label>
        <span id="error_present_pin_code" class="text-danger"></span>
        @error('present_pin_code')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
