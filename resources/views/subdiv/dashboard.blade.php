@extends('layouts.dashboard-master')

@section('page-header', strtoupper($user->name) . "'s Dashboard (Sub-Division)")

@section('title', strtoupper($user->name) . "'s Dashboard (Sub-Division) | " . config('app.name'))

@section('dashboard-body')

@endsection
