@extends('layouts.teacher.main')
{{--@section('header_name')--}}
{{--    --}}{{-- 直接寫入 --}}
{{--    #--}}
{{--@endsection--}}

{{-- Title --}}
@section('title')
    Elearning
@endsection

{{-- TopBar Courses--}}
@section('courses_list')
    <table style="display: block;overflow-x: auto;white-space: nowrap ">
        @if ( count($courses) > 0)
            @foreach($courses as $course)
                <a class="collapse-item" href="/classes/{{ $course->id }}" >{{$course -> name}}</a>
            @endforeach
        @endif
    </table>
@endsection

{{-- message--}}
@section('message')
    {{--    <!-- 通知 -->--}}
    {{--    <li class="nav-item dropdown no-arrow mx-1">--}}
    {{--        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"--}}
    {{--           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--            <i class="fas fa-bell fa-fw"></i>--}}
    {{--            <!-- Counter - Alerts -->--}}
    {{--            <span class="badge badge-danger badge-counter">3+</span>--}}
    {{--        </a>--}}
    {{--        <!-- Dropdown - Alerts -->--}}
    {{--        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"--}}
    {{--             aria-labelledby="alertsDropdown">--}}
    {{--            <h6 class="dropdown-header">--}}
    {{--                Alerts Center--}}
    {{--            </h6>--}}
    {{--            <a class="dropdown-item d-flex align-items-center" href="#">--}}
    {{--                <div class="mr-3">--}}
    {{--                    <div class="icon-circle bg-primary">--}}
    {{--                        <i class="fas fa-file-alt text-white"></i>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div>--}}
    {{--                    <div class="small text-gray-500">December 12, 2019</div>--}}
    {{--                    <span class="font-weight-bold">A new monthly report is ready to download!</span>--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--            <a class="dropdown-item d-flex align-items-center" href="#">--}}
    {{--                <div class="mr-3">--}}
    {{--                    <div class="icon-circle bg-success">--}}
    {{--                        <i class="fas fa-donate text-white"></i>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div>--}}
    {{--                    <div class="small text-gray-500">December 7, 2019</div>--}}
    {{--                    $290.29 has been deposited into your account!--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--            <a class="dropdown-item d-flex align-items-center" href="#">--}}
    {{--                <div class="mr-3">--}}
    {{--                    <div class="icon-circle bg-warning">--}}
    {{--                        <i class="fas fa-exclamation-triangle text-white"></i>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div>--}}
    {{--                    <div class="small text-gray-500">December 2, 2019</div>--}}
    {{--                    Spending Alert: We've noticed unusually high spending for your account.--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>--}}
    {{--        </div>--}}
    {{--    </li>--}}

    {{--    <!-- Messages -->--}}
    {{--    <li class="nav-item dropdown no-arrow mx-1">--}}
    {{--        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"--}}
    {{--           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--            <i class="fas fa-envelope fa-fw"></i>--}}
    {{--            <!-- Counter - Messages -->--}}
    {{--            <span class="badge badge-danger badge-counter">7</span>--}}
    {{--        </a>--}}
    {{--        <!-- Dropdown - Messages -->--}}
    {{--        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"--}}
    {{--             aria-labelledby="messagesDropdown">--}}
    {{--            <h6 class="dropdown-header">--}}
    {{--                Message Center--}}
    {{--            </h6>--}}
    {{--            <a class="dropdown-item d-flex align-items-center" href="#">--}}
    {{--                <div class="dropdown-list-image mr-3">--}}
    {{--                    <img class="rounded-circle" src="{{asset('/home/img/undraw_profile_1.svg')}}"--}}
    {{--                         alt="">--}}
    {{--                    <div class="status-indicator bg-success"></div>--}}
    {{--                </div>--}}
    {{--                <div class="font-weight-bold">--}}
    {{--                    <div class="text-truncate">Hi there! I am wondering if you can help me with a--}}
    {{--                        problem I've been having.</div>--}}
    {{--                    <div class="small text-gray-500">統計ta· 時間</div>--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--            <a class="dropdown-item d-flex align-items-center" href="#">--}}
    {{--                <div class="dropdown-list-image mr-3">--}}
    {{--                    <img class="rounded-circle" src="{{asset('/home/img/undraw_profile_2.svg')}}"--}}
    {{--                         alt="">--}}
    {{--                    <div class="status-indicator"></div>--}}
    {{--                </div>--}}
    {{--                <div>--}}
    {{--                    <div class="text-truncate">I have the photos that you ordered last month, how--}}
    {{--                        would you like them sent to you?</div>--}}
    {{--                    <div class="small text-gray-500">CRMta · 時間</div>--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--            <a class="dropdown-item d-flex align-items-center" href="#">--}}
    {{--                <div class="dropdown-list-image mr-3">--}}
    {{--                    <img class="rounded-circle" src="{{asset('/home/img/undraw_profile_3.svg')}}"--}}
    {{--                         alt="">--}}
    {{--                    <div class="status-indicator bg-warning"></div>--}}
    {{--                </div>--}}
    {{--                <div>--}}
    {{--                    <div class="text-truncate">Last month's report looks great, I am very happy with--}}
    {{--                        the progress so far, keep up the good work!</div>--}}
    {{--                    <div class="small text-gray-500">會計學ta · 2d</div>--}}
    {{--                </div>--}}
    {{--            </a>--}}
    {{--            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>--}}
    {{--        </div>--}}
    {{--    </li>--}}
@endsection

{{-- Content --}}
@section('content')

@endsection

