@extends('layouts.dashboard-master')

@section('page-header', strtoupper($user->userDetail->full_name ?? $user->name) . "'s Dashboard (Sub-Division)")

@section('title', strtoupper($user->userDetail->full_name ?? $user->name) . "'s Dashboard (Sub-Division) | " .
    config('app.name'))

@section('dashboard-body')

@endsection
