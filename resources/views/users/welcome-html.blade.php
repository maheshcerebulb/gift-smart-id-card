@extends('layouts.default')
@section('pageTitle', 'Dashboard')
@section('content')
<div class="main d-flex flex-column flex-row-fluid">
    <!--begin::Subheader-->
    
    <!--end::Subheader-->
    <!--begin::Content-->
    <div class="content flex-column-fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-3">
                <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row m-0">
                            Total ID Card   
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card card-custom bgi-no-repeat card-border gutter-b card-stretch" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('/img/abstract-4.svg') }})">
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row m-0">
                            In Drafts
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection