<div id="sidenav">
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('teacher.index')}}">
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
        <li class="nav-item">
            <a href=""
               class="nav-link collapsed"  data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities"
            >
                <i class="fas fa-fw fa-folder-open"></i>
                <span>選擇課程</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar" style="width: 190px">
                <div class="bg-white py-2 collapse-inner rounded">

                    {{--                    抓取列表資料--}}
                    @php
                        $teacher = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id()) -> teacher() -> first() ;
                        $courses = $teacher-> courses() -> get()-> sortbydesc('year') ;
                        $years_unique = $courses -> unique('year');
                    @endphp

{{--                    {{$teacher}}--}}

                    {{-- 顯示課程列表資料 --}}
                    @foreach($years_unique as $year_unique)

                    {{--下學期--}}
                    @if($courses -> where('year' , $year_unique -> year) -> sortByDesc('semester') -> first() -> semester == 2)
                            <h6 class="collapse-header" style="margin-left: -15px">{{$year_unique -> year}}學年度_2 :</h6>
                        @endif
                        @foreach($courses -> sortByDesc('classroom')  as $course)
                            @if($year_unique -> year == $course -> year && $course -> semester == 2)
                                <h5>
                                    <a class="collapse-item" href="/teacher/{{$course -> id}}/courses" style="font-size: 14px"
                                    >
                                        <div class="row row-cols-2">
{{--                                            第一列--}}
                                            <div class="col-12">
                                                {{$course -> name}} ({{$course -> classroom}})

                                            </div>

{{--                                            第二列 排版--}}
                                            <div class="col-6">                                            </div>

                                            <div class="col-6">
                                            </div>
                                        </div>
                                    </a>
                                </h5>
                            @endif
                        @endforeach

{{--                         上學期--}}
                        <h6 class="collapse-header" style="margin-left: -15px">{{$year_unique -> year}}學年度_1 :</h6>
                        @foreach($courses -> sortByDesc('classroom')  as $course)
                            @if($year_unique -> year == $course -> year && $course -> semester == 1)
                                <h5>
                                    <a class="collapse-item" href="/teacher/{{$course -> id}}/courses" style="font-size: 14px">
                                        <div class="row row-cols-2">
{{--                                            第一列--}}
                                            <div class="col-12">
                                                {{$course -> name}} ({{$course -> classroom}})

                                            </div>

{{--                                            第二列 排版--}}
                                            <div class="col-6">                                            </div>

                                            <div class="col-6">
                                            </div>
                                        </div>
                                    </a>
                                </h5>
                            @endif
                        @endforeach

                    @endforeach

                    @yield('side_courses')
                </div>
            </div>
        </li>

        <!-- 其他列表暫不使用 -->
        @include('layouts.teacher.side_nav_item')

        <!-- Divider -->
        <hr class="sidebar-divider">

{{--        <!-- Heading -->--}}
{{--        <div class="sidebar-heading">--}}
{{--            Message--}}
{{--        </div>--}}

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href= "teacher/{{$course -> id}}/ta">--}}
{{--                <i class="fas fa-fw fa-comment"></i>--}}
{{--                <span>與Ta聯繫</span></a>--}}
{{--        </li>--}}
    </ul>
</div>
