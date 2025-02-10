@extends('layouts.dashboard-master')

@section('page-header', 'Occupant Data Entry')

@section('title', 'Occupant Data Entry | ' . config('app.name'))

@section('dashboard-body')
    <div class="row">
        <form action="{{ route('occupant-data.store') }}" id="occupant-entry-form" method="post" autocomplete="off">
            @csrf
            @method('POST')

            <div class="col-md-6">
                <div class="form-floating">
                    <div class="form-item form-type-select form-item-rhe-name">
                        <label for="edit-rhe-name">Name of the RHE <span class="form-required"
                                title="This field is required.">*</span></label>
                        <select class="form-select form-select required ajax-processed" id="edit_rhe_name" name="rhe_name">
                            <option value="" selected="selected">- Select -</option>
                            @foreach ($housingEstates as $housingEstate)
                                <option value="{{ $housingEstate->estate_id }}">
                                    {{ $housingEstate->estate_address ?? $housingEstate->estate_name }}</option>
                            @endforeach
                        </select>
                        <span id="error_edit_rhe_name" class="text-danger"></span>
                        @error('rhe_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="flat_type_replace">
                <div class="form-floating">
                    <div class="form-item form-type-select form-item-flat-type">
                        <label for="edit-flat-type">Flat Type <span class="form-required"
                                title="This field is required.">*</span></label>
                        <select class="form-select form-select required ajax-processed" id="edit_flat_type"
                            name="flat_type">
                            <option value="" selected="selected">- Select -</option>
                        </select>
                        <span id="error_edit_flat_type" class="text-danger"></span>
                        @error('flat_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="block_name_replace">
                <div class="form-floating">
                    <div class="form-item form-type-select form-item-block-name">
                        <label for="edit-block-name">Name of the Block <span class="form-required"
                                title="This field is required.">*</span></label>
                        <select class="form-select form-select required ajax-processed" id="edit_block_name"
                            name="block_name">
                            <option value="" selected="selected">- Select -</option>
                        </select>
                        <span id="error_edit_block_name" class="text-danger"></span>
                        @error('block_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="flat_no_replace">
                <div class="form-floating">
                    <div class="form-item form-type-select form-item-flat-no">
                        <label for="edit-flat-no">Flat No. <span class="form-required"
                                title="This field is required.">*</span></label>
                        <select class="form-select form-select required ajax-processed" id="edit_flat_no" name="flat_no">
                        </select>
                        <span id="error_edit_flat_no" class="text-danger"></span>
                        @error('flat_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <fieldset class="form-wrapper mt-4" id="edit-prrsonal-info">
                <legend>
                    <span class="fieldset-legend">Occupant's Personal Information(According to Service Book)</span>
                </legend>
                <div class="fieldset-wrapper mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <div class="form-item form-type-textfield form-item-occupant-name">
                                    <label for="edit-occupant-name">Occupant's Name <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <input class="form-control form-text required" type="text" id="edit_occupant_name"
                                        name="occupant_name" value="{{ old('occupant_name') }}" size="60"
                                        maxlength="128" onkeyup="return charOnly(this)">
                                    <span id="error_edit_occupant_name" class="text-danger"></span>
                                    @error('occupant_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <div class="form-item form-type-textfield form-item-occupant-father-name">
                                    <label for="edit-occupant-father-name">Father's / Husband's Name <span
                                            class="form-required" title="This field is required.">*</span></label>
                                    <input class="form-control form-text required" type="text"
                                        id="edit_occupant_father_name" name="occupant_father_name"
                                        value="{{ old('occupant_father_name') }}" size="60" maxlength="128"
                                        onkeyup="return charOnly(this)">
                                    <span id="error_edit_occupant_father_name" class="text-danger"></span>
                                    @error('occupant_father_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <fieldset class="form-wrapper" id="edit-permanent-address">
                        <legend><span class="fieldset-legend">Permanent Address</span></legend>
                        <div class="fieldset-wrapper">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <div class="form-item form-type-textfield form-item-permanent-street">
                                            <label for="edit-permanent-street">Address <span class="form-required"
                                                    title="This field is required.">*</span></label>
                                            <input class="form-control form-text required" type="text"
                                                id="edit_permanent_street" name="permanent_street"
                                                value="{{ old('permanent_street') }}" size="60" maxlength="128">
                                            <span id="error_edit_permanent_street" class="text-danger"></span>
                                            @error('permanent_street')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <div class="form-item form-type-textfield form-item-permanent-city-town-village">
                                            <label for="edit-permanent-city-town-village">City / Town / Village <span
                                                    class="form-required" title="This field is required.">*</span></label>
                                            <input class="form-control form-text required" type="text"
                                                id="edit_permanent_city_town_village" name="permanent_city_town_village"
                                                value="{{ old('permanent_city_town_village') }}" size="60"
                                                maxlength="128">
                                            <span id="error_edit_permanent_city_town_village" class="text-danger"></span>
                                            @error('permanent_city_town_village')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <div class="form-item form-type-textfield form-item-permanent-post-office">
                                            <label for="edit-permanent-post-office">Post Office <span
                                                    class="form-required" title="This field is required.">*</span></label>
                                            <input class="form-control form-text required" type="text"
                                                id="edit_permanent_post_office" name="permanent_post_office"
                                                value="{{ old('permanent_post_office') }}" size="60"
                                                maxlength="128">
                                            <span id="error_edit_permanent_post_office" class="text-danger"></span>
                                            @error('permanent_post_office')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <div class="form-item form-type-select form-item-permanent-district">
                                            <label for="edit-permanent-district">District <span class="form-required"
                                                    title="This field is required.">*</span></label>
                                            <select class="form-select form-select required" id="edit_permanent_district"
                                                name="permanent_district">
                                                <option value="" selected="selected">- Select -</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district['district_code'] }}"
                                                        @selected(old('permanent_district') == $district['district_code'])>
                                                        {{ $district['district_name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span id="error_edit_permanent_district" class="text-danger"></span>
                                            @error('permanent_district')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <div class="form-item form-type-textfield form-item-permanent-pincode">
                                            <label for="edit-permanent-pincode">Pincode <span class="form-required"
                                                    title="This field is required.">*</span></label>
                                            <input class="form-control form-text required" type="text"
                                                id="edit_permanent_pincode" name="permanent_pincode"
                                                value="{{ old('permanent_pincode') }}" size="60" maxlength="6"
                                                onkeyup="return numberOnly(this)">
                                            <span id="error_edit_permanent_pincode" class="text-danger"></span>
                                            @error('permanent_pincode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div id="reload_present_address">
                        <fieldset class="form-wrapper" id="edit-present-address">
                            <legend><span class="fieldset-legend">Present Address</span></legend>
                            <div class="fieldset-wrapper">
                                <div class="row">
                                    <div class="col-md-6" id="reload_present_street">
                                        <div class="form-floating">
                                            <div class="form-item form-type-textfield form-item-present-street">
                                                <label for="edit-present-street">Address <span class="form-required"
                                                        title="This field is required.">*</span></label>
                                                <input class="form-control form-text required" type="text"
                                                    id="edit_present_street" name="present_street"
                                                    value="{{ old('present_street') }}" size="60" maxlength="128">
                                                <span id="error_edit_present_street" class="text-danger"></span>
                                                @error('present_street')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="reload_present_city_town_village">
                                        <div class="form-floating">
                                            <div class="form-item form-type-textfield form-item-present-city-town-village">
                                                <label for="edit-present-city-town-village">City / Town / Village <span
                                                        class="form-required"
                                                        title="This field is required.">*</span></label>
                                                <input class="form-control form-text required" type="text"
                                                    id="edit_present_city_town_village" name="present_city_town_village"
                                                    value="{{ old('present_city_town_village') }}" size="60"
                                                    maxlength="128">
                                                <span id="error_edit_present_city_town_village"
                                                    class="text-danger"></span>
                                                @error('present_city_town_village')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" id="reload_present_post_office">
                                        <div class="form-floating">
                                            <div class="form-item form-type-textfield form-item-present-post-office">
                                                <label for="edit-present-post-office">Post Office <span
                                                        class="form-required"
                                                        title="This field is required.">*</span></label>
                                                <input class="form-control form-text required" type="text"
                                                    id="edit_present_post_office" name="present_post_office"
                                                    value="{{ old('present_post_office') }}" size="60"
                                                    maxlength="128">
                                                <span id="error_edit_present_post_office" class="text-danger"></span>
                                                @error('present_post_office')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="reload_present_district">
                                        <div class="form-floating">
                                            <div class="form-item form-type-select form-item-present-district">
                                                <label for="edit-present-district">District <span class="form-required"
                                                        title="This field is required.">*</span></label>
                                                <select class="form-select form-select required"
                                                    id="edit_present_district" name="present_district">
                                                    <option value="" selected="selected">- Select -</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district['district_code'] }}"
                                                            @selected(old('present_district') == $district['district_code'])>
                                                            {{ $district['district_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="error_edit_present_district" class="text-danger"></span>
                                                @error('present_district')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" id="reload_present_pincode">
                                        <div class="form-floating">
                                            <div class="form-item form-type-textfield form-item-present-pincode">
                                                <label for="edit-present-pincode">Pincode <span class="form-required"
                                                        title="This field is required.">*</span></label>
                                                <input class="form-control form-text required" type="text"
                                                    id="edit_present_pincode" name="present_pincode"
                                                    value="{{ old('present_pincode') }}" size="60" maxlength="6"
                                                    onkeyup="return numberOnly(this)">
                                                <span id="error_edit_present_pincode" class="text-danger"></span>
                                                @error('present_pincode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <div class="form-item form-type-textfield form-item-mobile">
                                    <label for="edit-mobile">Mobile no <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <input id="edit_mobile_no" class="form-control form-text required" type="text"
                                        name="mobile" value="{{ old('mobile') }}" size="60" maxlength="10"
                                        onkeyup="return numberOnly(this)">
                                    <span id="error_edit_mobile_no" class="text-danger"></span>
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <div class="form-item form-type-textfield form-item-email">
                                    <label for="edit-email">Email ID <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <input class="form-control form-text required" type="text" id="edit_email"
                                        name="email" value="{{ old('email') }}" size="60" maxlength="128">
                                    <span id="error_edit_email" class="text-danger"></span>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <div class="form-item form-type-textfield form-item-dob">
                                    <label for="edit-dob">Date of Birth(According to Service Book) <span
                                            class="form-required" title="This field is required.">*</span></label>
                                    <input id="edit_dob" class="form-control form-text required hasDatepicker"
                                        type="date" name="dob" value="{{ old('dob') }}">
                                    <span id="error_edit_dob" class="text-danger"></span>
                                    @error('dob')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <div class="form-item form-type-radios form-item-gender">
                                    <label for="edit-gender">Gender <span class="form-required"
                                            title="This field is required.">*</span></label>
                                    <div id="edit-gender" class="form-radios">
                                        <div class="form-item form-type-radio form-item-gender">
                                            <input type="radio" id="edit-gender-m" name="gender" value="M"
                                                checked="checked" @checked(old('gender') == 'M') class="form-radio"> <label
                                                class="option" for="edit-gender-m">Male </label>
                                        </div>
                                        <div class="form-item form-type-radio form-item-gender">
                                            <input type="radio" id="edit-gender-f" name="gender" value="F"
                                                @checked(old('gender') == 'F') class="form-radio"> <label class="option"
                                                for="edit-gender-f">Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div id="submit_button_replace" class="mt-4">
                <input class="btn bg-primary btn-sm px-5 rounded-pill text-white fw-bolder form-submit" type="submit"
                    id="edit-submit-button" name="op" value="Insert Occupant Details">
            </div>
        </form>
    </div>
@endsection

<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    $(document).ready(function() {
        // ----------------- Flat Type -----------------
        $('#edit_rhe_name').on('change', function() {
            $('#loader').show();

            var estate_id = $(this).val();
            $('edit_flat_type').html('');

            if (estate_id) {
                $.ajax({
                    url: "{{ route('occupant-data.occupant.flat.type') }}?estate_id=" +
                        estate_id,
                    method: 'get',
                    success: function(res) {
                        $('#loader').hide();

                        $('#edit_flat_type').html(
                            '<option value="">- Select -</option>');
                        $.each(res.flatTypes, function(key, value) {
                            $('#edit_flat_type').append('<option value="' + value
                                .flat_type_id + '")>' + value.flat_type.trim() +
                                '</option>');
                        });

                    }
                });
            }
        });

        // ----------------- Block Name -----------------

        $('#edit_flat_type').on('change', function() {
            $('#loader').show();

            var flat_type_id = $(this).val();
            var estate_id = $('#edit_rhe_name').val();

            $('#edit_block_name').html('');

            if (flat_type_id) {
                $.ajax({
                    url: "{{ route('occupant-data.occupant.block') }}?estate_id=" +
                        estate_id + "&flat_type_id=" +
                        flat_type_id,
                    method: 'get',
                    success: function(res) {
                        $('#loader').hide();

                        $('#edit_block_name').html(
                            '<option value="">- Select -</option>');
                        $.each(res.blocks, function(key, value) {
                            $('#edit_block_name').append('<option value="' + value
                                .block_id + '")>' + value.block_name.trim() +
                                '</option>');
                        });
                    }
                });
            }
        });

        // ----------------- Flat No -----------------
        $('#edit_block_name').on('change', function() {
            $('#loader').show();

            var estate_id = $('#edit_rhe_name').val();
            var flat_type_id = $('#edit_flat_type').val();
            var block_name = $(this).val();

            $('#edit_flat_no').html('');

            if (block_name) {
                $.ajax({
                    url: "{{ route('occupant-data.occupant.flatno') }}?estate_id=" +
                        estate_id + "&flat_type_id=" + flat_type_id + "&block_name=" +
                        block_name,
                    method: 'get',
                    success: function(res) {
                        $('#loader').hide();

                        $('#edit_flat_no').html(
                            '<option value="">- Select -</option>');
                        $.each(res.flatNos, function(key, value) {
                            $('#edit_flat_no').append('<option value="' + value
                                .flat_id + '")>' + value.flat_no +
                                '</option>');
                        });
                    }
                });
            }
        })
    })

    // ----------------- Form validation -----------------
    document.addEventListener("DOMContentLoaded", function() {
        const entryForm = document.querySelector("#occupant-entry-form");

        entryForm.addEventListener("submit", function(e) {
            e.preventDefault();

            let error_edit_rhe_name = document.querySelector(
                "#error_edit_rhe_name"
            );
            let error_edit_flat_type = document.querySelector(
                "#error_edit_flat_type"
            );
            let error_edit_block_name = document.querySelector("#error_edit_block_name");
            let error_edit_flat_no = document.querySelector("#error_edit_flat_no");
            let error_edit_occupant_name = document.querySelector("#error_edit_occupant_name");
            let error_edit_occupant_father_name = document.querySelector(
                "#error_edit_occupant_father_name");
            let error_edit_permanent_street = document.querySelector(
                "#error_edit_permanent_street"
            );
            let error_edit_permanent_city_town_village = document.querySelector(
                "#error_edit_permanent_city_town_village"
            );
            let error_edit_permanent_post_office = document.querySelector(
                "#error_edit_permanent_post_office");
            let error_edit_permanent_district = document.querySelector(
                "#error_edit_permanent_district");
            let error_edit_permanent_pincode = document.querySelector(
                "#error_edit_permanent_pincode"
            );
            let error_edit_present_street = document.querySelector(
                "#error_edit_present_street"
            );
            let error_edit_present_city_town_village = document.querySelector(
                "#error_edit_present_city_town_village"
            );
            let error_edit_present_post_office = document.querySelector(
                "#error_edit_present_post_office"
            );
            let error_edit_present_district = document.querySelector(
                "#error_edit_present_district"
            );
            let error_edit_present_pincode = document.querySelector("#error_edit_present_pincode");
            let error_edit_mobile_no = document.querySelector("#error_edit_mobile_no");
            let error_edit_email = document.querySelector("#error_edit_email");
            let error_edit_dob = document.querySelector("#error_edit_dob");

            // Default error messages start ------
            error_edit_rhe_name.innerHTML = "";
            error_edit_flat_type.innerHTML = "";
            error_edit_block_name.innerHTML = "";
            error_edit_flat_no.innerHTML = "";
            error_edit_occupant_name.innerHTML = "";
            error_edit_occupant_father_name.innerHTML = "";
            error_edit_permanent_street.innerHTML = "";
            error_edit_permanent_city_town_village.innerHTML = "";
            error_edit_permanent_post_office.innerHTML = "";
            error_edit_permanent_district.innerHTML = "";
            error_edit_permanent_pincode.innerHTML = "";
            error_edit_present_street.innerHTML = "";
            error_edit_present_city_town_village.innerHTML = "";
            error_edit_present_post_office.innerHTML = "";
            error_edit_present_district.innerHTML = "";
            error_edit_present_pincode.innerHTML = "";
            error_edit_mobile_no.innerHTML = "";
            error_edit_email.innerHTML = "";
            error_edit_dob.innerHTML = "";
            // Default error messages end ------

            // Form fields start ------
            const edit_rhe_name = document.querySelector("#edit_rhe_name");
            const edit_flat_type = document.querySelector("#edit_flat_type");
            const edit_block_name = document.querySelector("#edit_block_name");
            const edit_flat_no = document.querySelector("#edit_flat_no");
            const edit_occupant_name = document.querySelector("#edit_occupant_name");
            const edit_occupant_father_name = document.querySelector(
                "#edit_occupant_father_name"
            );
            const edit_permanent_street = document.querySelector("#edit_permanent_street");
            const edit_permanent_city_town_village = document.querySelector(
                "#edit_permanent_city_town_village");
            const edit_permanent_post_office = document.querySelector("#edit_permanent_post_office");
            const edit_permanent_district = document.querySelector("#edit_permanent_district");
            const edit_permanent_pincode = document.querySelector(
                "#edit_permanent_pincode"
            );
            const edit_present_street = document.querySelector("#edit_present_street");
            const edit_present_city_town_village = document.querySelector(
                "#edit_present_city_town_village");
            const edit_present_post_office = document.querySelector("#edit_present_post_office");
            const edit_present_district = document.querySelector(
                "#edit_present_district"
            );
            const edit_present_pincode = document.querySelector(
                "#edit_present_pincode"
            );
            const edit_mobile_no = document.querySelector("#edit_mobile_no");
            const edit_email = document.querySelector("#edit_email");
            const edit_dob = document.querySelector("#edit_dob");
            // Form fields end ------

            let errors = 0;

            // Empty field validations start ------
            if (!edit_rhe_name.value) {
                error_edit_rhe_name.innerHTML = "Housing estate name is required";
                errors += 1;
            }
            if (!edit_flat_type.value) {
                error_edit_flat_type.innerHTML = "Flat type is required";
                errors += 1;
            }
            if (!edit_block_name.value) {
                error_edit_block_name.innerHTML = "Block name is required";
                errors += 1;
            }
            if (!edit_flat_no.value) {
                error_edit_flat_no.innerHTML = "Flat no. is required";
                errors += 1;
            }
            if (!edit_occupant_name.value) {
                error_edit_occupant_name.innerHTML = "Occupant's name is required";
                errors += 1;
            }
            if (!edit_occupant_father_name.value) {
                error_edit_occupant_father_name.innerHTML = "Father's / Husband's name is required";
                errors += 1;
            }
            if (!edit_permanent_street.value) {
                error_edit_permanent_street.innerHTML = "Permanent address is required";
                errors += 1;
            }
            if (!edit_permanent_city_town_village.value) {
                error_edit_permanent_city_town_village.innerHTML =
                    "Permanent city / town / village is required";
                errors += 1;
            }
            if (!edit_permanent_post_office.value) {
                error_edit_permanent_post_office.innerHTML = "Post office is required";
                errors += 1;
            }
            if (!edit_permanent_district.value) {
                error_edit_permanent_district.innerHTML = "Permanent district is required";
                errors += 1;
            }
            if (!edit_permanent_pincode.value) {
                error_edit_permanent_pincode.innerHTML = "Permanent PIN code is required";
                errors += 1;
            }
            if (!edit_present_street.value) {
                error_edit_present_street.innerHTML = "Present address is required";
                errors += 1;
            }
            if (!edit_present_city_town_village.value) {
                error_edit_present_city_town_village.innerHTML =
                    "Present city / town / village is required";
                errors += 1;
            }
            if (!edit_present_post_office.value) {
                error_edit_present_post_office.innerHTML = "Post office is required";
                errors += 1;
            }
            if (!edit_present_district.value) {
                error_edit_present_district.innerHTML = "Present district is required";
                errors += 1;
            }
            if (!edit_present_pincode.value) {
                error_edit_present_pincode.innerHTML = "Present PIN code is required";
                errors += 1;
            }
            if (!edit_mobile_no.value) {
                error_edit_mobile_no.innerHTML = "Mobile no. is required";
                errors += 1;
            }
            if (!edit_email.value) {
                error_edit_email.innerHTML = "Email is required";
                errors += 1;
            }
            if (!edit_dob.value) {
                error_edit_dob.innerHTML = "Date of birth is required";
                errors += 1;
            }
            // Empty field validations end ------

            // Date validations start ------
            const today = new Date();
            const birthdate = new Date(edit_dob.value);
            const ageMs = Date.now() - birthdate.getTime();
            const ageDate = new Date(ageMs);
            const age = Math.abs(ageDate.getUTCFullYear() - 1970);

            if (age < 18) {
                error_edit_dob.innerHTML = "Age cannot be less than 18 years";
                errors += 1;
            }
            // Date validations end ------

            // Regex format validations start ------
            const mobileFormat = /^[6-9]\d{9}$/;
            const pincodeFormat = /^\d{6}$/;
            const emailFormat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (edit_mobile_no.value && !mobileFormat.test(edit_mobile_no.value)) {
                error_edit_mobile_no.innerHTML = "Invalid mobile no.";
                errors += 1;
            }
            if (edit_permanent_pincode.value && !pincodeFormat.test(edit_permanent_pincode.value)) {
                error_edit_permanent_pincode.innerHTML = "Invalid PIN code";
                errors += 1;
            }
            if (
                edit_present_pincode.value &&
                !pincodeFormat.test(edit_present_pincode.value)
            ) {
                error_edit_present_pincode.innerHTML = "Invalid PIN code";
                errors += 1;
            }
            if (edit_email.value && !emailFormat.test(edit_email.value)) {
                error_edit_email.innerHTML = "Invalid email";
                errors += 1;
            }
            // Regex format validations end ------

            if (errors > 0) {
                $("html, body").animate({
                    scrollTop: 0
                }, 0);
                return false;
            }
            application.submit();
        })
    })
</script>
