<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-gray-200 topbar  static-top shadow">

    <!-- Sidebar Toggle (Topbar) 那個縮排用的 icon -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-1">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
@yield('search')

@yield('header_item')

    {{-- 年度列表--}}
    <div class="row row-cols-2 card-header bg-transparent " style=" width: 650px;height: auto;margin-top: 50px;" >
        <div class="col-sm-4">
            @php
                if (!isset($course_id) ){
                    $year_semester = "";
                }
            @endphp
            <h5>
                {{$year_semester}}
            </h5>
        </div>

        <div class="col-sm-8">

            @yield('courses_function')
        </div>

        {{-- 第二列 --}}
        <div class="col-sm-12">
            {{-- 快速跳轉課程列表--}}
        </div>
    </div>

{{--    --}}
{{--    <ul class="nav nav-tabs">--}}

{{--        <li class="nav-item ">--}}
{{--            <a class="nav-link active " aria-current="page" href='index'>最新消息</a>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href='problem'>常見問題</a>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link "  href= 'behave'>校園行事曆</a>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href= 'system_suggest'>系統建議</a>--}}
{{--        </li>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href= '/textbooks'>管理教材</a>--}}
{{--        </li>--}}
{{--        --}}{{--        <li class="nav-item">--}}
{{--        --}}{{--            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
{{--        --}}{{--        </li>--}}
{{--    </ul>--}}


    <!-- Topbar Navbar -->
    <ul class="navbar-right ml-auto nav nav-tabs ">

    @yield('header_text')

    @include('layouts.teacher.message')

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
