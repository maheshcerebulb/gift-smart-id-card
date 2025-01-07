@extends('layouts.register')
@section('pageTitle', 'Register')
@section('content')
<div class="main d-flex flex-column flex-row-fluid">
    <!--begin::Subheader-->
   
    <!--end::Subheader-->
    <!--begin::Content-->
    <div class="content flex-column-fluid" id="kt_content">
        <!-- Start:: flash message element -->
        @include('elements.flash-message')
        <!-- End:: flash message element -->
        <div class="card card-custom">
            <div class="card-body p-0">
                <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
                    <!--begin: Wizard Nav-->
                    @include('register.wizard-navigation')
                    <!--end: Wizard Nav-->              
                </div>

                <!--begin: Tab Content -->
                <div class="tab-content mt-5  py-2 px-2 py-lg-2 px-lg-2" id="myTabContent3">
                    <!--begin: Entity Detail Content Tab -->
                    @include('register.content-entity-detail')                    
                    <!--end: Entity Detail Content Tab -->

                    <!--begin: Authorized Person Detail Content Tab -->
                    @include('register.content-entity-authorized-person-detail')                    
                    <!--end: Authorized Person Detail Content Tab -->

                    <!--begin: Entity Verify And Submit Content Tab -->
                    @include('register.content-entity-verify-and-submit-detail')                    
                    <!--end: Entity Verify And Submit Content Tab -->
                </div>
                <!--end: Tab Content -->
            </div>
        </div>
    </div>
</div>
@endsection