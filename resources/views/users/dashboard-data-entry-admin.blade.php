@extends('layouts.default')
@section('pageTitle', 'Dashboard')
@section('content')
<div class="main d-flex flex-column flex-row-fluid">
    <!--begin::Subheader-->
    {{-- <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap justify-content-between mr-5">
                    <!--begin::Page Title-->
                    <h2 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h2>

                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <!-- <a href="{{url('/viewPendingRequestList') }}" class="btn btn-light font-weight-bold btn-lg color-button-navy">View Entity List</a> -->
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div> --}}
    <!--end::Subheader-->
    <!--begin::Content-->
    @php
    $data= \App\Helpers\Helper::getDataEntryAdminData();
    @endphp
    <div class="content flex-column-fluid" id="kt_content">
        {{-- <div class="row m-0">
            <div class="col background-light-blue px-6 py-8 rounded-xl mr-7 mb-7">
                <div class="last-line m-0">
                    <div class="overviewCard">
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-blue">
                            <i class="far fa-file-alt fa-1x text-blue"></i>
                        </div>
                        <div class="overviewCard-description">
                            <h3 class="overviewCard-title text-blue">{{$data['totalApplies']}}</h3>
                            <p class="overviewCard-subtitle font-weight-bolder">Total Applications</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col background-light-purple px-6 py-8 rounded-xl mr-7 mb-7">
                <div class="last-line m-0">
                    <div class="overviewCard">
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-purple">
                            <i class="far fa-file-alt fa-1x text-purple"></i>
                        </div>
                        <div class="overviewCard-description">
                            <h3 class="overviewCard-title text-purple">{{$data['weeklyCount']}}</h3>
                            <p class="overviewCard-subtitle font-weight-bolder">Weekly Applications</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col background-light-green px-6 py-8 rounded-xl mr-7 mb-7">
                <div class="last-line m-0">
                    <div class="overviewCard">
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-green">
                            <i class="far fa-file-alt fa-1x text-green"></i>
                        </div>
                        <div class="overviewCard-description">
                            <h3 class="overviewCard-title text-green">{{$data['monthlyCount']}}</h3>
                            <p class="overviewCard-subtitle font-weight-bolder">Monthly Applications</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col background-light-red px-6 py-8 rounded-xl mr-7 mb-7">
                <div class="last-line m-0">
                    <div class="overviewCard">
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-red">
                            <i class="far fa-file-alt fa-1x text-red"></i>
                        </div>
                        <div class="overviewCard-description">
                            <h3 class="overviewCard-title text-red">{{$data['yearlyCount']}}</h3>
                            <p class="overviewCard-subtitle font-weight-bolder">Yearly Applications</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row m-0">
            <div class="col background-light-blue px-6 py-8 rounded-xl mr-7 mb-7">
                <div class="last-line m-0">
                    <div class="overviewCard">
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-blue">
                            <i class="far fa-file-alt fa-1x text-blue"></i>
                        </div>
                        <div class="overviewCard-description">
                            <h3 class="overviewCard-title text-blue">{{$data['totalApplies']}}</h3>
                            <p class="overviewCard-subtitle font-weight-bolder">Total applications</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col background-light-purple px-6 py-8 rounded-xl mr-7 mb-7">
                <div class="last-line m-0">
                    <div class="overviewCard">
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-purple">
                            <i class="far fa-file-alt fa-1x text-purple"></i>
                        </div>
                        <div class="overviewCard-description">
                            <h3 class="overviewCard-title text-purple">{{$data['monthlyCount']}}</h3>
                            <p class="overviewCard-subtitle font-weight-bolder">Current month applications</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col background-light-orange px-6 py-8 rounded-xl mr-7 mb-7">
                <div class="last-line m-0">
                    <div class="overviewCard">
                        <div class="overviewCard-icon rounded-circle px-3 py-3 background-light-orange">
                            <i class="far fa-file-alt fa-1x text-orange"></i>
                        </div>
                        <div class="overviewCard-description">
                            <h3 class="overviewCard-title text-orange">{{$data['lastTwoMonthCount']}}</h3>
                            <p class="overviewCard-subtitle font-weight-bolder">Previous two month applications</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection