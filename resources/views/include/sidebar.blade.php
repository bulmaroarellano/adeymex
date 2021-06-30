<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
               <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="RADMIN">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>
                            @can('view-any', App\Models\Menu::class)
                            <div class="nav-item {{ ($segment2 == 'menus') ? 'active' : '' }}">
                                <a href="{{ route('menus.index') }}"><i class="ik ik-align-justify"></i><span>{{ __('Menus')}}</span></a>
                            </div>
                    @endcan
                            @can('view-any', App\Models\Customer::class)
                            <div class="nav-item {{ ($segment2 == 'customers') ? 'active' : '' }}">
                                <a   href="{{ route('customers.index') }}"><i class="ik ik-star-on"></i><span>Customers</a>
                            </div>
                            @endcan
                            @can('view-any', App\Models\Event::class)
                            <div class="nav-item  {{ ($segment2 == 'events') ? 'active' : '' }}">

                             <a href="{{route('events.index')}}"><i class="ik ik-calendar"></i><span>{{ __('Events')}}</span> </a>
                             </div>

                             @endcan
                           @can('view-any', App\Models\Invoice::class)
                                <div class="nav-item {{ ($segment2 == 'invoices') ? 'active' : '' }}">

                            <a class="dropdown-item" href="{{ route('invoices.index') }}"><i class="ik ik-calendar"></i><span>Invoices</span></a>
                            </div>
                            @endcan
                    <div class="nav-lavel">{{ __('Users, Permissions and +')}} </div>
                        <div class="nav-item {{ ($segment2 == 'users' || $segment2 == 'roles'||$segment2 == 'permissions' ||$segment2 == 'user') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-user"></i><span>{{ __('Adminstrator')}}</span></a>
                            <div class="submenu-content">
                                <!-- only those have manage_user permission will get access -->
                                @can('manage_user')
                                <a href="{{url('admin/users')}}" class="menu-item {{ ($segment2 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                                <a href="{{url('admin/users/create')}}" class="menu-item {{ ($segment2 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                                @endcan
                                <!-- only those have manage_role permission will get access -->
                                @can('manage_roles')
                                <a href="{{url('admin/roles')}}" class="menu-item {{ ($segment2 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                                @endcan
                                <!-- only those have manage_permission permission will get access -->
                                @can('manage_permission')
                                <a href="{{url('admin/permissions')}}" class="menu-item {{ ($segment2 == 'permissions') ? 'active' : '' }}">{{ __('Permission')}}</a>
                                @endcan
                            </div>
                        </div>
                    </div>
            </nav>
        </div>
    </div>
