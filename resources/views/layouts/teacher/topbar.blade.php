<!-- Topbar -->
<nav class="navbar navbar-expand bg-light mb-4 static-top shadow">

    {{--    有待研究的button--}}
    <button id="sidebarToggleTop" class="btn btn-wrap d-md-none rounded-circle mr-3">
        <i class="fa fa-bars">asdfdsfsdafds</i>
    </button>

    <!-- Topbar Search -->
@yield('search')

{{--    Topbar Courses  --}}
@yield('courses_list')

<!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        @include('layouts.teacher.message')

        {{--        待研究--}}
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">您好，{{auth()->user()->name}}</span>
                <img class="img-profile rounded-circle"
                     src="{{asset('/home/img/undraw_profile.svg')}}">
            </a>

            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    登出
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->
