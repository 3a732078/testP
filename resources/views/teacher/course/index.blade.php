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
@section('header_item')
    {{--        @php--}}
    {{--            $courses = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get();--}}
    {{--            $datas = array();--}}
    {{--            foreach ($courses as $course){--}}
    {{--                $$datas[$course -> id] = $course -> where('year','=',110);--}}
    {{--            }--}}
    {{--        @endphp--}}

    @php
        $courses = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get();
    @endphp
    @if ( count($courses) > 0)
        @foreach($courses as $course)

            <ul>
                <li>
                    <a class="collapse-item" href='{{ $course->id }}/index' >
                                <span >
                                    {{$course -> name}}
                                </span>
                    </a>
                </li>
            </ul>
        @endforeach
    @endif
@endsection

{{-- !選擇年度 --}}
@section('year')

    @php
        $courses = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get();

        $years = array();
        foreach ($courses as $course){
            $years[$course -> id] = $course -> year;
        }
        rsort($years);
        $datas = array();
        $year_flag = 10;
        $i = 1;
        foreach ($years as $year){
            if ($year_flag != $year){
                $datas[$i] = $year;
            }
            $year_flag = $year;
            $i ++;
        }
        foreach ($datas as $data){
            echo "<a class= 'collapse-item' href='index/$data'>$data </a>";

        }
    @endphp

@endsection

{{-- Content --}}
@section('content')
    <!-- =======  Section course title======= -->
    <section id="course_title" class="cousrse notion-bg">
        <div class="container">

            <div class="row">

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <h1>
                        110學年度上學期
                    </h1>
                </div>

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <h1>
                        {{$course -> name}}
                    </h1>
                </div>

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/clients/client-3.png')}}" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section>
    <!-- End Title Section -->

    <!-- ======= Content Section ======= -->
    <section id="course_content" class="course notice_bg">
        <div class="container">
            <div class="row">
                {{--   contant                 --}}
                    <div class="table-responsive">


                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>標題</th>
                                <th>發佈者</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($notices as $notice)
                                <tr>
                                    <td >
                                        {{$notice -> title}}
                                    </td>
                                    <td>
                                        $user ->name
                                    </td>
                                    <td width="100" align="center">
                                        <input type="button"
                                               class="btn btn-outline-dark btn-sm"
                                               onclick="location.href = '{{$notice->id}}'"
                                               value="檢視公告"
                                        />

                                        <form action="{{$selected -> id}}/{{$notice -> id}}"
                                              method="post"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                    type="submit"
                                            >
                                                刪除
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>


                    </div>
                

            </div>

        </div>
    </section>
    <!-- End Course Section -->

@endsection

