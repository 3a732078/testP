<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-gray-200 topbar  static-top shadow">

    <!-- Sidebar Toggle (Topbar) 那個縮排用的 icon -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-1">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->

@yield('header_item')

@yield('search')

    <!-- Topbar Navbar -->
    <ul class="navbar-right ml-auto nav nav-tabs ">

    @yield('header_text')

    <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button"
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
