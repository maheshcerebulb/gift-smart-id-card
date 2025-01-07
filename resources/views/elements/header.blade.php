<!--begin::Header Mobile-->

<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">

    <!--begin::Logo-->

    <a href="javascript::void(0);">

        <img alt="Logo" src="{{ asset('/img/logo.png') }}" class="max-h-30px" />

    </a>

    <!--end::Logo-->

    <!--begin::Toolbar-->

    <div class="d-flex align-items-center">

        <button class="btn p-0 burger-icon burger-icon-left" id="kt_header_mobile_toggle">

            <span></span>

        </button>

        <button class="btn p-0 ml-4" id="kt_header_mobile_topbar_toggle">

            <span class="svg-icon svg-icon-xxl">

                <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                        <polygon points="0 0 24 0 24 24 0 24" />

                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />

                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />

                    </g>

                </svg>

                <!--end::Svg Icon-->

            </span>

        </button>

    </div>

    <!--end::Toolbar-->

</div>

<!--end::Header Mobile-->

<!--begin::Header-->

<div id="kt_header" class="header flex-column header-fixed">

    <!--begin::Top-->

    <div class="header-top">

        <!--begin::Container-->

        <div class="container-fluid">

            <!--begin::Left-->

            <div class="d-none d-lg-flex align-items-center mr-3">

                <!--begin::Logo-->

                <a href="{{ route('welcome') }}" class="mr-20">

                    <img src="{{ asset('/img/logo.png') }}" class="max-h-80px" alt=""/>

                </a>

                <!--end::Logo-->

            </div>

            <!--end::Left-->

            <!--begin::Topbar-->

            <div class="topbar topbar-top" id="kt_header_topbar">



                @if(Auth::user()->getRoleNames()->first()=='Entity')

                    <div class="col">

                        <div class="dropdown">

                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                ID Card Application

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                               

                                @if (Auth::user()->unit_category !== 'Other')
                                    <a class="dropdown-item" href="{{ route('entity.create-new-application') }}" data-toggle="m-tooltip" title="" data-placement="right" data-skin="dark" data-container="body" data-original-title="Tooltip title">New Application</a>
                                @endif
                                
                                <!--<a class="dropdown-item" href="#" onclick="alert('Service Temporarily Unavailable');">New Application</a>-->
								
								@if (Auth::user()->unit_category == 'Other')
                                    <a class="dropdown-item" href="{{route('entity.special-category-form')}}">Other Application</a>
                                @endif

                                <a class="dropdown-item" href="{{route('entity.application-search-view')}}">Renew/Surrender Application</a>

                                {{-- <a class="dropdown-item" href="{{route('entity.application-search-view')}}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Surrender Application</a>

                                 --}}

                            </div>

                        </div>

                    </div>



                @elseif (Auth::user()->getRoleNames()->first()=='Admin')

                    <div class="col">

                        <div class="dropdown">

                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                ID Card Application

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                                <a class="dropdown-item" href="{{ route('admin.applications-view') }}" >Applications</a>

                                <a class="dropdown-item" href="{{ route('admin.entity-view') }}">Entities</a>
								
								<a class="dropdown-item" href="{{ route('admin.special-applications-view') }}">Other Applications</a>

                                {{-- <a class="dropdown-item" href="{{ route('role.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Roles</a>

                                <a class="dropdown-item" href="{{ route('permission.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Permissions</a> --}}

                                {{-- <a class="dropdown-item" href="{{ route('company.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Companies</a> --}}

								<a class="dropdown-item" href="{{ route('department.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Departments</a>

                            </div>

                        </div>

                    </div>

                @elseif (Auth::user()->getRoleNames()->first()=='Super Admin')

                    <div class="col">

                        <div class="dropdown">

                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                ID Card Application

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                                <a class="dropdown-item" href="{{ route('admin.entity-view') }}">Entities</a>
								
                                <a class="dropdown-item" href="{{ route('admin.special-entity-view') }}">Other Entities</a>


                                {{-- <a class="dropdown-item" href="{{ route('role.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Roles</a>

                                <a class="dropdown-item" href="{{ route('permission.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Permissions</a> --}}

                                <a class="dropdown-item" href="{{ route('company.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Companies</a>



                            </div>

                        </div>

                    </div>

                

                @elseif (Auth::user()->getRoleNames()->first()=='Data Entry')

                    <div class="col">

                        <div class="dropdown">

                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                ID Card Application

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                                

                                <a class="dropdown-item" href="{{route('liqour.liqour-index')}}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Liquor Application</a>

                            </div>

                        </div>

                    </div>
                    @elseif (Auth::user()->getRoleNames()->first()=='Sub Admin')

                    <div class="col">

                        <div class="dropdown">

                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                ID Card Application

                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">

                                <a class="dropdown-item" href="{{ route('admin.applications-view') }}" >Applications</a>

                                <a class="dropdown-item" href="{{ route('admin.entity-view') }}">Entities</a>
								
								<a class="dropdown-item" href="{{ route('admin.special-applications-view') }}">Other Applications</a>


                                {{-- <a class="dropdown-item" href="{{ route('role.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Roles</a>

                                <a class="dropdown-item" href="{{ route('permission.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Permissions</a> --}}

                                {{-- <a class="dropdown-item" href="{{ route('company.index') }}" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="Tooltip title">Companies</a> --}}



                            </div>

                        </div>

                    </div>
                @else

                @endif

                <!--begin::User-->

                <div class="topbar-item">

                    <div class="btn btn-icon btn-secondary" id="kt_quick_user_toggle">

                        <span class="svg-icon svg-icon-lg">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->

                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                                    <polygon points="0 0 24 0 24 24 0 24" />

                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />

                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />

                                </g>

                            </svg>

                            <!--end::Svg Icon-->

                        </span>

                    </div>

                </div>

                <!--end::User-->

            </div>

            <!--end::Topbar-->

        </div>

        <!--end::Container-->

    </div>

    <!--end::Top-->

    <!--begin::Bottom-->



    <!--end::Bottom-->

</div>

<!--end::Header-->

