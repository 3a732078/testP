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
@endsection

@section('courses_function')
    <button type="button" onclick="location.href = '{{route('teacher.office.courses.notices',[$course_id])}}'"class="btn btn-sm btn-primary">公告區</button>
    <button type="button" onclick="location.href = '{{route('teacher.office.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>
    <button type="button" onclick="location.href = '{{route('teacher.office.courses.BN',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">瀏覽筆記</button>
    <button type="button" onclick="location.href = '{{route('teacher.office.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
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
                    <h5>
                        設定TA
                    </h5>
                </div>

                <div class="col-4"></div>

                <div class="col-4">
                    @php
                        $course = \App\Models\Course::find($course_id);
                    @endphp

                    <h5>
                        {{$course ->name}} 【{{$course -> classroom}}】
                    </h5>
                </div>

            </div>
        </div>

        {{-- body --}}
        <div class="card-body text-success">

            {{-- table --}}
            <table class="table table-striped">
                {{-- head --}}
                <thead>
                <tr>
                    <th scope="col">學號</th>
                    <th scope="col">班級</th>
                    <th scope="col">姓名</th>
                    <th scope="col">

                    </th>
                </tr>
                </thead>

                {{-- body --}}
                <tbody>
                @foreach($department_students as $department_student)
                    <tr>
                        <th scope="row">{{$department_student -> user() -> first() -> account}}</th>


                        <td>
                            <h5>{{$department_student -> classroom}}</h5>
                        </td>

                        {{-- 發布者 --}}
                        <td>
                            <h5>
                                {{$department_student -> user() ->first() -> name}}
                            </h5>
                        </td>

                        {{-- 功能按鈕 --}}
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="location.href='{{route('teacher.office.courses.TA_office.store',[
                                        $course_id,$department_student -> id]
                                    )}}'"
                            >
                                設定
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>


        </div>

    </div>

@endsection

