<div class="app-menu navbar-menu" style="background: #ea3424;">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo.webp') }}" alt="APC-Diaspora 6th Region" height="22">aa
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo.webp') }}" alt="APC-Diaspora 6th Region" height="70">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/logo.webp') }}" alt="APC-Diaspora 6th Region" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/logo.webp') }}" alt="APC-Diaspora 6th Region" height="70">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu" style="color: #fff;">Menu</span></li>
                @if(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a class="nav-link menu-link" style="color: #fff;" href="{{route('dashboard')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" style="color: #fff;" href="{{route('users.show', Auth::user()->id)}}">
                            <i class="ri-user-2-line"></i> <span data-key="t-dashboards">Profile</span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link menu-link" style="color: #fff;" href="{{route('dashboard')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" style="color: #fff;" href="{{route('users.index')}}">
                            <i class="ri-user-2-line"></i> <span data-key="t-dashboards">Donors</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link menu-link" style="color: #fff;" href="{{route('donations.index')}}">
                            <i class="ri-user-2-line"></i> <span data-key="t-dashboards">Donations</span>
                        </a>
                    </li> --}}
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
