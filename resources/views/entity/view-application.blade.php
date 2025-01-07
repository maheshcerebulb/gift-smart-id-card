@php

    $entityDetails=Helper::getEntityDetail($entityApplicationData->user_id);
    
@endphp

<div class="modal-header">

    <h5 class="modal-title" id="exampleModalLabel">Application Details</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <i aria-hidden="true" class="ki ki-close"></i>

    </button>

</div>

<div class="modal-body text-dark">

    <div class="d-flex">

        <div class="profile-image d-flex justify-content-between shadow-inset mr-10  mb-5 symbol symbol-50 symbol-lg-90">

            <img src="{{asset('upload/'.config('constant.ENTITY_APPLICATION_IMAGE_PATH').$entityApplicationData->image)}}" class="card-img-top" alt="Christopher Avatar">

        </div>

        <div class="font-size-sm py-3">

            <p class="font-weight-bolder text-dark mb-0">{{$entityApplicationData->type}} Identity Card</p>

            <div class="d-flex mb-5">

                <label class="label-input-seperator mb-0 w-50">Sr. No.</label>
				@if ($entityApplicationData->type == 'Other')
                    <p class="ml-2 w-100">{{$entityApplicationData->final_special_serial_no}}</p>
                @else
                    <p class="ml-2 w-100">{{$entityApplicationData->serial_no}}</p>
                @endif
                

            </div>

            {{-- <a href="#" class="text-underline">View Aadhar Card</a> --}}

        </div>

    </div>

    <div class="line-height-sm">

        <p class="font-weight-bolder font-size-h5 text-dark text-hover-primary mb-4">{{$entityApplicationData->full_name}}</p>

    </div>

    <div class="font-size-sm line-height-xs">

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50 ">Serial No.</label>

            @if ($entityApplicationData->type == 'Other')
                <p class="ml-2 w-50">{{$entityApplicationData->final_special_serial_no}}</p>
            @else
                <p class="ml-2 w-50">{{$entityApplicationData->serial_no}}</p>
            @endif

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50 ">Entity Name</label>

            @if ($entityApplicationData->type != 'Other')
                <p class="ml-2 w-50 line-height-normal" style="margin-top:-3px;">{{$entityDetails->company_name}}</p>
            @else
                <p class="ml-2 w-50 line-height-normal" style="margin-top:-3px;">{{$entityApplicationData->other_entity}}</p>
            @endif

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Entity Type</label>

            <p class="ml-2 w-50">{{$entityDetails->unit_category}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Entity Email</label>

            <p class="ml-2 w-50">{{$entityDetails->email}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Contact No.</label>

            <p class="ml-2 w-50">{{$entityApplicationData->mobile_number}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Auth Person Name</label>

            <p class="ml-2 w-50">{{$entityDetails->full_name}}</p>

        </div>
        
        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Date of Issue</label>

            <p class="ml-2 w-50">{{date('d-m-Y',strtotime($entityApplicationData->issue_date))}}</p>

        </div>
        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Valid upto</label>

            <p class="ml-2 w-50">
                @if ($entityApplicationData->type == 'Other')
                    Till posting in SEZ 
                @else
                    {{date('d-m-Y',strtotime($entityApplicationData->expire_date))}}
                @endif
                </p>

        </div>
        
        <div class="d-flex" style="height: 35px;">

            <label class="label-input-seperator font-weight-bolder w-50">Card Holder Signature</label>
            <div style="height:20px;width:52%;">
                <img width="50" height="30" src="{{ asset('upload/entity-data/entity-application/'.$entityApplicationData->signature) }}" class="ml-2 w-50" alt="">
            </div>
        </div>
        @if (!empty($entityApplicationData->comment) && $entityApplicationData->status == 403)
        <div class="d-flex" style="height: 35px;">
            <label class="label-input-seperator font-weight-bolder w-50">Comment</label>
            <div style="height:20px;width:52%;">
                <p class="ml-2 w-50" style="line-height: 14px;">{{$entityApplicationData->comment}}</p>
            </div>
        </div>
        @endif
        @if ($entityApplicationData->status == 500)
            <div class="d-flex">

                <label class="label-input-seperator w-50">Reason for rejection</label>

                <p class="ml-2 w-50">{{$entityApplicationData->comment}}</p>

            </div>
        @elseif($entityApplicationData->status == 205 || ($entityApplicationData->status == 202 && !empty($entityApplicationData->comment)))
            <div class="d-flex">

                <label class="label-input-seperator font-weight-bolder w-50">Reason for Send Back</label>

                <p class="ml-2  w-50">{{$entityApplicationData->comment}}</p>

            </div>
        @elseif($entityApplicationData->status == 401 || $entityApplicationData->status == 206 || $entityApplicationData->status == 255)
            <div class="d-flex">

                <label class="label-input-seperator font-weight-bolder w-50">Reason for Surrender</label>

                <p class="ml-2  w-50">{{Helper::surrenderstatus($entityApplicationData->surrender_reason)}}
                    @if ($entityApplicationData->surrender_reason == 4)
                    <span>({{$entityApplicationData->surrender_comment}})</span>
                    @endif</p>
                
            </div>

            @if($entityApplicationData->status == 401 && !empty($entityApplicationData->surrender_signature))
            <div class="d-flex" >
                @if(!empty($entityApplicationData->surrender_signature))
                    <?php
                        $filePath = public_path('upload/surrender/' . $entityApplicationData->surrender_signature);
                    ?>
                    @if (file_exists($filePath) && filesize($filePath) > 0) 
                        <label class="label-input-seperator font-weight-bolder w-50">Surrender Document</label>
                    
                        <div style="width:52%;">
                            <a download href="{{asset('upload/surrender/'.$entityApplicationData->surrender_signature)}}" class="btn btn-light-primary font-weight-bold">Download Document</a>
                        </div>
                    @endif
                
                @endif
            </div>

            @endif
        @endif
        {{-- <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Auth Person Contact No.</label>

            <p class="ml-2 w-50">{{$entityDetails->authorized_person_mobile_number}}</p>

        </div> --}}

    </div>



</div>

<div class="modal-footer border-0">

    

    @if(Auth::user()->roles->pluck('name')[0]=='Admin')

        @if($entityApplicationData->status !== 201 || $entityApplicationData->status !== 202 )

            @if($entityApplicationData->status !==203 )

                @if ($entityApplicationData->status == 200)
                    <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>

                @else

                    @if ($entityApplicationData->status == 206)
                        <a type="button" href="javascript:;" class="btn btn-lg btn-common font-weight-bolder h5 px-10" onclick="terminateverifyentityapplication({{ $entityApplicationData->id }})" id="terminate_verify_application">Terminate</a>
                    @elseif ($entityApplicationData->status == 255 || $entityApplicationData->status == 403)
						@if($entityApplicationData->status == 403)
                            <a type="button" href="javascript:;" class="btn btn-lg btn-common font-weight-bolder h5 px-10" onclick="blockunentityapplication({{ $entityApplicationData->id }},203,'Unblock')" id="blockorunblock_application">Unblock</a>
                        @endif
                        <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>
                    @else
                        <a type="button" data-id="{{$entityApplicationData->id}}" data-link="{{url('entity/change_application_status/'.$entityApplicationData->id.'/'.config('constant.ENTITY_APPLICATION_REJECTED'))}}" class="btn btn-xl btn-bg-white h5 font-weight-bolder px-10" id="reject_application">Reject</a>

                        <a type="button" data-id="{{$entityApplicationData->id}}" data-link="{{url('entity/change_application_status/'.$entityApplicationData->id.'/'.config('constant.ENTITY_APPLICATION_APPROVED'))}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10" id="approve_application">Approve</a>
                    @endif
                    
                @endif
            @else
				@if ($entityApplicationData->status == 203)
                    <a type="button" href="javascript:;" class="btn btn-lg btn-common font-weight-bolder h5 px-10" onclick="blockunentityapplication({{ $entityApplicationData->id }},403,'Block')" id="blockorunblock_application">Block</a>
                @endif
                <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>

            @endif
       
        @elseif ($entityApplicationData->status==200)

        <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">Proceed to Print</a>
        
        @else

        <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>

        @endif
    @elseif (Auth::user()->roles->pluck('name')[0]=='Sub Admin')

            @if($entityApplicationData->status==202)

                {{-- <a type="button" data-id="{{$entityApplicationData->id}}" data-link="{{url('entity/change_application_status/'.$entityApplicationData->id.'/'.config('constant.ENTITY_APPLICATION_REJECTED'))}}" class="btn btn-xl btn-bg-white h5 font-weight-bolder px-10" id="reject_application">Reject</a> --}}
       
                <a type="button" href="javascript:;" class="btn btn-lg btn-common font-weight-bolder h5 px-10" onclick="verifyentityapplication({{ $entityApplicationData->id }})" id="verified_application">Verify</a>
                
                <a type="button" data-id="{{$entityApplicationData->id}}" data-link="{{url('entity/change_application_status/'.$entityApplicationData->id.'/'.config('constant.ENTITY_APPLICATION_SENDBACK'))}}" class="btn btn-xl btn-bg-white h5 font-weight-bolder px-10" id="sendback_application">Send Back</a>

                @if ($entityApplicationData->status == 204)
                    <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>
                @endif

            @elseif ($entityApplicationData->status==200)

                <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>

            @elseif ($entityApplicationData->status==205 || $entityApplicationData->status==403 || $entityApplicationData->status==501)

                @if($entityApplicationData->status == 403)
                    <a type="button" href="javascript:;" class="btn btn-lg btn-common font-weight-bolder h5 px-10" onclick="blockunentityapplication({{ $entityApplicationData->id }},203,'Unblock')" id="blockorunblock_application">Unblock</a>
                @endif
                <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>
    
            @elseif ($entityApplicationData->status==401)

                <a type="button" href="javascript:;" class="btn btn-lg btn-common font-weight-bolder h5 px-10" onclick="surrenderverifyentityapplication({{ $entityApplicationData->id }})" id="surrender_verify_application">Verify</a>
                
                <a type="button" data-id="{{$entityApplicationData->id}}" data-link="{{url('entity/change_application_status/'.$entityApplicationData->id.'/'.config('constant.ENTITY_APPLICATION_SENDBACK'))}}" class="btn btn-xl btn-bg-white h5 font-weight-bolder px-10" id="sendback_application">Send Back</a>
                
            @else
				@if ($entityApplicationData->status == 203)
                    <a type="button" href="javascript:;" class="btn btn-lg btn-common font-weight-bolder h5 px-10" onclick="blockunentityapplication({{ $entityApplicationData->id }},403,'Block')" id="blockorunblock_application">Block</a>
                @endif
                <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>
    
            @endif
    @else

        @if(Helper::getApplicationType($entityApplicationData->status) == 'Draft')

            <a type="button" href="{{url('entity/draftApplication/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">Procceed Application</a>

        @elseif (Helper::getApplicationType($entityApplicationData->status) == 'Send Back')

            @if($entityApplicationData->application_type == 2)
                <a type="button" href="{{url('search/surrenderApplication/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">Re-Surrender</a>
            @else
                <a type="button" href="{{url('entity/draftApplication/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">Submit Again</a>
            @endif
           

            <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>

        @else
            @if ($entityApplicationData->surrender_reason == 5 && (Helper::getApplicationType($entityApplicationData->status) == 'Terminated' || Helper::getApplicationType($entityApplicationData->status) == 'Hard copy submitted'))
            	<a type="button" href="{{url('search/renewApplication/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">Renew</a>
            @endif
            <a type="button" href="{{url('entity/proceedToPrint/'.$entityApplicationData->id)}}" class="btn btn-lg btn-common font-weight-bolder h5 px-10">View More Details</a>

        @endif

    @endif

</div>





