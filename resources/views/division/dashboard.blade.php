@extends('layouts.dashboard-master')

@section('page-header', $user->name . "' Dashboard")

@section('title', 'Division Dashboard | ' . config('app.name'))

@section('dashboard-body')

@endsection
