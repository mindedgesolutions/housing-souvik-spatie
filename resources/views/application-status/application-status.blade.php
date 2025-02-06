@extends('layouts.dashboard-master')

@section('title', 'Check Application Status | ' . config('app.name'))

@section('page-header', 'Check Application Status')

@section('dashboard-body')
    <div class="row">
        <div class="col-md-4">
            <div class="form-floating">
                <div class="form-item form-type-textfield form-item-application-no">
                    <label for="edit-application-no">Enter Application No. <span class="form-required"
                            title="This field is required.">*</span></label>
                    <input placeholder="Enter application no." class="form-control form-control-sm form-text required"
                        type="text" id="edit-application-no" name="application_no" value="" size="60"
                        maxlength="128">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input class="text-centre btn bg-primary btn-sm px-5 mt-4 rounded-pill text-white fw-bolder form-submit"
                    type="submit" id="edit-search" name="op" value="Search">
            </div>
        </div>
    </div>
@endsection
