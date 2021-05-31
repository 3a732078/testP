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
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>選擇課程</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    {{--                    抓取列表資料--}}
                    @php
                        $years = array();

                        //=== 抓取該老師所有課程
                        $courses = \App\Models\User::find(
                            \Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get()
                            ->sortbydesc('year');

                        $datas = $courses -> unique('year');
                        // === 寫入資料
                        foreach ( $datas as $course) {
                            $years[$course->id] = $course->year;
                        }

                        //優化list
                        $courses->sortby('department_id');
                    @endphp

                    {{--                    顯示列表資料--}}
                    <h5 class="collapse-header">課程列表:</h5>
                    @foreach($years as $year)
                        <select class="form-select" aria-label="Default select example" onchange="self.location.href=options[selectedIndex].value">
                            <option value="{{route('teacher.year',$year)}}">
                                <h6>
                                    {{$year}}學年度
                                </h6>
                            </option>
                            @foreach($courses as $course)
                                @if( $course -> year == $year )
                                    <option value="{{route('teacher.courses.notices',$course -> id)}}">
                                        <h5>
                                            <a href="teacher/{{$course -> id}}/course">
                                                {{$course -> name}} ({{$course -> classroom}})
                                            </a>
                                        </h5>
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        </a>
                    @endforeach
                    @yield('side_courses')
                </div>
            </div>
        </li>

        <!-- 其他列表暫不使用 -->
        @include('layouts.teacher.side_nav_item')

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Message
        </div>

        <li class="nav-item">
            <a class="nav-link" href= "teacher/{{$course -> id}}/ta">
                <i class="fas fa-fw fa-comment"></i>
                <span>與Ta聯繫</span></a>
        </li>
    </ul>
</div>
