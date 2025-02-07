@extends('layouts.dashboard-master')

@section('page-header', strtoupper($user->userDetail->full_name ?? $user->name) . "'s Dashboard")

@section('title', strtoupper($user->userDetail->full_name ?? $user->name) . "'s Dashboard | " . config('app.name'))

@section('dashboard-body')

@endsection
