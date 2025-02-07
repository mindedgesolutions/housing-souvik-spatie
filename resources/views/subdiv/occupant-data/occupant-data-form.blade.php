@extends('layouts.dashboard-master')

@section('page-header', 'Occupant Data Entry')

@section('title', 'Occupant Data Entry | ' . config('app.name'))

@section('dashboard-body')
    <div class="row">
        <div class="col-md-6">
            <div class="form-floating">
                <div class="form-item form-type-select form-item-rhe-name">
                    <label for="edit-rhe-name">Name of the RHE <span class="form-required"
                            title="This field is required.">*</span></label>
                    <select class="form-select form-select required ajax-processed" id="edit-rhe-name" name="rhe_name">
                        <option value="" selected="selected">- Select -</option>
                        @foreach ($housingEstates as $housingEstate)
                            <option value="{{ $housingEstate->estate_id }}">
                                {{ $housingEstate->estate_address ?? $housingEstate->estate_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="flat_type_replace">
            <div class="form-floating">
                <div class="form-item form-type-select form-item-flat-type">
                    <label for="edit-flat-type">Flat Type <span class="form-required"
                            title="This field is required.">*</span></label>
                    <select class="form-select form-select required ajax-processed" id="edit-flat-type" name="flat_type">
                        <option value="" selected="selected">- Select -</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="block_name_replace">
            <div class="form-floating">
                <div class="form-item form-type-select form-item-block-name">
                    <label for="edit-block-name">Name of the Block <span class="form-required"
                            title="This field is required.">*</span></label>
                    <select class="form-select form-select required ajax-processed" id="edit-block-name" name="block_name">
                        <option value="" selected="selected">- Select -</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6" id="flat_no_replace">
            <div class="form-floating">
                <div class="form-item form-type-select form-item-flat-no">
                    <label for="edit-flat-no">Flat No. <span class="form-required"
                            title="This field is required.">*</span></label>
                    <select class="form-select form-select required ajax-processed" id="edit-flat-no" name="flat_no">
                        <option value="" selected="selected">- Select -</option>
                        <option value="3487">A/1</option>
                        <option value="3488">A/2</option>
                        <option value="3489">A/3</option>
                        <option value="3490">A/4</option>
                        <option value="3491">A/5</option>
                        <option value="3492">A/6</option>
                        <option value="3493">A/7</option>
                        <option value="3494">A/8</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="submit_button_replace"><input
                class="btn bg-primary btn-sm px-5 rounded-pill text-white fw-bolder form-submit" type="submit"
                id="edit-submit-button" name="op" value="Insert Occupant Details"></div><input type="hidden"
            name="form_build_id" value="form-J7dv8kowOObDdv5uB8PMGMZUZOfXMs81ehM4ZSKmIr4">
        <input type="hidden" name="form_token" value="etI98gEKYXOT8s4CHBHeK3QV7rr9652vkTejE3o2aII">
        <input type="hidden" name="form_id" value="rhewise_flatlist_form">
    </div>
@endsection

<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script>
    $(document).ready(function() {
        // ----------------- Flat Type -----------------
        $('#edit-rhe-name').on('change', function() {
            $('#loader').show();

            var estate_id = $(this).val();
            $('edit-flat-type').html('');

            if (estate_id) {
                $.ajax({
                    url: "{{ route('occupant-data.occupant.flat.type') }}?estate_id=" +
                        estate_id,
                    method: 'get',
                    success: function(res) {
                        $('#loader').hide();

                        $('#edit-flat-type').html(
                            '<option value="">- Select -</option>');
                        $.each(res.flatTypes, function(key, value) {
                            $('#edit-flat-type').append('<option value="' + value
                                .flat_type_id + '")>' + value.flat_type.trim() +
                                '</option>');
                        });

                    }
                });
            }
        });

        // ----------------- Block Name -----------------

        $('#edit-flat-type').on('change', function() {
            $('#loader').show();

            var flat_type_id = $(this).val();
            var estate_id = $('#edit-rhe-name').val();

            $('edit-block-name').html('');

            if (flat_type_id) {
                $.ajax({
                    url: "{{ route('occupant-data.occupant.block') }}?estate_id=" +
                        estate_id + "&flat_type_id=" +
                        flat_type_id,
                    method: 'get',
                    success: function(res) {
                        $('#loader').hide();

                        $('#edit-block-name').html(
                            '<option value="">- Select -</option>');
                        $.each(res.blocks, function(key, value) {
                            $('#edit-block-name').append('<option value="' + value
                                .block_id + '")>' + value.block_name.trim() +
                                '</option>');
                        });
                    }
                });
            }
        });

        // ----------------- Flat No -----------------
        $('#edit-block-name').on('change', function() {
            alert('Block Name');
        })
    })
</script>
