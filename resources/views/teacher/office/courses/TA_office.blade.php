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
            <h1>
                <select class="form-select" aria-label="Default select example" onchange="self.location.href=options[selectedIndex].value">
                    <option >
                        <h6>
                            選擇年度
                        </h6>
                    </option>
                    @foreach($years as $year)
                        {{-- 下學期 --}}
                        <option value="{{route('teacher.year.index',[$year,2])}}">
                            <h6>
                                {{$year}}學年度
                            </h6>
                        </option>
                        {{-- 上學期 --}}
                        <option value="{{route('teacher.year.index',[$year,1])}}">
                            <h6>
                                {{$year}}學年度
                            </h6>
                        </option>
                    @endforeach
                </select>
            </h1>
        </div>

        <div class="col-sm-8">
            <button type="button" onclick="location.href = 'courses'" class="btn btn-sm btn-outline-secondary">公告區</button>
            <button type="button" onclick="location.href = 'text_materials'" class="btn btn-sm btn-outline-secondary">教材區</button>
            <button type="button" onclick="location.href = 'home_works'" class="btn btn-sm btn-outline-secondary">評量區</button>
            <button type="button" onclick="location.href = 'TA_office'" class="btn btn-sm btn-primary">TA相關事務</button>
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
                                        <a href="{{route('teacher.courses.TA_office',$course -> id)}}">
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
                    onclick="location.href='{{route('teacher.courses.TA_office',[$course_id,])}}'"
                    style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')
    <div class="card border-success mb-3 " style="width: 1000px;margin-top: 50px;margin-left: 50px;">
        {{-- Header--}}
        <div class="card-header bg-transparent border-success card bg-primary " style="background-color: #0f7ef1">
            <div class="row jumbotron-fluid">
                <div class="col-4">
                    <h3>
                        TA相關事務
                    </h3>
                </div>

                <div class="col-4"></div>

                <div class="col-4">
                    <h4>
                        {{$course ->name}} 【{{$course -> classroom}}】
                    </h4>
                </div>

            </div>
        </div>

        {{-- body --}}
        <div class="card-body text-success">
            @if(isset($TA) )

                <div class="row">
                    <div class="col-4">
                        <h2>
                            {{$TA -> student() -> first() -> user() -> first() -> name}}
                        </h2>
                    </div>

                    <div class="col-4">

                    </div>

                    <div class="col-4">
                        <button type="button"
                                onclick="location.href = '{{route('teacher.office.courses.TA_office.message',[$course_id,$TA -> id])}}'"
                                class="btn btn-light">
                            聯絡
                        </button>

                    </div>

                </div>
            @else
                <div class="row">
                    <div class="col-4">
                        <h2>
                            尚未在這堂課設定TA
                        </h2>
                    </div>

                    <div class="col-4">

                    </div>

                    <div class="col-4">
                        <button type="button"
                                onclick="location.href = '{{route('teacher.office.courses.TA_office.create',[$course_id])}}'"
                                class="btn btn-primary">
                            設定TA
                        </button>
                    </div>

                </div>
            @endif

        </div>

    </div>

@endsection

