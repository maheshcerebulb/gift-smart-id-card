@extends('layouts.default')

@section('pageTitle', 'Recent Application List')

@section('content')

@php

    $entityDetails=Helper::getEntityDetail($entityApplicationData->user_id);

@endphp

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

                    <div class="col-md-12 card-border-right text-dark px-20 py-10">

                        <div>

                            <p class="font-weight-bolder font-size-h5 text-dark text-hover-primary mb-5">Details are as follows</p>

                            <!-- <h5 class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Details are as follow</h5> -->

                        </div>

                        <div class="font-size-sm line-height-xs mb-5 id-card-text-uppercase">

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Serial No.</label>

                                @if ($entityApplicationData->type == 'Other')
                                    <p class="ml-2 ">{{$entityApplicationData->final_special_serial_no}}</p>
                                @else
                                    <p class="ml-2 ">{{$entityApplicationData->serial_no}}</p>
                                @endif

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Name</label>

                                <p class="ml-2 w-50">{{$entityApplicationData->full_name}}</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Designation</label>

                                <p class="ml-2 w-50">{{$entityApplicationData->designation}}</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Entity Name</label>

                                 @if ($entityApplicationData->type != 'Other')
                                    <p class="ml-2 w-50">{{$entityDetails->company_name}}</p>
                                @else
                                    <p class="ml-2 w-50">{{$entityApplicationData->other_entity}}</p>
                                @endif

                            </div>

                            <div class="d-flex">


                                @if ($entityApplicationData->type != 'Other')
									<label class="label-input-seperator font-weight-bolder w-50">Entity Type</label>

                                    <p class="ml-2 w-50">{{$entityDetails->unit_category}}</p>
                                @else
                                    <label class="label-input-seperator font-weight-bolder w-50">Department</label>

                                    <p class="ml-2 w-50">{{$entityApplicationData->department}}</p>
                                @endif

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Entity Email</label>

                                <p class="ml-2 w-50">{{$entityDetails->email}}</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Contact No.</label>

                                <p class="ml-2 w-50">{{ !empty($entityApplicationData->dial_code) ? '+'.$entityApplicationData->dial_code.' ' : '' }}{{$entityApplicationData->mobile_number}}</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Auth Person Name</label>

                                <p class="ml-2 w-50">{{$entityDetails->full_name}}</p>

                            </div>

                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Auth Person Contact No.</label>

                                <p class="ml-2 w-50">{{ !empty($entityDetails->dial_code) ? '+'.$entityApplicationData->dial_code.' ' : '' }}{{$entityDetails->authorized_person_mobile_number}}</p>

                            </div>
                            @if ($entityApplicationData->status == 500)
                                <div class="d-flex">

                                    <label class="label-input-seperator font-weight-bolder w-50">Reason for rejection</label>

                                    <p class="ml-2 w-50">{{$entityApplicationData->comment}}</p>

                                </div>
                            @endif
                            <div class="d-flex">

                                <label class="label-input-seperator font-weight-bolder w-50">Card Holder Signature</label>
                                <div style="height:20px;width:200px;">
                                    <img width="100" height="50" src="{{ asset('upload/entity-data/entity-application/'.$entityApplicationData->signature) }}" alt="">
                                </div>
                            </div>
                            
                            

                        </div>

                        <div>

                            @if(Auth::user()->getRoleNames()->first() == 'Admin' || Auth::user()->getRoleNames()->first() == 'Sub Admin')

                             

                                @if(helper::getApplicationType($entityApplicationData->status) == 'Activated' || helper::getApplicationType($entityApplicationData->status) == 'Approved')

                                    <a href="{{url('entity/change_application_status/'.$entityApplicationData->id.'/'.config('constant.ENTITY_APPLICATION_READY_TO_COLLECT'))}}" class="btn btn-lg btn-common font-weight-bolder h5 py-4 font-size-sm" onclick="handleProceedToPrintClick(event)">Proceed to Print</a>

                                @endif

                                

                            @endif

                            {{-- @if($entityApplicationData->status==config('constant.ENTITY_APPLICATION_APPROVED'))

                                <a href="{{url('entity/change_application_status/'.$entityApplicationData->id.'/'.config('constant.ENTITY_APPLICATION_READY_TO_COLLECT'))}}" class="btn btn-lg btn-common font-weight-bolder h5 py-4 font-size-sm">Proceed to Print</a>

                            @endif --}}



                        </div>

                    </div>

                    {{-- <div class="col-md-7 px-10 py-10">

                        <div class="text-center">

                            <p class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary mb-5">ID Card Preview</p>

                        </div>

                         <div class="row">

                            <div class="col-md-6 font-size-xs">

                                <div class="text-center mb-10">

                                    <p class="h5 font-weight-bolder">Front</p>

                                </div>

                                <div style="border:2px solid;background: url('{{ asset('img/front_card_bg.jpg') }}');background-size:cover;background-repeat: no-repeat;height:240px;width:100%;">

                                    <img class="bg-image" src="{{asset('image/background.jpg')}}" style="height:440px;width:100%;display:none">

                                        <p style="padding-top:8pt;padding-left:2pt;text-align: center;margin-bottom:0px;">

                                            <span style="color:#092752;font-weight: bold;font-size:16px;">

                                                GIFT Special Economic Zone (SEZ)

                                            </span>

                                        </p>

                                        <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;margin-bottom:0px;">

                                            <span style="color:#092752;font-weight:bold;font-size:12px;">

                                                {{$entityApplicationData->type}} Identity Card

                                            </span>

                                        </p>

                                        <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">

                                            <span style="color:#092752;font-size:8px;">

                                                (Issued under Rule 70 of SEZ Rules, 2006)

                                            </span>

                                        </p>

                                        <div style="width:100%;padding:0px 8px;">

                                            <div style="float: left;width:30%;text-align:center">

                                                <img width="70" height="70" src="{{asset('upload/'.config('constant.ENTITY_APPLICATION_IMAGE_PATH').$entityApplicationData->image)}}">

                                                <br>

                                                <br>

                                                <br>

                                                <p style="text-align:center;margin-top: 5px;margin-bottom:0px;">

                                                    <span style="color: #231F20;font-weight:bold;font-size:6px;">Chetan Varma </span><br>

                                                    <span style="color: #231F20;font-size:6px;">Specified Officer <br> GIFT-Special Economic Zone</span>

                                                </p>

                                            </div>

                                            <div style="width:70%;float:left;">

                                                <table style="color: #231F20;font-size: 8px;padding: 0px 10px;width: 100%;">

                                                    <tbody><tr>

                                                        <th width="40%" style="text-align:left;">Serial Number</th>

                                                        <td width="5%">:</td>

                                                        <td width="60%">000456456</td>

                                                    </tr>

                                                    <tr>

                                                        <th style="text-align:left;">Name of Passholder</th>

                                                        <td>:</td>

                                                        <td>{{$entityApplicationData->full_name}}</td>

                                                    </tr>

                                                    <tr>

                                                        <th style="text-align:left;">Designation</th>

                                                        <td>:</td>

                                                        <td>{{$entityApplicationData->designation}}</td>

                                                    </tr>

                                                    <tr>

                                                        <th style="text-align:left;">Name of Entity</th>

                                                        <td>:</td>

                                                        <td>{{$entityDetails->full_name}}</td>

                                                    </tr>

                                                    <tr>

                                                        <th style="text-align:left;">Entity Type</th>

                                                        <td>:</td>

                                                        <td>{{$entityDetails->unit_category}}</td>

                                                    </tr>

                                                    <tr>

                                                        <th style="text-align:left;">Date of Issue</th>

                                                        <td>:</td>

                                                        <td>{{date('d F, Y',strtotime($entityApplicationData->created_at))}}</td>

                                                    </tr>

                                                    <tr>

                                                        <th style="text-align:left;">Valid upto</th>

                                                        <td>:</td>

                                                        <td>24th Feb., 2024</td>

                                                    </tr>

                                                    <tr>

                                                        <td colspan="3" style="text-align:right;"><img width="50" height="50" src="{{ asset('upload/qrcode/'.$entityApplicationData->qrcode)}}"></td>

                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6 font-size-xs">

                                <div class="text-center mb-10">

                                    <p class="h5 font-weight-bolder">Back</p>

                                </div>

                                <div style="border:2px solid;width:100%;height:240px;">

                                    <p style="padding-top:8pt;padding-left:9pt;text-align: center; margin-bottom:0px;">

                                        <span style="color:#092752;font-weight: bold;font-size:16px;">

                                            GIFT Special Economic Zone (SEZ)

                                        </span>

                                    </p>

                                    <p style="text-indent: 0pt;text-align: center; margin-bottom:0px;">

                                        <span style="color:#092752;font-weight:bold;font-size:12px;">

                                            Villages - Phirozpur and Ratanpur<br>

                                            District - Gandhinagar-382355, State - Gujarat

                                        </span>

                                    </p>



                                    <p style="padding-left: 9pt;text-indent: 0pt;text-align:left;margin-bottom:0px;">

                                        <span style="color: #231F20;font-weight: bold;border-bottom: 1px solid;font-size:8px;">

                                            General Instructions:

                                        </span>

                                    </p>

                                    <ul style="padding:5px 25px;font-size:7px;margin-bottom:0px;">

                                        <li> This pass should be worn and displayed on the person of the pass holder while inside the Zone.</li>

                                        <li> This pass is not transferable</li>

                                        <li> This pass shall be produced on demand by GIFT SEZ Security and Customs staff</li>

                                        <li> The pass holder and his vehicle are liable for Security Check at the GIFT SEZ gate</li>

                                        <li> The loss of this pass shall immediately be reported to the Security Officer, GIFT SEZ</li>

                                        <li> This pass shall be surrendered to the Security Officer, GIFT SEZ through the Developer/Unit/Contractor on expiry or on the person becoming ineligible for this pass.</li>

                                    </ul>

                                    <p style="padding-left: 9pt;text-align: left;">

                                        <span style="color:#231F20;font-weight:bold;">

                                            Mobile No. of Passholder: :

                                        </span>

                                        <span style="color: #231F20;">{{$entityApplicationData->mobile_number}}</span>

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div> --}}

                </div>

                @if($entityApplicationData->status==config('constant.ENTITY_APPLICATION_READY_TO_COLLECT'))

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

                

                @endif

            </div>

        </div>

    </div>

</div>



@endsection

