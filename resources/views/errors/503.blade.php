@extends('layouts.dashboard-master')

@section('title', '503 Service Unavailable | ' . config('app.name'))

@section('page-header', '503 Service Unavailable')

@section('dashboard-body')
    <div class="row">
        <div>
            <h5>Service Unavailable</h5>
        </div>
    </div>
@endsection
