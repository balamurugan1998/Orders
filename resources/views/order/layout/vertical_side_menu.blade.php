<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{url('/dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">{{Config::get('constants.app_title')}}</span>
            <span class="logo-lg">{{Config::get('constants.app_title')}}</span>
        </a>

        <a href="{{url('/dashboard')}}" class="logo logo-light">
            <span class="logo-sm h5 text-white">{{Config::get('constants.app_title')}}</span>
            <span class="logo-lg h5 text-white">{{Config::get('constants.app_title')}}</span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('user_dashboard') }}" class="waves-effect">
                        <i class="icon nav-icon" data-feather="home"></i>
                        <span class="menu-item" key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('order.index') }}" class="waves-effect">
                        <i class="icon nav-icon" data-feather="calendar"></i>
                        <span class="menu-item" key="t-calendar">Orders</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->