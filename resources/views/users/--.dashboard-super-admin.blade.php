@extends('layouts.default')
@section('pageTitle', 'Dashboard')
@section('content')
@if(Session::get('User.userGroup') == \App\Models\USer::ROLE_SUPER_ADMIN_ID)
    @include('user.dashboard-super-admin')
@else if (Session::get('User.userGroup') == \App\Models\USer::ROLE_ADMIN_ID)
    @include('user.dashboard-admin')
@else if (Session::get('User.userGroup') == \App\Models\USer::ROLE_COMPANY_ID)
    @include('user.dashboard-company')
@endif
@endsection