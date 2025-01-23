@extends('layouts.dashboard-master')

@section('title', '401 Not Authorized | ' . config('app.name'))

@section('page-header', '401 Not Authorized')

@section('dashboard-body')
    <div class="row">
        <div>
            <h5>You are not authorized!</h5>
        </div>
    </div>
@endsection
