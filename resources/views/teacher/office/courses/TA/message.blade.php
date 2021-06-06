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
            <button type="button" onclick="location.href = '{{route('teacher.courses.notices',[$course_id])}}'" class="btn btn-sm btn-primary">公告區</button>
            <button type="button" onclick="location.href = '{{route('teacher.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>
            <button type="button" onclick="location.href = '{{route('teacher.courses.home_works',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">評量區</button>
            <button type="button" onclick="location.href = '{{route('teacher.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
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
                    onclick="location.href='{{route('teacher.TA.message',[$course_id,$TA -> id])}}'" style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
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
                        {{$TA -> student() -> first() -> user() -> first() -> name}}
                    </h4>
                </div>

                {{-- Body --}}
                <div class="card-body text-success" style="height: 300px">


                </div>

                {{-- footer --}}
                <div class="card-footer bg-transparent border-success">
                    <form action="{{route('teacher.office.TA.message.store',[$course_id,$TA -> id])}}">

                        <div class="row">

                            <div class="col-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">
                                            請輸入訊息
                                        </span>
                                    </div>
                                    <input type="text" class="form-control"
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

