@extends('layouts.login')
@section('pageTitle', 'Login')
@section('content')
<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
    <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('/img/bg-3.jpg') }}');">
        <div class="login-form text-center p-7 position-relative overflow-hidden">
            <!--begin::Login Header-->
            <div class="d-flex flex-center mb-15">
                <a href="#">
                    <img src="{{ asset('/img/logo.png') }}" class="max-h-75px" alt=""/>
                </a>
            </div>
            <!--end::Login Header-->
            <!--begin::Login Sign in form-->
            <div class="login-signin">							
                {!! Form::open(['method' => 'POST', 'id' => 'kt_login_signin_form']) !!}
                    <div class="form-group mb-5">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                    </div>
                    <div class="form-group mb-5">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                    </div>
                    
                    <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-15 py-4 my-3 mx-4">Sign In</button>
                {!! Form::close() !!}
                <div class="form-group d-flex flex-wrap justify-content-end align-items-center">
                    <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forgot Password ?</a>
                </div>
                <div class="text-muted font-weight-bold">Don't have an account? <a href="{{ route('users.register') }}">Request to Register</a></div>
            </div>
            <!--end::Login Sign in form-->

            <!--begin::Login forgot password form-->
            <div class="login-forgot">
                <div class="mb-20">
                    <h3>Forgotten Password ?</h3>
                    <div class="text-muted font-weight-bold">Enter your email to reset your password</div>
                </div>
                {!! Form::open(['method' => 'POST', 'id' => 'kt_login_forgot_form']) !!}
                    <div class="form-group mb-10">
                        <input class="form-control form-control-solid h-auto py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                        <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Request</button>
                        <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <!--end::Login forgot password form-->
        </div>
    </div>
</div>    
@stop