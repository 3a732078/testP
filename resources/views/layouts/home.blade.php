<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elearning</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('/home/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('/home/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
@if(\Illuminate\Support\Facades\Auth::user()->type=='學生')

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('students.index')}}">
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
            選擇：
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-book"></i>
                <span>課程</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">已選課程:</h6>
                    @php
                        $student=\App\Models\Student::where('user_id',\Illuminate\Support\Facades\Auth::id())->value('id');
                        $courses = \App\Models\Student::where(
                                'id',$student)-> first() ->courses() -> get();
                    @endphp
                    @if ($courses -> count() > 0)
                        @foreach($courses as $course)
                            <a class="collapse-item" href="/classes/{{ $course->id }}" >{{$course -> name}}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </li>

        @yield('navno')

        @if ( $course = isset($class) ? DB::table('textbooks')->where('course_id',$class)->get() : 0 )
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                課程資訊
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseText"
                   aria-expanded="true" aria-controls="collapseText">
                    <i class="fas fa-fw fa-book"></i>
                    <span>教材</span>
                </a>
                <div id="collapseText" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">上課教材:</h6>
                        @foreach($course as $value)
                            <a class="collapse-item" href="#{{ $value->name }}" data-toggle="collapse" style="color:black;line-height:25px;"><span>{{ $value->name }}</span></a>
                            <div id="{{ $value->name }}" class="collapse">
                                <a class="collapse-item" href="/textbooks/show/{{$value->id}}" style="color:black;line-height:15px;">-&ensp;教材</a>
                                <a class="collapse-item" href="/notes/classes/list/{{$value->id}}" style="color:black;line-height:15px;">-&ensp;教材筆記</a>
                                <hr class="sidebar-divider bg-dark">
                            </div>
                        @endforeach
                        <a class="collapse-item" href="/notes/classes/attach/{{$class}}"
                           style="color:#B22222;line-height:25px;">無分類之筆記
                        </a>
                    </div>
                </div>
            </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>筆記專區</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">筆記相關資訊:</h6>
{{--                    <a class="collapse-item" href="/notes/create">新增筆記</a>--}}
                    <a class="collapse-item" href="#createn" data-toggle="collapse" style="color:black;line-height:15px;"><span>新增筆記</span></a>
                    <div id="createn" class="collapse">
                        <a class="collapse-item" href="/notes/create" style="color:black;line-height:15px;">-&ensp;空白筆記</a>
                        <a class="collapse-item" href="/notes/insert" style="color:black;line-height:15px;">-&ensp;照片筆記</a>
                    </div>
                    <a class="collapse-item" href="{{route('notes.mynotes')}}">筆記列表</a>
                    <a class="collapse-item" href="{{route('notes.search')}}">搜尋筆記</a>
                    <a class="collapse-item" href="{{route('favor.index')}}">收藏庫</a>
                </div>
            </div>
        </li>

        @yield('nav')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            聯繫
        </div>

            @if ( $course = isset($class) ? DB::table('textbooks')->where('course_id',$class)->get() : 0 )
                <li class="nav-item">
                    <a class="nav-link" href="/questions/classes/{{$ta}}">
                        <i class="fas fa-fw fa-comment"></i>
                        <span>與Ta聯繫</span></a>
                </li>
            @endif
        @endif
    </ul>
@endif
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                @yield('search')
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <style>
                    * {box-sizing: border-box;}
                    body {
                        margin: 0;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .topnav {
                        overflow: hidden;
                        background-color: #e9e9e9;
                    }

                    .topnav a {
                        float: left;
                        display: block;
                        color: black;
                        text-align: center;
                        padding: 14px 16px;
                        text-decoration: none;
                        font-size: 17px;
                    }

                    .topnav a:hover {
                        background-color: #ddd;
                        color: black;
                    }

                    .topnav a.active {
                        background-color: #2196F3;
                        color: white;
                    }

                    .topnav .search-container {
                        float: right;
                    }

                    .topnav input[type=text] {
                        padding: 6px;
                        margin-top: 8px;
                        font-size: 17px;
                        border: none;
                    }

                    .topnav .search-container button {
                        float: right;
                        padding: 6px 10px;
                        margin-top: 8px;
                        margin-right: 16px;
                        background: #ddd;
                        font-size: 17px;
                        border: none;
                        cursor: pointer;
                    }

                    .topnav .search-container button:hover {
                        background: #ccc;
                    }

                    @media screen and (max-width: 600px) {
                        .topnav .search-container {
                            float: none;
                        }
                        .topnav a, .topnav input[type=text], .topnav .search-container button {
                            float: none;
                            display: block;
                            text-align: left;
                            width: 100%;
                            margin: 0;
                            padding: 14px;
                        }
                        .topnav input[type=text] {
                            border: 1px solid #ccc;
                        }
                    }
                </style>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- 通知 -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{asset('/home/img/undraw_profile_1.svg')}}"
                                         alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                        problem I've been having.</div>
                                    <div class="small text-gray-500">統計ta· 時間</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{asset('/home/img/undraw_profile_2.svg')}}"
                                         alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how
                                        would you like them sent to you?</div>
                                    <div class="small text-gray-500">CRMta · 時間</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{asset('/home/img/undraw_profile_3.svg')}}"
                                         alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with
                                        the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">會計學ta · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

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
                            @if(\Illuminate\Support\Facades\Auth::user()->type=='學生')
                                @php
                                    $id=\Illuminate\Support\Facades\Auth::id();
                                    $identified=\App\Models\Student::where('user_id',$id)->value('id');
                                    $quantity=\App\Models\Ta::where('student_id',$identified)->get();

                                @endphp
                                @if(count($quantity)>0)
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#tota">
                                        切換為TA
                                    </a>
                                @endif
                            @endif
                        </div>
                    </li>

                </ul>

            </nav>

            @yield('content')
            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('notice')

            </div>
            <!-- End of Main Content -->




        </div>
        <!-- End of Content Wrapper -->
    </div>
</div>
<!-- End of Page Wrapper -->


<!-- Logout-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">登出?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">若確定要登出，請按登出鈕</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                <a class="btn btn-danger" href="{{route('logout')}}">登出</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">確認切換</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">若確定切換為TA，請按切換鈕</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                <a class="btn btn-danger" href="/ta">切換</a>
            </div>
        </div>
    </div>
</div>
<!-- Logout-->

<!-- Bootstrap core JavaScript-->
<script src="{{asset('/home/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/home/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('/home/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
