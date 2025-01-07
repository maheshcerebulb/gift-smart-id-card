<div class="modal-header">

    <h5 class="modal-title" id="exampleModalLabel">Entity Details</h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <i aria-hidden="true" class="ki ki-close"></i>

    </button>

</div>

<div class="modal-body text-dark">


    <div class="d-flex">

        {{-- <div class="profile-image d-flex justify-content-between shadow-inset mr-10  mb-5 symbol symbol-50 symbol-lg-90">

            <img src="{{asset('upload/'.config('constant.ENTITY_DOCUMENT_TEMP_PATH').$entityData->authorized_person_signature)}}" class="card-img-top" alt="Christopher Avatar">

        </div> --}}

        <div class="font-size-sm py-3">

            {{-- <p class="font-weight-bolder text-dark mb-0">{{$entityData->type}} Indentity Card</p> --}}

            <div class="d-flex mb-5">

                <label class="label-input-seperator mb-0">Application No (Form F)</label>

                <p class="mb-0">{{$entityData->application_number }}</p>

            </div>

        </div>

    </div>

    <div class="line-height-sm">

        <p class="font-weight-bolder font-size-h5 text-dark text-hover-primary mb-4">{{$entityData->company_name}}</p>

    </div>

    <div class="font-size-sm line-height-xs">

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Entity Category</label>

            <p class="ml-2 w-50">{{$entityData->unit_category}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Email Address</label>

            <p class="ml-2 w-50">{{$entityData->email}}</p>

        </div>

        {{-- <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Company Name</label>

            <p class="ml-2 w-50">{{$entityData->company_name}}</p>

        </div> --}}

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Constitution of Business</label>

            <p class="ml-2 w-50">{{$entityData->constitution_of_business}}</p>

        </div>

        <div class="d-flex line-height-normal">

            <label class="label-input-seperator font-weight-bolder w-50">Entity Address</label>

            <p class="ml-2 w-50 ">{{$entityData->company_address }}<br>{{ $entityData->company_city }} - {{ $entityData->company_pin_code }} <br> {{$entityData->company_state }},{{$entityData->company_country}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Registration Number</label>

            <p class="ml-2 w-50">{{$entityData->company_registration_number}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Permanent Account Number (PAN)</label>

            <p class="ml-2 w-50">{{$entityData->pan_number}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Auth Person Name</label>

            <p class="ml-2 w-50 ">{{$entityData->authorized_person_first_name.' '.$entityData->authorized_person_last_name}}</p>

        </div>

        <div class="d-flex line-height-normal">

            <label class="label-input-seperator font-weight-bolder w-50">Designation</label>

            <p class="ml-2 w-50 ">{{$entityData->authorized_person_designation}}</p>

        </div>

        <div class="d-flex">

            <label class="label-input-seperator font-weight-bolder w-50">Mobile Number</label>

            <p class="ml-2 w-50">{{$entityData->authorized_person_mobile_number.'( '.$entityData->authorized_person_mobile_number_2.' )'}}</p>

        </div>
        <div class="d-flex h-40px">

            <label class="label-input-seperator font-weight-bolder w-50">Entity Signature</label>

            <div style="height:20px;width:52%;">
                <img width="50" height="30" src="{{asset('upload/'.config('constant.ENTITY_DOCUMENT_TEMP_PATH').$entityData->authorized_person_signature)}}" class="ml-2 w-50" alt="">
            </div>

        </div>
        <div class="d-flex" >

            <label class="label-input-seperator font-weight-bolder w-50">Entity Document</label>
           
            <div style="width:52%;">
                <a download href="{{asset('upload/'.config('constant.ENTITY_DOCUMENT_TEMP_PATH').$entityData->authorized_person_support_document)}}" class="btn btn-light-primary font-weight-bold">Download Document</a>
            </div>
            

        </div>

    </div>



</div>