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
            {{-- <input type="hidden" name="ddo_id" value="{{ $ddoInfo->ddo_id }}">
            <input type="hidden" name="basic_pay_range_value" value="{{ $empPayBandId }}" />
            <input type="hidden" name="grade_pay" value="{{ $hrms_data['gradePay'] }}" />
            <input type="hidden" name="flat_type_id" value="{{ $flatType->housingFlatType->flat_type_id }}" /> --}}
            {{-- Hidden fields end --}}

            {{-- ------ Personal information ------ --}}
            {{-- @include('applications.includes._personal-info') --}}

            {{-- ------ Address ------ --}}
            {{-- @include('applications.includes._address') --}}


        </form>
    </div>
@endsection
