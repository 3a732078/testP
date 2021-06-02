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
                    onclick="location.href='{{route('teacher.courses.notices',[$course_id,])}}'"
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
                        聯絡TA
                    </h3>
                </div>

                <div class="col-4">

                    姓名: {{$TA -> student() -> first() -> user() -> first() -> name}}

                </div>

                <div class="col-4">
                    <h4>
                        <form action="">
                            <input type="text" name="text" id="text">
                        </form>
                    </h4>
                </div>

            </div>
        </div>

        {{-- body --}}
        <div class="card-body text-success">


        </div>

    </div>

@endsection

