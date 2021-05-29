<div id="sidenav">
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/teacher">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-sticky-note"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Elearning</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>選擇課程</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"></h6>
                    @yield('side_courses')
                </div>
            </div>
        </li>

        @include('layouts.teacher.side_nav_item')

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Message
        </div>

        <li class="nav-item">
            <a class="nav-link" href= "{{route('teacher.ta')}}">
                <i class="fas fa-fw fa-comment"></i>
                <span>與Ta聯繫</span></a>
        </li>
    </ul>
</div>
