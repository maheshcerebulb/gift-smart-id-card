@extends('layouts.default')
@section('pageTitle', 'Profile')
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
                    <h2 class="text-dark font-weight-bold my-1 mr-5">Profile</h2>
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

                    {!! Form::model($userDetails, ['route' => 'users.update-entity-profile', 'method' => 'POST', 'class' => 'form', 'id' => 'update_entity_profile_form']) !!}
                    {!! Form::hidden('id', null, ['id' => 'hidden_user_id']) !!}
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">First & middle name:</label>
                                <div class="col-lg-6">
                                    {!! Form::text('authorized_person_first_name', null, ['class' => 'form-control required', 'placeholder' => 'First & Middle Name', 'maxlength' => '255']) !!}
                                    @error('authorized_person_first_name')
                                        <span class="text-danger" for="authorized_person_first_name">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Last Name:</label>
                                <div class="col-lg-6">
                                    {!! Form::text('authorized_person_last_name', null, ['class' => 'form-control required', 'placeholder' => 'Last Name', 'maxlength' => '255']) !!}
                                    @error('authorized_person_last_name')
                                        <span class="text-danger" for="authorized_person_last_name">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Gender</label>
                                <div class="col-lg-6">
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
                                <label class="col-lg-3 col-form-label">Mobile Number:</label>
                                <div class="col-lg-6">
                                    {!! Form::text('authorized_person_mobile_number', null, ['class' => 'form-control required', 'placeholder' => 'Mobile Number', 'maxlength' => '255']) !!}
                                    @error('authorized_person_mobile_number')
                                        <span class="text-danger" for="authorized_person_mobile_number">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Designation:</label>
                                <div class="col-lg-6">
                                    {!! Form::text('authorized_person_designation', null, ['class' => 'form-control required', 'placeholder' => 'Designation', 'maxlength' => '255']) !!}
                                    @error('authorized_person_designation')
                                        <span class="text-danger" for="authorized_person_designation">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Email:</label>
                                <div class="col-lg-6">
                                    {!! Form::text('email', null, ['class' => 'form-control required email', 'placeholder' => 'Email', 'maxlength' => '255']) !!}
                                    @error('authorized_person_designation')
                                        <span class="text-danger" for="authorized_person_designation">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            {{-- <button type="button" class="btn btn-light-primary font-weight-bold">Cancel</button> --}}
                            <button type="submit" class="btn btn-primary mr-2" id="update_entity_profile_submit_button">Save Changes</button>
                        </div>
                    {!! Form::close() !!}
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
