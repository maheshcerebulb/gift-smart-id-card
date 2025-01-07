@extends('layouts.default')

@section('pageTitle', 'Application - Success')

@section('content')

<div class="main d-flex flex-column flex-row-fluid">

    <!--begin::Subheader-->

    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">

        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        </div>

    </div>

    <!--end::Subheader-->

    <!--begin::Content-->

    <div class="content flex-column-fluid" id="kt_content">

        <div class="card card-custom">

            <div class="card-body p-0">

                <div class="bg-light-success text-success">

                    <div class="rounded border p-10">

                        <div class="d-flex flex-wrap align-items-center">

                            <div class="w-350px h-350px d-flex flex-column flex-center me-5 mb-5 fw-semibold">

                                <img src="{{ asset('/img/form-report.jpg') }}" class="max-h-250px" />

                            </div>

                            <div class="d-flex flex-column flex-center me-5 mb-5 fw-semibold">

                                <p class="font-size-h2">Your Application no: {{ $entity_application_details->application_number}} has been successfully submitted</p>

                                <a href="{{ url('entity/recentApplications') }}" class="btn btn-warning btn-shadow font-weight-bold mr-2">Go To Applications List</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

