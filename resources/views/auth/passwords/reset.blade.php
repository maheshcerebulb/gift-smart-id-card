{{-- @extends('layouts.login')
@section('pageTitle', 'Login')
@section('content')
<div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
    <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('/img/bg-3.jpg') }}');">
        <div class="login-form text-center p-7 position-relative overflow-hidden">
            <!--begin::Login Header-->
            <div class="d-flex flex-center mb-15">
                <a href="#">
                    <img src="{{ asset('/img/national_emblem.png') }}" class="max-h-75px" alt=""/>
                </a>
            </div>
            <!--end::Login Header-->

            <!--begin::Login forgot password form-->
            <div class="">
                <div class="mb-20">
                    <h3>Reset Password</h3>
                </div>
                 <form method="POST" action="{{ route('password.update') }}"
                                            class="form-horizontal form-simple" id="reset_password">
                                            @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group mb-10">
                        <input class="form-control form-control-solid h-auto py-4 px-8" type="text" placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" autocomplete="off" />
                    </div>
                    <div class="form-group mb-10">
                        <input class="form-control form-control-solid h-auto py-4 px-8" type="password" placeholder="{{ __('Password') }}" name="password" value="{{ old('password') }}" autocomplete="off" />
                    </div>
                    <div class="form-group mb-10">
                        <input class="form-control form-control-solid h-auto py-4 px-8" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="off" />
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                        <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-15 py-4 my-3 mx-4">Reset Password</button>
                    </div>
                </form>
            </div>
            <!--end::Login forgot password form-->

        </div>
    </div>
</div>
@stop --}}


@extends('layouts.login')
@section('pageTitle', 'Login')
@section('content')
<div class="main d-flex flex-column flex-row-fluid login_background">
    <!--begin::Subheader-->
    <div class="container-fluid login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden mx-auto">
        <div class="d-flex flex-column-fluid flex-center">
            <div class="row w-100 d-flex justify-content-between m-0">
                @include('auth.login-layout-left-section')
                <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6 col-sm-8 px-2 m-auto ">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b card-stretch login_form_box">
                            <!--begin::Body-->
                            <div class="login-form card-body pt-4 login-signin">
                                <!--begin::Toolbar-->
                                <div class="mt-7 mb-7 text-center p-5 bg-white rounded" style="">
                                    <a href="{{ url('/') }}">
                                        <div class="symbol symbol-xl-100 symbol-lg-100 symbol-md-100 symbol-sm-100 symbol-xs-100">
                                            <img src="{{ asset('img/national_emblem.png')}}" alt="image">
                                        </div>
                                    </a>
                                </div>
                                    <form method="POST" class="form fv-plugins-bootstrap fv-plugins-framework needs-validation"
                                    action="{{ route('password.update') }}" novalidate="" id="reset_password">
                                  
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <!--begin::Form group-->
                                    <div class="form-group fv-plugins-icon-container has-success">
                                        <label class="font-weight-bolder text-dark">Enter email or username</label>
                                        <input class="form-control  h-auto py-4 px-8" type="text" placeholder="{{ __('Email Address') }}" name="email" value="{{ old('email') }}" autocomplete="off" required />
                                       
                                        <div class="fv-plugins-message-container"></div>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter email or username.</div>
                                    </div>
                                    <div class="form-group fv-plugins-icon-container has-success">
                                        <label class="font-weight-bolder text-dark">Password</label>
                                        <input class="form-control  h-auto py-4 px-8" type="password" placeholder="{{ __('Password') }}" name="password" value="{{ old('password') }}" required autocomplete="off" />
                                       
                                        <div class="fv-plugins-message-container"></div>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter password.</div>
                                    </div>
                                    <div class="form-group fv-plugins-icon-container has-success">
                                        <label class="font-weight-bolder text-dark">Confirm Password</label>
                                        <input class="form-control  h-auto py-4 px-8" type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" value="{{ old('password_confirmation') }}" autocomplete="off" required />
                                       
                                        <div class="fv-plugins-message-container"></div>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter confirm password.</div>
                                    </div>
                                    <!--end::Form group-->
                                    <!--begin::Action-->
                                    <div class="pb-lg-0 pb-5">
                      
                                        <button type="submit" id="kt_login_signin_submit" class="btn background-gift btn-block font-weight-bold px-15 py-4 ">Reset Password</button>
                                    </div>
                                    <!--end::Action-->
                                </form>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                </div>
            </div>
        </div>
        @include('auth.footer')
    </div>
</div>
@stop
@section('script')
<script>
    $(document).ready(function(){
        checkValidation();
    });
    function checkValidation() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }
</script>
@endsection