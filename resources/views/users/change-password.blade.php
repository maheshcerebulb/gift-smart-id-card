@extends('layouts.default')
@section('pageTitle', 'Change Password')
@section('content')
<div class="main d-flex flex-column flex-row-fluid">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 class="text-dark font-weight-bold my-1 mr-5">Change Password</h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('welcome') }}" class="btn btn-light font-weight-boldest text-uppercase">
                    <i class="flaticon2-left-arrow-1"></i>Back To Dashboard
                </a>
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Content-->
    <div class="content flex-column-fluid pt-5" id="kt_content">
        <!-- Start:: flash message element -->
        @include('elements.flash-message')
        <!-- End:: flash message element -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom gutter-b">
                    <!--begin::Form-->

                    <form action="{{ route('users.change-password', $userDetails['id']) }}" method="POST"
                                id="change_password_form">
                                @csrf
                        <input type="hidden" name="redirect_on" value="{{ $redirect_on }}" />
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Old Password:</label>
                                <div class="col-lg-6">
                                    <input type="password" name="old_password" class="form-control form-control-solid required" id="old_password" placeholder="Enter Password">
                                    {{-- {!! Form::input('password', 'password',  null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter Password']) !!} --}}
                                    @error('old_password')
                                        <span class="text-danger" for="password">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Password:</label>
                                <div class="col-lg-6">
                                    <input type="password" name="password" class="form-control form-control-solid required" id="password" placeholder="Enter Password">
                                    @error('password')
                                        <span class="text-danger" for="password">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Confirm Password:</label>
                                <div class="col-lg-6">
                                    <input type="password" name="password_confirmation" class="form-control form-control-solid required" id="password_confirmation" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <span class="text-danger" for="password">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2" id="change_password_submit_button">Change Password</button>
                        </div>
                    {!! Form::close() !!}
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
