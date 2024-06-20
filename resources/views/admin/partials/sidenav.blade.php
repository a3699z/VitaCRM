
<div class="sidebar"
     data-background="">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{route('admin.dashboard')}}" class="sidebar__main-logo"><img
                    src="{{asset('assets/Logo.png')}}" alt="@lang('image')">
                </a>
            <a href="{{route('admin.dashboard')}}" class="sidebar__logo-shape"><img
                src="{{asset('assets/Logo.png')}}" alt="@lang('image')"></a>
            <button type="button" class="navbar__expand"></button>
        </div>

        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                <li class="sidebar-menu-item ">
                    <a href="{{route('admin.dashboard')}}" class="nav-link ">
                        <i class="menu-icon las la-home"></i>
                        <span class="menu-title">@lang('Dashboard')</span>
                    </a>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Manage Teams')</span>
                    </a>
                    <div class="sidebar-submenu ">
                        <ul>
                            <li class="sidebar-menu-item  ">
                                <a href="{{route('admin.teams')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Teams')</span>
                                </a>
                            </li>
                            <!-- create teams -->
                            <li class="sidebar-menu-item ">
                                <a href="{{route('admin.teams.create')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title ">@lang('Create Team')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Manage Users')</span>
                    </a>
                    <div class="sidebar-submenu ">
                        <ul>
                            <li class="sidebar-menu-item  ">
                                <a href="{{route('admin.users')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Users')</span>
                                </a>
                            </li>

                            <li class="sidebar-menu-item ">
                                <a href="{{route('admin.users.employees')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Employees')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item ">
                                <a href="{{route('admin.users.patients')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Patients')</span>
                                </a>
                            </li>
                            <!-- create employee -->
                            <li class="sidebar-menu-item ">
                                <a href="{{route('admin.employees.create')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('Create Employee')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="sidebar-menu-item sidebar-dropdown">
                    <a href="javascript:void(0)" class="">
                        <i class="menu-icon las la-users"></i>
                        <span class="menu-title">@lang('Manage Reservations')</span>


                    </a>
                    <div class="sidebar-submenu ">
                        <ul>
                            <li class="sidebar-menu-item  ">
                                <a href="{{route('admin.reservations')}}" class="nav-link">
                                    <i class="menu-icon las la-dot-circle"></i>
                                    <span class="menu-title">@lang('All Reservations')</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>



            </ul>
            <div class="text-center mb-3 text-uppercase">
                <span class="text--primary">VitaCRM</span>
                <span class="text--success">@lang('V') 1.0.1 </span>
            </div>
        </div>
    </div>
</div>
