@extends('layouts.default')

@section('pageTitle', 'Recent Application List')

@section('content')

<div class="main d-flex flex-column flex-row-fluid">

    <!--begin::Subheader-->

    <!-- Start:: flash message element -->

    @include('elements.flash-message')

    <!-- End:: flash message element -->

    <div class="row">

        <div class="col-lg-12">

            <div class="card card-custom gutter-b">

                <div class="card-header align-items-center border-bottom-light d-flex justify-content-between py-5">

                    <h3 class="card-title mb-0">

                        <span class="card-label font-weight-bolder text-dark">Application Details</span>

                    </h3>

                    <div class="card-toolbar">

                        <a href="{{ route('welcome') }}" class="btn btn-light font-weight-boldest text-uppercase">

                            <i class="flaticon2-left-arrow-1"></i>Back To Dashboard

                        </a>

                    </div>

                </div>

                <div class="card-body row p-0">

                    <div class="col-md-5 card-border-right text-dark px-20 py-10">

                        <div>

                            <p class="font-weight-bolder font-size-h5 text-dark text-hover-primary mb-5">Details are as follows</p>

                            <!-- <h5 class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Details are as follow</h5> -->

                        </div>

                        <div class="font-size-sm line-height-xs mb-5 id-card-text-uppercase">

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Application No.</label>

                                <p class="ml-2 w-50">1023658595855669</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Name</label>

                                <p class="ml-2 w-50">Hitesh Patel</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Designation</label>

                                <p class="ml-2 w-50">Director</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Entity Name</label>

                                <p class="ml-2 w-50">Cerebulb India Pvt Ltd.</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Entity Type</label>

                                <p class="ml-2 w-50">Unit</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Entity Email</label>

                                <p class="ml-2 w-50">hr@cerebul.com</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Contact No.</label>

                                <p class="ml-2 w-50">+91-123 456 789</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Auth Person Name</label>

                                <p class="ml-2 w-50">Anushree Gupta</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Auth Person Contact No.</label>

                                <p class="ml-2 w-50">+91-123 456 789</p>

                            </div>

                        </div>

                        <div>

                            <a href="#" class="btn btn-lg btn-common font-weight-bolder h5 py-4 font-size-sm" data-toggle="modal" data-target="#staticBackdrop">Proceed to Print</a>

                            <button type="" class="btn btn-light btn-lg">

                                <span class="mr-5">View Applications</span>

                                <i class="ki ki-long-arrow-next icon-sm"></i>

                            </button>



                        </div>

                    </div>

                    <div class="col-md-7 px-20 py-10">

                        <div class="text-center">

                            <p class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary mb-5">ID Card Preview</p>

                            <!-- <h5 class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Details are as follow</h5> -->

                        </div>

                    </div>

                </div>

                <div class="card-footer p-0">

                    <div class="alert alert-custom m-0 bg-light-green" role="alert">

                            <div class="symbol symbol-50 symbol-light mr-5">

                                <span class="symbol-label symbol-label-green">

                                    <!-- <img src="assets/media/svg/misc/006-plurk.svg" class="h-50 align-self-center" alt=""> -->

                                    <i class="ki ki-bold-check-1"></i>

                                </span>

                            </div>

                        <div class="font-weight-bolder font-size-h5 alert-text">Card has been successfully sent for printing.

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title fonr-weight-bolder" id="exampleModalLabel">Approve ID-Card</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

                <div class="modal-body text-dark">

                    <div class="d-flex">

                        <div class="profile-image d-flex justify-content-between shadow-inset mr-10  mb-5 symbol symbol-50 symbol-lg-90">

                            <img src="{{asset('img/user-avatar.png')}}" class="card-img-top" alt="Christopher Avatar">

                        </div>

                        <div class="font-size-sm py-3">

                            <p class="font-weight-bolder text-dark mb-0">{{$entityApplicationData->type}} Identity Card</p>

                            <div class="d-flex mb-5">

                                <label class="label-input-seperator mb-0">Sr. No.</label>

                                <p class="mb-0">00021469</p>

                            </div>

                            <a href="#" class="text-underline">View Aadhar Card</a>

                        </div>

                    </div>

                    <div class="line-height-sm">

                        <p class="font-weight-bolder font-size-h5 text-dark text-hover-primary mb-4">Hitesh Patel</p>

                    </div>

                    <div class="font-size-sm line-height-xs">

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Application No.</label>

                            <p class="ml-2 w-50">1023658595855669</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Name</label>

                            <p class="ml-2 w-50">Hitesh Patel</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Designation</label>

                            <p class="ml-2 w-50">Director</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Entity Name</label>

                            <p class="ml-2 w-50">Cerebulb India Pvt Ltd.</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Entity Type</label>

                            <p class="ml-2 w-50">Unit</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Entity Email</label>

                            <p class="ml-2 w-50">hr@cerebul.com</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Contact No.</label>

                            <p class="ml-2 w-50">+91-123 456 789</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Auth Person Name</label>

                            <p class="ml-2 w-50">Anushree Gupta</p>

                        </div>

                        <div class="d-flex">

                            <label class="label-input-seperator font-weight-bolder w-50">Auth Person Contact No.</label>

                            <p class="ml-2 w-50">+91-123 456 789</p>

                        </div>

                    </div>



                </div>

                <div class="modal-footer border-0">

                    <a href="#" class="btn btn-xl btn-bg-white h5 font-weight-bolder px-10" data-toggle="modal" data-target="#staticBackdrop1">Reject</a>

                    <button type="button" class="btn btn-lg btn-common font-weight-bolder h5 px-10">Approve</button>



                </div>

        </div>

    </div>

</div>

<div class="modal fade" id="staticBackdrop1" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title fonr-weight-bolder" id="exampleModalLabel">Reason to reject</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            {!! Form::model('', ['route' => 'users.update-entity-profile', 'method' => 'POST', 'class' => 'form', 'id' => 'update_entity_profile_form']) !!}

                {!! Form::hidden('id', null, ['id' => 'hidden_user_id']) !!}

            <div class="modal-body">

                <div class="form-group row">

                    <div class="col-lg-9 col-md-9 col-sm-12">

                        <div class="input-group" data-z-index="6">

                            {!! Form::textarea('authorized_person_first_name', null, ['class' => 'form-control form-control-solid required', 'placeholder' => 'Enter reason to reject ID Card application', 'maxlength' => '255']) !!}

                        </div>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-lg btn-common font-weight-bolder h5 px-10">Reject</button>



            </div>

            {!! Form::close() !!}



        </div>

    </div>

</div>

@endsection

