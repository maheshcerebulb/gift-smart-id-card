@extends('layouts.default')
@section('pageTitle', 'Add User')
@section('content')
<div class="main d-flex flex-column flex-row-fluid">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 class="text-dark font-weight-bold my-1 mr-5">Add User</h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <a href="{{route('users.index')}}" class="btn btn-light font-weight-boldest text-uppercase">
                    <i class="flaticon2-left-arrow-1"></i>Back
                </a>
            </div>
            <!--end::Toolbar-->
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
                <div class="card card-custom card-border gutter-b">                    
                    <!--begin::Form-->
                    {!! Form::open(['route' => 'users.store', 'class' => 'form']) !!}

                    @include('users.fields')                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    {!! Form::close() !!}
                    <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection