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

                        {!! Form::open(['route' => 'search.save-surrender-entity-application-detail', 'class' => 'form fv-plugins-bootstrap fv-plugins-framework', 'id' => 'entity_surrender_application_form', 'action-for' => 'add']) !!}

                        {!! Form::hidden('user_id', Auth::id(), ['class' => 'entity-application-user-id']) !!}

                        {!! Form::hidden('id', $entityApplicationDetailData->id, ['class' => 'entity-application-id']) !!}

                        {!! Form::hidden('application_type', $entityApplicationDetailData->application_type = 2 ,['class' => 'entity-application-type']) !!}





                            <div class="col-lg-12 mb-5">

                                <div class="row">

                                    <div class="col-lg-2">

                                        <div class="flex-shrink-0 mr-7">

                                            <div class="symbol symbol-50 symbol-lg-120">

                                                <img alt="Pic" src="{{ asset('upload/entity-data/entity-application/'.$entityApplicationDetailData->image) }}">

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-10 m-auto font-size-h5">

                                        <div class="align-items-center">

                                            <span class="text-dark-75  mr-2">Name of card holder:</span>

                                            <a href="#" class="text-dark font-weight-bolder">{{ $entityApplicationDetailData->getFullNameAttribute()}}</a>

                                        </div>

                                        <div class="align-items-center">

                                            <span class="text-dark-75  mr-2">Id Card Number:</span>

                                             @if ( $entityApplicationDetailData->type != 'Other')
                                                <a href="#" class="text-dark font-weight-bolder">{{ $entityApplicationDetailData->serial_no}}</a>
                                            @else
                                                <a href="#" class="text-dark font-weight-bolder">{{ $entityApplicationDetailData->final_special_serial_no}}</a>

                                            @endif

                                        </div>

                                        @if($entityApplicationDetailData->application_type == 2)
                                        <div class="align-items-center">

                                            <span class="text-dark-75  mr-2">Send Back Reason:</span>

                                            <a href="#" class="text-dark font-weight-bolder">{{ $entityApplicationDetailData->comment}}</a>

                                        </div>
                                        @endif

                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-12 text-center">

                                <div class="row">

                                    <div class="col-md-12 text-left">

                                        <h3 class="mb-5">Reason for surrender</h3>

                                    </div>

                                    <div class="col-md-8">

                                        <div class="radio-inline flex-wrap form-group">

                                            <label class="radio radio-outline radio-primary">

                                                <input type="radio" id="surrender_reason" name="surrender_reason"
                                                 value="1"
                                                {{ !empty($entityApplicationDetailData)
                                                && $entityApplicationDetailData->surrender_reason == 1
                                                ? 'checked' : '' }}>

                                                <span></span>Employee left the organization'

                                            </label>

                                            <label class="radio radio-outline radio-primary">

                                                <input type="radio" id="surrender_reason" name="surrender_reason"
                                                 value="2"
                                                {{ !empty($entityApplicationDetailData)
                                                && $entityApplicationDetailData->surrender_reason == 2
                                                ? 'checked' : '' }}>

                                                <span></span>Damaged ID Card

                                            </label>

                                            <label class="radio radio-outline radio-primary">

                                                <input type="radio" id="surrender_reason" name="surrender_reason"
                                                 value="3"
                                                {{ !empty($entityApplicationDetailData)
                                                && $entityApplicationDetailData->surrender_reason == 3
                                                ? 'checked' : '' }}>
                                                <span></span>Lost/Stolen ID Card

                                            </label>
                                            
                                            <label class="radio radio-outline radio-primary">
                                            	<input type="radio" id="surrender_reason" name="surrender_reason"
                                            	 value="5"
                                            	{{ !empty($entityApplicationDetailData)
                                            	&& $entityApplicationDetailData->surrender_reason == 5
                                            	? 'checked' : '' }}>
                                            	<span></span>Renew ID Card
                                            </label>

                                            <label class="radio radio-outline radio-primary">

                                                <input type="radio" id="surrender_reason" name="surrender_reason"
                                                 value="4"
                                                {{ !empty($entityApplicationDetailData)
                                                && $entityApplicationDetailData->surrender_reason == 4
                                                ? 'checked' : '' }}>

                                                <span></span>Other

                                            </label>

                                        </div>

                                        <textarea name="surrender_comment" class="form-control form-control-solid required" 
                                        placeholder="Enter other reason" id="surrender_comment" rows="5" style="display: none;">{{ !empty($entityApplicationDetailData) && $entityApplicationDetailData->surrender_comment?$entityApplicationDetailData->surrender_comment:''}}
                              </textarea>
                              

                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group fv-plugins-icon-container">

                                            <label class="text-left text-dark font-weight-bolder">Upload ID CARD * :&nbsp;<span class="text-muted font-weight-bold text-hover-primary">(Note: Upload FIR In Case of lost or stolen ID Card)</span></label>


                                            <input id="surrender_signature_hidden" name="surrender_signature_hidden" type="hidden" value="{{ !empty($entityApplicationDetailData) ? $entityApplicationDetailData->surrender_signature : null }}">

                                            <input id="previous_surrender_signature_hidden" name="previous_surrender_signature_hidden" type="hidden" value="{{ !empty($entityApplicationDetailData) ? $entityApplicationDetailData->surrender_signature : null }}">


                                            <div class="dropzone dropzone-default dropzone-success" id="surrender_signature">

                                                <div class="dropzone-msg dz-message needsclick">

                                                    <h3 class="dropzone-msg-title">Drop file here or click to upload.</h3>

                                                    <span class="dropzone-msg-desc">Only image file is allowed for upload</span>

                                                </div>

                                            </div>

                                            @if (!empty($entityApplicationDetailData->surrender_signature))

                                            <img width="50" height="50" src="{{ asset('upload/surrender/' . $entityApplicationDetailData->surrender_signature) }}" id="old_surrender_signature" alt="">
            
                                                <a href="javascript:;" id="signature-remove-btn" onclick="removeSurrenderSignature()">remove</a>
            
                                            @endif

                                        </div>

                                       

                                    </div>

                                    

                                </div>

                            </div>

                            <div class="col-lg-12">

                                <button type="button" id="surrender_application_submit_button" class="btn btn-primary mr-2">Submit</button>

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



