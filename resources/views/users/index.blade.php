@extends('layouts.default')
@section('pageTitle', 'User Management')
@section('content')
<div class="main d-flex flex-column flex-row-fluid">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h2 class="text-dark font-weight-bold my-1 mr-5">User Management</h2>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Content-->
    <div class="content flex-column-fluid pt-5" id="kt_content">        
        <!-- Start:: flash message element -->
        @include('elements.flash-message')
        <!-- End:: flash message element -->        
        <div class="card card-custom card-border gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5 custom-form-block-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-title font-weight-bolder">User List</span>
                </h3>
                <div class="card-toolbar">
                    <a href="{{ route('users.create') }}" class="btn btn-transparent-white font-weight-bolder font-size-sm"><i class="flaticon2-add-square"></i>Add New User</a>
                </div>
            </div>
            <div class="card-header border-0 py-5 table-search">
                {!! Form::open(['method' => 'POST', 'class' => '', 'id' => 'search-form', 'url' => 'search']) !!}
                    {!! Form::hidden('redirectOn','users') !!}
                    <div class="row search-box">
                        <div class="col-lg-3">
                            <div class="form-group m-form__group">
                                <label>Name</label>
                                {!! Form::text('name', request()->get('name'), array('class' => 'form-control m-input')) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group m-form__group">
                                <label>Group</label>
                                {!! Form::select('group', array('' => '-- Select --')+ $listRole, request()->get('group'), array('class' => 'form-control m-input')) !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group m-form__group">
                                <label>Status</label>
                                {!! Form::select('status', array('' => '-- Select --')+ $listStatus, request()->get('status'), array('class' => 'form-control m-input')) !!}
                            </div>
                        </div>
                        <div class="col-lg-3 search-button-wrap">
                            <button type="submit" class="btn btn-primary">
                                Search
                            </button>
                            <a href="{{url('users')}}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                {!! Form::close() !!}
                
                <!-- <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Report History</span>
                </h3>
                <div class="card-toolbar">
                    <a href="#" class="btn btn-info font-weight-bolder font-size-sm">New Report</a>
                </div> -->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-hover table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="pl-0" style="width: 20px">No</th>
                                <th style="min-width: 200px">Name</th>
                                <th style="min-width: 100px">Email</th>
                                <th style="width: 30px">Group</th>
                                <th style="width: 30px">Active</th>
                                <th class="pr-0 text-center" style="min-width: 160px">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($userDetails->count())
                                <?php
                                    $currentPage = $userDetails->currentPage();
                                    $records    = $userDetails->count();
                                    $perPage = $userDetails->perPage();
                                    $page = ($currentPage*$perPage)- $perPage;
                                    $i = $page+1;
                                ?>
                                @foreach ($userDetails as $userDetail)
                                    <tr>														
                                        <td class="pl-0">
                                            <span class="">{{$i}}</span>
                                        </td>
                                        <td>
                                            <span class="">{{$userDetail->name}}</span>
                                        </td>
                                        <td>
                                            <span class="">{{$userDetail->email}}</span>
                                        </td>
                                        <td>
                                            <span class="">{{$userDetail->group->name}}</span>
                                        </td>
                                        <td>
                                            <span class="">{{$userDetail->is_active}}</span>
                                        </td>
                                        <td class="pr-0 text-center">
                                            <a href="{!! route('users.edit', [$userDetail->id]) !!}" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" data-toggle="tooltip" title="" data-original-title="Edit"><i class="icon-xl far fa-edit"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            @else
                                <tr><td class="text-center" colspan="6">No record found</td></tr>
                            @endif                            
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->

                <div class="pagination">
                    {{ $userDetails->appends(Request::except('page'))->links() }}
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
</div>
@endsection