@extends('layouts.teacher.office.main')
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
    {{-- 年度列表--}}
    <div class="row row-cols-2 card-header bg-transparent " style=" width: 650px;height: auto;margin-top: 50px;" >
        <div class="col-sm-4">
            <h5>
                {{$year_semester}}
            </h5>
        </div>

        <div class="col-sm-8">
            <button type="button" onclick="location.href = '{{route('teacher.office.courses.notices',[$course_id])}}'" class="btn btn-sm btn-primary">公告區</button>
            <button type="button" onclick="location.href = '{{route('teacher.office.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>
            <button type="button" onclick="location.href = '{{route('teacher.office.courses.home_works',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">評量區</button>
            <button type="button" onclick="location.href = '{{route('teacher.office.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
        </div>

        {{-- 第二列 --}}
        <div class="col-sm-12">
            {{-- 快速跳轉課程列表--}}
            <h6>
                <table style="display: block;overflow-x: auto;white-space: nowrap;padding: 0px;">
                    <ul class=" nav nav-tabs" role="tablist">
                        <tr>
                            @foreach($courses_year as $course)
                                @if($course -> id == $course_id)
                                    <td>
                                        {{$course -> name}}【{{$course -> classroom}}】
                                    </td>
                                @else
                                    <td>
                                        <a href="{{route('teacher.office.courses.TA_office',$course -> id)}}" role="tab"  aria-selected="false">
                                            {{$course -> name}}【{{$course -> classroom}}】
                                        </a>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    </ul>

                </table>
            </h6>
        </div>
    </div>

@endsection

{{-- 頁面提示 --}}
@section('header_text')
    <div class="row row-cols-2" >

        <div class="col-sm-6">
        </div>

        <div class="col-6" style="margin-top: 10px;">
            <h6 style="margin-left: 15px">
                正在【辦公室】環境
            </h6>
        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">
            <button type="button"
                    class="btn btn-warning  "
                    onclick="location.href='{{route('teacher.TA.message',[$course_id,$student_TA -> id])}}'" style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="row" style="margin-top:50px;margin-left: 50px;width: auto ; height: 1000px">

        <div class="col-auto">

            <div class="card border-left-warning mb-3" style="width: 1000px;height: auto">

                {{--Header --}}
                <div class="card-header bg-gradient-info border-success">
                    <h4 style="color: #dae0e5 ">
                        {{$student_TA  -> user() -> first() -> name}}
                    </h4>
                </div>

                {{-- Body --}}
                <div class="card-body text-success bg-gray-200" style="height: 500px">

                    @php
                        $user_name = \Illuminate\Support\Facades\Auth::user()->name;
                    @endphp

                    @foreach($messages as $message)
                        @if($message -> sender == "TA")

                        {{-- TA訊息至左 --}}
                        <div class="row">

                            {{--TA圖案--}}
                            <div class="col-1">
                                <i class="fas fa-user-circle">
                                    <p>{{$user_name}}</p>
                                </i>
                            </div>

                            {{--TA訊息--}}
                            <div class="col-7
                                    card card-body"
                                 style="height: auto; width: auto;
                                 background-color: #dae0e5;border-color: #1c1f23 ; color: #1c1f23 ;margin-bottom: 5px">

                                {{$message -> content}}

                                <p style="font-size: 1px" align="right">
                                    {{$message -> created_at}}
                                </p>

                            </div>

                        </div>
                    @else

                        {{-- 老師訊息至右 --}}
                        <div class="row">

                            {{--版面調整--}}
                            <div class="col-4"></div>

                            {{--老師訊息--}}
                            <div class="col-7 card card-body"
                                 style="height: auto; width: 700px;
                                     background-color: #dae0e5;border-color: #1c1f23 ; color: #1c1f23 ; margin-bottom: 5px">

                                {{$message -> content}}

                                <p style="font-size: 1px" align="right">
                                    {{$message -> created_at}}
                                </p>

{{--                                <div class="card card-body bg-transparent row" style="height: min-content">--}}

{{--                                    <div class="col-8">--}}
{{--                                    </div>--}}

{{--                                    <div class="col-auto">--}}
{{--                                        <p>--}}
{{--                                            {{$message -> created_at}}--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>

                            {{--老師圖案--}}
                            <div class="col-1">
                                <i class="fas fa-chalkboard-teacher">
                                    <p>
                                        {{$user_name}}
                                    </p>
                                </i>
                            </div>
                        </div>

                    @endif
                    @endforeach

                </div>

                {{-- footer --}}
                <div class="card-footer bg-gray-200 border-success">
                    <form method="post" action="{{route('teacher.office.TA.message.store',[$course_id,$student_TA -> id])}}">
                        @csrf
                        <div class="row">

                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">
                                            請輸入訊息
                                        </span>
                                    </div>
                                    <input type="text"
                                           class="form-control"
                                           aria-label="Default" aria-describedby="inputGroup-sizing-default"
                                           id="message" name="message"
                                    >
                                </div>
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary ">
                                    送出
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection

