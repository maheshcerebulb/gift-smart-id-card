{{-- @extends('layouts.login')
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
                <form method="POST" class="form-horizontal form-simple"
                                            action="{{ route('login') }}" id="login">
                                            @csrf
                    <div class="form-group mb-5">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email" name="login" autocomplete="off" />
                    </div>
                    <div class="form-group mb-5">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Password" name="password" />
                    </div>

                    <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-15 py-4 my-3 mx-4">Sign In</button>
                </form>
                <div class="form-group d-flex flex-wrap justify-content-end align-items-center">
                    <a href="{{ route('password.request') }}" id="" class="text-muted text-hover-primary">Forgot Password ?</a>
                </div>
                <div class="text-muted font-weight-bold">Don't have an account? <a href="{{ route('users.register') }}">Register Here</a></div>
            </div>
            <!--end::Login Sign in form-->


        </div>
    </div>
</div>
@stop


 --}}

 @extends('layouts.login')
 @section('pageTitle', 'Login')
 @section('content')
 <div class="main d-flex flex-column flex-row-fluid login_background">
     <!--begin::Subheader-->
     <div class="container login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden mx-auto">
         <div class="d-flex flex-column-fluid flex-center">
             <div class="row d-flex justify-content-between m-0">
                 <div class="d-lg-flex col-xl-7 col-lg-7 col-md-12 col-sm-12 py-0 d-md-none d-sm-none d-xs-none">
                     <div class="w-100 align-self-center">
                         <div class="w-100 mb-10">
                             <span class="login_welcome">Welcome to<br/></span>
                             <span class="login_welcome_extended">GIFT City ID-Card Management System</span>
                         </div>
                         <div class="login_gift_site">www.giftgujarat.in</div>
                     </div>
                 </div>
                 <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12 px-2 m-auto ">
                         <!--begin::Card-->
                         <div class="card card-custom gutter-b card-stretch login_form_box">
                             <!--begin::Body-->
                             <div class="login-form card-body pt-4 login-signin">
                                 <!--begin::Toolbar-->
                                 <div class="mt-7 mb-7 text-center p-10 bg-white rounded" style="">
                                     <div class="symbol symbol-lg-100">
                                         <img src="{{ asset('img/logo.png')}}" alt="image">
                                     </div>
                                     
                                 </div>
 
                                 
                                     <form method="POST" class="form fv-plugins-bootstrap fv-plugins-framework"
                                     action="{{ route('login') }}" id="login">
                                     @csrf
                                     <!--begin::Form group-->
                                     <div class="form-group fv-plugins-icon-container has-success">
                                         <label class="font-weight-bolder text-dark">Enter email or username</label>
                                         <input class="form-control form-control-solid h-auto py-3 px-3 rounded-lg is-valid" type="text" name="login" autocomplete="off" placeholder="Email">
                                         <div class="fv-plugins-message-container"></div>
                                     </div>
                                     <!--end::Form group-->
                                     <!--begin::Form group-->
                                     <div class="form-group fv-plugins-icon-container has-success">
                                         <label class="font-weight-bolder text-dark">Enter password</label>
                                         <input class="form-control form-control-solid h-auto py-3 px-3 rounded-lg is-valid" type="password" name="password" autocomplete="off" placeholder="password">
                                         <div class="fv-plugins-message-container"></div>
                                     </div>
                                     
                                     <!--end::Form group-->
                                     <!--begin::Action-->
                                     <div class="pb-lg-0 pb-5">
                       
                                         <button id="kt_login_signin_submit" class="btn background-gift btn-block font-weight-bold px-15 py-4 ">Sign In</button>
                                     </div>
 
                                     <div class="form-group text-right flex-wrap justify-content-between align-items-center mt-3">
                                         <a href="{{ route('password.request') }}" class="text-dark text-hover-primary">Forgot Password ?</a>
                                     </div>
                                     
                                     <!--end::Action-->
                                 </form>
                                 <div class="form-group align-items-center mt-2">
                                     <div class="my-3 mr-2 text-center">
                                         <span class="text-muted mr-2">Don't have an account?</span>
                                         <a href="{{ route('users.register') }}" id="kt_login_signup" class="font-weight-bold">Request to Register</a>
                                     </div>
                                 </div>
                             </div>
                             <!--end::Body-->
                         </div>
                         <!--end::Card-->
                 </div>
             </div>
         </div>
         <div class="border-top py-lg-0">
             <div class="w-100 py-lg-0">
                 <div class="row justify-content-between m-5">
                     <div class="d-flex text-dark-50 font-weight-bold order-1 order-sm-1 my-2">
                         <div>
                             <a href="#" class="text-white text-hover-primary">Designed &amp; Developed by :</a>
                         </div>
                         <div class="ml-2 align-self-center">
                            <a href="http://www.cerebulb.com"><img width="70" src="{{ asset('img/cerebulb_logo.png') }}"></a>
                             
                         </div>
                     </div>
                     <div class="d-flex order-2 order-sm-2 my-2">
                         <a href="http://www.cerebulb.com" class="text-white text-hover-primary">Visit:</a>
                         <a href="http://www.cerebulb.com" _taget="blank" class="text-white text-hover-primary ml-1">www.cerebulb.com</a><span class="ml-1 text-white">|</span>
                         <p class="text-white text-hover-primary ml-1 mb-0">Follow Us on: </p>
                         <a href="https://www.instagram.com/cerebulb_?igsh=NjM0NnVtbXIxenYx" class="text-white text-hover-primary ml-1"><i class="fab fa-instagram text-white ml-1"></i></a>
                         <a href="https://www.linkedin.com/company/cerebulb/" class="text-white text-hover-primary ml-1"><i class="fab fa-linkedin text-white ml-2"></i></a>
                         <a href="https://www.facebook.com/Cerebulb-104042420989846/" class="text-white text-hover-primary ml-1"><i class="fab fa-facebook text-white ml-2"></i></a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 @stop