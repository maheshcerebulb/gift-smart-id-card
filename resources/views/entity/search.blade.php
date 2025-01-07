@extends('layouts.default')
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
                    <h2 class="text-dark font-weight-bold my-1 mr-5">Search Application</h2>
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
                <div class="card card-custom card-border border-0 gutter-b">    
                    <div class="card-body p-0">                
                        {!! Form::open(['route' => 'search.entity-application-search', 'class' => 'form', 'id' => 'entity_application_search_form', 'action-for' => 'search']) !!}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label>Search ID Card: *</label>
                                        {!! Form::text('search_application', null, ['class' => 'form-control required', 'placeholder' => 'Search Mobile Number/ ID Card Number', 'maxlength' => '255' , 'id'=> 'search_application']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="button" id="search_application_submit_button" class="btn btn-primary mr-2">Search</button>
                            </div>
                            
                        
                        {!! Form::close() !!}
                        <div class="col-lg-12 text-center" id="search-application-datatable">
                            
                        </div>
                        <!--end: Tab Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    // Add an event listener for the DOMContentLoaded event
    document.addEventListener('DOMContentLoaded', function() {
        // Get the search button element
        var searchButton = document.getElementById('search_application_submit_button');

        // Add an event listener for the keypress event
        document.addEventListener('keypress', function(event) {
            // Check if the pressed key is Enter
            if (event.key === 'Enter') {
                // Prevent the default form submission behavior
                event.preventDefault();

                // Trigger a click event on the search button if it exists
                if (searchButton) {
                    searchButton.click();
                }
            }
        });
    });
</script>
