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
                        <option value="{{route('teacher.year.index',$year)}}">
                            <h6>
                                {{$year}}學年度
                            </h6>
                        </option>
                    @endforeach
                </select>
            </h1>
        </div>

        <div class="col-sm-8">
            <button type="button" onclick="location.href = 'courses'" class="btn btn-sm btn-primary">公告區</button>
            <button type="button" onclick="location.href = 'text_materials'" class="btn btn-sm btn-outline-secondary">教材區</button>
            <button type="button" onclick="location.href = 'home_works'" class="btn btn-sm btn-outline-secondary">評量區</button>
            <button type="button" onclick="location.href = 'TA_offices'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
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
                                        <a href="{{route('teacher.courses.notices',$course -> id)}}" role="tab"  aria-selected="false">
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
    <div class="row row-cols-2 " style="margin-top: 10px" >
        <div class="col-sm-12">
            <h6 style="margin-left: 15px">
                正處於【教室】環境
            </h6>
        </div>

        <div class="col-sm-12">
            <button type="button" class="btn btn-success  " style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-right"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="card border-success mb-3 " style="width: 1000px;margin-top: 50px;margin-left: 50px;">
        {{-- Header--}}
        <div class="card-header bg-transparent border-success card bg-primary " style="background-color: #0f7ef1">
            {{$course ->name}}
        </div>

        {{-- body --}}
        <div class="card-body text-success">

            {{-- table --}}
            <table class="table table-striped">
                {{-- head --}}
                <thead>
                <tr>
                    <th scope="col">編號</th>
                    <th scope="col">標題</th>
                    <th scope="col">發布者</th>
                    <th scope="col"></th>
                </tr>
                </thead>

                {{-- body --}}
                <tbody>
                    <tr>
                        <th scope="row">{{$notice -> id}}</th>
                        <td> <h5>{{$notice -> title}}</h5></td>

                        {{-- 發布者 --}}
                        @if($notice -> teacher_id != null)
                            <td>老師</td>
                        @elseif($notice -> ta_id != null)
                            <td>TA</td>
                        @else
                            <td>管理者</td>
                        @endif

                        {{-- 功能按鈕 --}}
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="location.href='{{route('teacher.notice.show',[$course_id,$notice-> id])}}'"
                            >
                                檢視
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- footer--}}
        <div class="card-footer bg-primary border-primary">

            {{-- 先當作頁碼使用吧 --}}
            <button type="button" class="btn btn-outline-warning btn-sm">1</button>

        </div>
    </div>
@endsection

