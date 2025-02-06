{{-- <div class="d-flex flex-row justify-content-between mb-4">
    <div class="title">
        <h3>@yield('page-header')</h3>
        <!-- <ul class="breadcrumb text-muted fs-6 fw-normal ms-1">
         <li class="breadcrumb-item text-muted"><a href="dashboard.html" class="text-muted text-hover-primary">Home</a></li>
         <li class="breadcrumb-item text-dark">Dashboards</li>
      </ul> -->
    </div>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="{{ asset('/theme/images/profile_icon.png') }}" alt="" width="50" height="50"
                class="rounded-circle me-2">
            <div class="user-name">
                <strong>{{ auth()->user()->name }}</strong></br>
                <small><b>Email:</b> {{ auth()->user()->email }}</small>
            </div>
        </a>
        <ul class="dropdown-menu text-small shadow" style="">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item"
                    href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <!-- <a class="dropdown-item" href="#">Sign out</a> -->
            </li>
        </ul>
    </div>
</div> --}}


<div class="d-flex flex-row justify-content-between">
    <div class="title">
        <h3 class="title-lg">@yield('page-header')</h3>
        <ul class="breadcrumb text-muted fs-6 fw-normal ms-1">
            <li class="breadcrumb-item text-muted"><a href={{ route('dashboard') }}
                    class="text-muted text-hover-primary">Home</a></li>
            <li class="breadcrumb-item text-dark">@yield('page-header')</li>
        </ul>
    </div>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="http://10.173.42.87:8080/rhewbhousing/rhe-wbhousing-v2/sites/all/themes/housingtheme/images/profile_icon.png"
                alt="" width="50" height="50" class="rounded-circle me-2">
            <div class="user-name">
                <strong>{{ auth()->user()->name }}</strong></br>
                <small><b>Email:</b> {{ auth()->user()->email }}</small>
            </div>
        </a>
        <ul class="dropdown-menu text-small shadow" style="">
            <li><a class="dropdown-item"
                    href="http://10.173.42.87:8080/rhewbhousing/rhe-wbhousing-v2/user-profile">Profile</a></li>
            <li>
                <a class="dropdown-item"
                    href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                <!-- <a class="dropdown-item" href="#">Sign out</a> -->
            </li>

        </ul>
    </div>
</div>
