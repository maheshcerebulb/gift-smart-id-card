@extends('layouts.special-id-card')

@section('pageTitle', 'Create New Application')

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

                    <h2 class="text-dark font-weight-bold my-1 mr-5">Create New Application</h2>

                    <!--end::Page Title-->

                </div>

                <!--end::Page Heading-->

            </div>

            <!--end::Info-->

            <!--begin::Toolbar-->

            <div class="d-flex align-items-center">

                <a href="{{ route('welcome') }}" class="btn btn-light font-weight-boldest text-uppercase">

                    <i class="flaticon2-left-arrow-1"></i>Back To Dashboard

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

                    <div class="card-body p-0">

                        <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">

                            <!--begin: Wizard Nav-->

                            @include('specialentity.wizard-navigation')

                            <!--end: Wizard Nav-->              

                        </div>



                        <!--begin: Tab Content -->

                        <div class="tab-content mt-5  py-2 px-2 py-lg-2 px-lg-2" id="myTabContent3">

                            <!--begin: Entity New Application Detail Content Tab -->

                            @include('specialentity.content-entity-application-detail')                    

                            <!--end: Entity New Application Detail Content Tab -->



                            <!--begin: Entity New Application Verify And Submit Content Tab -->

                            @include('specialentity.content-entity-application-verify-and-submit-detail')  

                            <!--end: Entity New Application Detail Content Tab -->

                        </div>

                        

                        <!--end: Tab Content -->

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection




