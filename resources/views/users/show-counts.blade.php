@php

$data=Helper::getApplicationCount();

@endphp



<div class="row">

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body px-5">

                <div class="last-line m-0">

                    <div class="overviewCard">

                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-orange">

                            <i class="far fa-file-alt fa-1x text-orange"></i>

                        </div>

                        <div class="overviewCard-description">

                            <h3 class="overviewCard-title text-orange">{{$data['totalCount']}}</h3>

                            <p class="overviewCard-subtitle font-weight-bolder">Total</p>

                        </div>

                    </div>

                </div>

            </div>

            <!--end::Body-->

        </div>

    </div>

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body px-5">

                <div class="last-line m-0">

                    <div class="overviewCard">

                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-purple">

                            <i class="far fa-file-alt fa-1x text-purple"></i>

                        </div>

                        <div class="overviewCard-description">

                            <h3 class="overviewCard-title text-purple">{{$data['submittedCount']}}</h3>

                            <p class="overviewCard-subtitle font-weight-bolder">Submited</p>

                        </div>

                    </div>

                </div>

            </div>

            <!--end::Body-->

        </div>

    </div>

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body">

                <div class="row m-0">

                    <div class="overviewCard ">

                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-yellow">

                            <i class="ki ki-bold-check fa-1x text-white"></i>
                        </div>

                        <div class="overviewCard-description">

                            <h3 class="overviewCard-title text-yellow">{{$data['verifiedCount']}}</h3>

                            <p class="overviewCard-subtitle font-weight-bolder">Verified</p>

                        </div>

                    </div>

                </div>

            </div>

            <!--end::Body-->

        </div>

    </div>

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body">

                <div class="row m-0">

                    <div class="overviewCard ">

                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-blue">

                            <i class="fas fa-undo-alt fa-1x text-blue"></i>

                        </div>

                        <div class="overviewCard-description">

                            <h3 class="overviewCard-title  text-blue">{{$data['sendbackCount']}}</h3>

                            <p class="overviewCard-subtitle font-weight-bolder">Send Back</p>

                        </div>

                    </div>

                </div>

            </div>

            <!--end::Body-->

        </div>

    </div>

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body px-5">

                <div class="last-line m-0">

                    <div class="overviewCard">

                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-cyon">

                            <i class="far fa-file-alt fa-1x text-cyon"></i>

                        </div>

                        <div class="overviewCard-description">

                            <h3 class="overviewCard-title text-cyon">{{$data['approvedCount']}}</h3>

                            <p class="overviewCard-subtitle font-weight-bolder width-min-content">Approved/Activated</p>

                        </div>

                    </div>

                </div>

            </div>

            <!--end::Body-->

        </div>

    </div>

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body px-5">

                <div class="last-line m-0">

                    <div class="overviewCard">

                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-red">

                            <i class="far fa-file-alt fa-1x text-red"></i>

                        </div>

                        <div class="overviewCard-description">

                            <h3 class="overviewCard-title text-red">{{$data['rejectedCount']}}</h3>

                            <p class="overviewCard-subtitle font-weight-bolder">Rejected</p>

                        </div>

                    </div>

                </div>

            </div>

            <!--end::Body-->

        </div>

    </div>

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body">

                <div class="row m-0">
        
                    <div class="overviewCard ">
        
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-red">
        
                            <i class="fas fa-user-times fa-1x text-red"></i>
        
                        </div>
        
                        <div class="overviewCard-description">
        
                            <h3 class="overviewCard-title text-red">{{$data['surrenderCount']}}</h3>
        
                            <p class="overviewCard-subtitle font-weight-bolder">Surrender/ Hard copy submitted.</p>
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>

            <!--end::Body-->

        </div>

    </div>

    <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body">

                <div class="row m-0">
        
                    <div class="overviewCard ">
        
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-black">
        
                            <i class="fas fa-user-times fa-1x text-light-black"></i>
        
                        </div>
        
                        <div class="overviewCard-description">
        
                            <h3 class="overviewCard-title text-light-black">{{$data['terminatedCount']}}</h3>
        
                            <p class="overviewCard-subtitle font-weight-bolder">Terminated</p>
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>

            <!--end::Body-->

        </div>

    </div>

    

    

    {{-- <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-6">

        <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">

            <!--begin::Body-->

            <div class="card-body px-5">

                <div class="m-0">

                    <div class="overviewCard ">

                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-purple">

                            <i class="fa far fa-file-pdf fa-1x text-purple"></i>

                        </div>

                        <div class="overviewCard-description">

                            <h3 class="overviewCard-title text-purple">{{$data['readytoCollectCount']}}</h3>

                            <p class="overviewCard-subtitle font-weight-bolder">Activated</p>

                        </div>

                    </div>

                </div>

            </div>

            <!--end::Body-->

        </div>

    </div> --}}



   
    

    

</div>