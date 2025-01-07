@extends('layouts.default')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="main d-flex flex-column flex-row-fluid">

    <!--begin::Subheader-->

    {{-- <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">

        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

            <!--begin::Info-->

            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->

                <div class="d-flex align-items-baseline flex-wrap justify-content-between mr-5">

                    <!--begin::Page Title-->

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h2>



                    <!--end::Page Title-->

                </div>

                <!--end::Page Heading-->

            </div>

            <div class="d-flex align-items-center">

                <!--begin::Actions-->

                <!-- <a href="{{url('/viewPendingRequestList') }}" class="btn btn-light font-weight-bold btn-lg color-button-navy">View Entity List</a> -->

                <!--end::Actions-->

            </div>

            <!--end::Info-->

        </div>

    </div> --}}

    <!--end::Subheader-->

    <!--begin::Content-->

    <div class="content flex-column-fluid" id="kt_content">

        @include('elements.flash-message')



        @include('users.show-counts')

        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 mb-4 mb-md-5">

                <div class="profile-card mb-5 mt-3">

                    <div class="card shadow-soft border-light">

                        <div class="profile-image d-flex justify-content-between shadow-inset ml-10 mr-10 mt-n5 mb-5 symbol symbol-50 symbol-lg-90" >

                            <img src="{{!empty(Auth::user()->image) ? asset('upload/entity-data/entity-profile/'.Auth::user()->image) : asset('img/user-avatar.png') }}" class="card-img-top" id="entity-profile-image" alt="Christopher Avatar" >

                            <a href="" class="text-decoration-underline mt-12" data-toggle="modal" data-target="#staticBackdrop">Update</a>

                        </div>

                        <div class="card-body">

                            {{-- <div class="d-flex mb-4">

                                <span class="text-muted font-weight-bold mr-2 w-50">Entity Name</span>

                                <a href="#" class="text-black text-hover-primary profile-span-value w-50">{{Auth::user()->full_name}}</a>

                            </div> --}}



                            {{-- <div class="d-flex align-items-center justify-content-between mb-4">

                                <span class="text-muted font-weight-bold mr-2 w-50 ">Address</span>

                                <a href="#" class="text-black text-hover-primary w-50" >{{Auth::user()->company_address}}</a>

                            </div> --}}

                            <div class="d-flex align-items-center justify-content-between mb-4">

                                <span class="text-muted font-weight-bold mr-2 w-50">Authorized Person Name</span>

                                <a href="#" class="text-black text-hover-primary w-50">{{Auth::user()->full_name}}</a>

                            </div>



                            <div class="d-flex align-items-center justify-content-between mb-4">

                                <span class="text-muted font-weight-bold mr-2 w-50">Email Id</span>

                                <a href="#" class="text-black text-hover-primary w-50">{{Auth::user()->email}}</a>

                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">

                                <span class="text-muted font-weight-bold mr-2 w-50">Contact Details</span>

                                <a href="#" class="text-black text-hover-primary text-decoration-underline w-50">{{Auth::user()->authorized_person_mobile_number}}</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-12 col-md-6 col-lg-8 mb-4 mb-md-5 mt-3">

                <div class="card border shadow-soft border-light">

                    <!--begin::Header-->

                    <div class="card-header align-items-center d-flex justify-content-between border-0 py-5">

                        <h3 class="card-title mb-0">

                            <span class="card-label font-weight-bolder text-dark">Recent Applicant Status</span>

                        </h3>

                        <div class="card-toolbar">

                            <a href="{{ url('admin/applications')}}" class="btn btn-info font-weight-bolder font-size-sm">View All</a>

                        </div>

                    </div>

                    <!--end::Header-->

                    <!--begin::Body-->

                    

                    <div class="card-body py-0">

                        <!--begin::Table-->

                        <div class="table-responsive">

                            <table class="table table-head-custom table-vertical-center width-max-content" id="kt_advance_table_widget_2">

                                <thead>

                                    <tr class="text-uppercase">

                                        <!-- <th class="pl-0" >

                                            <label class="checkbox checkbox-lg checkbox-inline mr-2">

                                                <input type="checkbox" value="1">

                                                <span></span>

                                            </label>

                                        </th> -->

                                        <th>Application Type</th>

                                        <th>Entity Name</th>

                                        <th>

                                            <span>Date</span>

                                        </th>

                                        <th><span>Expiry Date</span></th>

                                        <th>Application Number</th>

                                        <th>Employee Name</th>

                                        <th class="pr-0 text-right">Status</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @if(count($recentEntityApplicationData) > 0)

                                        @foreach ($recentEntityApplicationData as $row)

                                        <?php

                                                $row->application_type = Helper::getEntityApplicationType($row->application_type);

                                        ?>

                                           

                                            <tr>

                                                <!-- <td class="pl-0 py-6">

                                                    <label class="checkbox checkbox-lg checkbox-inline">

                                                        <input type="checkbox" value="1">

                                                        <span></span>

                                                    </label>

                                                </td> -->

                                                <td>

                                                    <a href="#" class="text-dark-75 font-weight-bolder">{{ $row->application_type}}</a>

                                                </td>

                                                <td>

                                                    <!-- <span class="text-dark-75 font-weight-bolder ">05/28/2020</span> -->

                                                    <span class="text-muted font-weight-bold">{{ $row->entity_name }}</span>

                                                </td>

                                                <td>

                                                    <!-- <span class="text-dark-75 ">Brasil</span> -->

                                                    <span class="text-muted font-weight-bold">{{ date('d-m-Y',strtotime($row->created_at))}}</span>

                                                </td>

                                                <td>

                                                    <!-- <span class="text-dark-75 ">Brasil</span> -->

													@if ($row->type != 'Other')
                                                        <span class="text-muted font-weight-bold">{{ date('d-m-Y',strtotime($row->expire_date))}}</span>
                                                    @endif
                                                </td>

                                                <td>

                                                    <!-- <span class="text-dark-75 font-weight-bolder ">05/28/2020</span> -->

                                                    <span class="text-muted font-weight-bold">{{ $row->application_number }}</span>

                                                </td>

                                                <td>

                                                    <!-- <span class="text-dark-75 font-weight-bolder ">Intertico</span> -->

                                                    <span class="text-muted font-weight-bold">{{ $row->getFullNameAttribute()}}</span>

                                                </td>

                                                <td class="text-right pr-0">

                                                    <span class="label label-sm width-max-content {{ Helper::getApplicationStatusBackgroundColor($row->status)}} label-inline">{{ Helper::getApplicationType($row->status)}}</span>

                                                </td>

                                            </tr>

                                    @endforeach

                                    @else

                                    <tr>

                                        <td colspan="10">No record found</td>

                                    </tr>

                                    @endif

                                </tbody>

                            </table>

                        </div>

                        <!--end::Table-->

                    </div>

                    

                    <!--end::Body-->

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Update Entity Details</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <i aria-hidden="true" class="ki ki-close"></i>

                </button>

            </div>

            {!! Form::model($userDetails, ['route' => 'users.update-entity-profile', 'method' => 'POST', 'class' => 'form', 'id' => 'update_entity_profile_form']) !!}

                {!! Form::hidden('id', null, ['id' => 'hidden_user_id']) !!}

                <div class="modal-body">

                    <div class="form-group row">

                        <label class="col-form-label text-right col-lg-3 col-sm-12">First & middle name</label>

                        <div class="col-lg-9 col-md-9 col-sm-12">

                            <div class="input-group" data-z-index="6">

                                {!! Form::text('authorized_person_first_name', null, ['class' => 'form-control required', 'placeholder' => 'First & Middle Name', 'maxlength' => '255']) !!}



                            </div>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-form-label text-right col-lg-3 col-sm-12">Last Name</label>

                        <div class="col-lg-9 col-md-9 col-sm-12">

                            <div class="input-group" data-z-index="6">

                            {!! Form::text('authorized_person_last_name', null, ['class' => 'form-control required', 'placeholder' => 'Last Name', 'maxlength' => '255']) !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-form-label text-right col-lg-3 col-sm-12">Gender</label>

                        <div class="col-lg-9 col-md-9 col-sm-12">

                            <div class="input-group" data-z-index="6">

                                <div class="radio-inline">

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('authorized_person_gender', 'Male') }}

                                        <span></span>Male

                                    </label>

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('authorized_person_gender', 'Female') }}

                                        <span></span>Female

                                    </label>

                                    <label class="radio radio-outline radio-primary">

                                        {{ Form::radio('authorized_person_gender', 'Other') }}

                                        <span></span>Other

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-form-label text-right col-lg-3 col-sm-12">Mobile Number</label>

                        <div class="col-lg-9 col-md-9 col-sm-12">

                            <div class="input-group" data-z-index="6">

                                {!! Form::text('authorized_person_mobile_number', null, ['class' => 'form-control required', 'placeholder' => 'Mobile Number', 'maxlength' => '100']) !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-form-label text-right col-lg-3 col-sm-12">Designation</label>

                        <div class="col-lg-9 col-md-9 col-sm-12">

                            <div class="input-group" data-z-index="6">

                                {!! Form::text('authorized_person_designation', null, ['class' => 'form-control required', 'placeholder' => 'Designation', 'maxlength' => '100']) !!}

                            </div>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label class="col-form-label text-right col-lg-3 col-sm-12">Email</label>

                        <div class="col-lg-9 col-md-9 col-sm-12">

                            <div class="input-group" data-z-index="5">

                            {!! Form::text('email', null, ['class' => 'form-control required email', 'placeholder' => 'Email Address', 'maxlength' => '100']) !!}

                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary font-weight-bold" id="update_entity_profile_submit_button">Save changes</button>

                </div>

                {!! Form::close() !!}

        </div>

    </div>

</div>

@endsection

