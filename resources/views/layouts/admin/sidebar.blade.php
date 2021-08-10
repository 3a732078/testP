<div id="sidenav">
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
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

        <!-- 課程列表 -->
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities"--}}
{{--               aria-expanded="true" aria-controls="collapseUtilities">--}}
{{--                <i class="fas fa-fw fa-folder-open"></i>--}}
{{--                <span>選擇課程</span>--}}
{{--            </a>--}}

{{--            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"--}}
{{--                 data-parent="#accordionSidebar">--}}
{{--                <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                    @yield('side_courses')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </li>--}}

        <!-- 帳號管理 -->
        <li class="nav-item">
            <a class="nav-link collapsed"
               href="{{route('account.index')}}"
               data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>帳號管理</span>
            </a >
        </li>

        <!-- 科系管理 -->
        <li class="nav-item">
            <a class="nav-link collapsed"
               href="{{route('department.index')}}"
               data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>科系管理</span>
            </a >
        </li>

        <!-- 其他列表暫不使用 -->
    @include('layouts.teacher.side_nav_item')


{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href= "teacher/{{$course -> id}}/ta">--}}
{{--                <i class="fas fa-fw fa-comment"></i>--}}
{{--                <span>與Ta聯繫</span></a>--}}
{{--        </li>--}}
    </ul>
</div>
