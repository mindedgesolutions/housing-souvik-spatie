@extends('layouts.dashboard-master')

@section('title', '403 Forbidden | ' . config('app.name'))

@section('page-header', '403 Forbidden')

@section('dashboard-body')
    <div class="row">
        <div>
            <h5>You do not have permission to access this page!</h5>
        </div>
    </div>
@endsection
