{{--
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
            @if(Session::get('User.userGroup') == 1)
                <li class="m-menu__item  m-menu__item--submenu{{ Request::is('users*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                    <a href="{{url('users') }}" class="m-menu__link m-menu__toggle">
                        <span class="icon-span"><i class="m-menu__link-icon fa fa-user"></i></span>
                        <span class="m-menu__link-text">
                            User Management
                        </span>
                    </a>
                </li>
            @endif

            <li class="m-menu__item  m-menu__item--submenu{{ Request::is('connections*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a href="{{url('connections') }}" class="m-menu__link m-menu__toggle">
                    <span class="icon-span"><i class="m-menu__link-icon fa fa-link"></i></span>
                    <span class="m-menu__link-text">
                        Connection
                    </span>
                </a>
            </li>

            <li class="m-menu__item  m-menu__item--submenu{{ Request::is('import*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a href="{{url('import')}}" class="m-menu__link m-menu__toggle">
                    <span class="icon-span"><i class="m-menu__link-icon flaticon-refresh sync-refresh"></i></span>
                    <span class="m-menu__link-text">
                        Import & Sync
                    </span>
                </a>
            </li>
            
            <li class="m-menu__item  m-menu__item--submenu{{ Request::is('datatypes*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a href="{{url('datatypes') }}" class="m-menu__link m-menu__toggle">
                    <span class="icon-span"><i class="m-menu__link-icon fa fa-list" aria-hidden="true"></i></span>
                    <span class="m-menu__link-text">
                        Data Types
                    </span>
                </a>
            </li>

            <li class="m-menu__item  m-menu__item--submenu{{ (Request::is('unitOfMeasures*') || Request::is('unitOfMeasureMappings*')) ? ' m-menu__item--submenu m-menu__item--open m-menu__item--expanded m-menu__item--active ' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <span class="icon-span"><i class="m-menu__link-icon fa fa-balance-scale"></i></span>
                    <span class="m-menu__link-text">
                        UOM
                    </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu ">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item{{ Request::is('unitOfMeasures*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true" >
                            <a  href="{{url('unitOfMeasures')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    PI AF Library
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item{{ Request::is('unitOfMeasureMappings*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true" >
                            <a  href="{{url('unitOfMeasureMappings')}}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">
                                    Mapping
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item  m-menu__item--submenu{{ Request::is('thingtemplates*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a href="{{url('thingtemplates')}}" class="m-menu__link m-menu__toggle">
                    <span class="icon-span"><i class="m-menu__link-icon fa fa-file-text" aria-hidden="true"></i></span>
                    <span class="m-menu__link-text">
                        Templates
                    </span>
                </a>
            </li>

            <li class="m-menu__item  m-menu__item--submenu{{ Request::is('relations*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a href="{{url('relations')}}" class="m-menu__link m-menu__toggle">
                    <span class="icon-span"><i class="m-menu__link-icon fa fa-industry"></i></span>
                    <span class="m-menu__link-text">
                        Assets
                    </span>
                </a>
            </li>
            
            <li class="m-menu__item  m-menu__item--submenu{{ Request::is('visuals*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a href="{{url('visuals')}}" class="m-menu__link m-menu__toggle">
                    <span class="icon-span"><i class="m-menu__link-icon fa fa-times times_size"></i></span>
                    <span class="m-menu__link-text">
                        Nexus View
                    </span>
                </a>
            </li>

            @if(Session::get('User.userGroup') == 1)
                <li class="m-menu__item  m-menu__item--submenu{{ Request::is('setting*') ? ' m-menu__item--active' : ''}}" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                    <a href="{{url('settings') }}" class="m-menu__link m-menu__toggle">
                        <span class="icon-span"><i class="m-menu__link-icon fa fa-cog"></i></span>
                        <span class="m-menu__link-text">
                        	Settings
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>--}}
