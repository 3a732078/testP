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
            <button type="button" onclick="location.href = '{{route('teacher.office.courses.notices',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">公告區</button>
            <button type="button" onclick="location.href = '{{route('teacher.office.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-primary">教材區</button>
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
                                        <a href="{{route('teacher.office.courses.TA_office',$course -> id)}}">
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

    <div class="row" style="margin-top:50px;margin-left: 50px;width: auto ; height: 1000px">

        <div class="col-auto">

            <div class="card border-left-warning mb-3" style="width: 1000px;height: auto">

                {{--Header --}}
                <div class="card-header bg-gray-700 border-success">
                    <h4 style="color: #dae0e5 ">
                        @php
                            $course = \App\Models\Course::find($course_id);
                        @endphp
                        {{$course -> name}}【{{$course -> classroom}}】
                    </h4>
                </div>

                {{-- Body --}}
                <div class="card-body text-success bg-gray-200" style="height: 300px">
                    @php
                        $text_materials = \App\Models\Course::find($course_id)
                            ->textbooks()->get();
                    @endphp

                    @if(count($text_materials) == 0)

                        <h5>
                            尚未放入任何教材
                        </h5>

                    @else

                        <table class="table">

                            {{-- head --}}
                            <thead>
                                <tr>
                                    <th scope="col">名稱</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            {{-- Body --}}
                            <tbody>
                                @foreach($text_materials as $text_material)
                                    <tr>

                                        <th colspan="2" scope="row">{{$text_material -> name}}</th>

                                        <td colspan="2">

                                            <form method="post" action="teacher.office.text_materials.delete">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-danger"
                                                >
                                                    刪除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    @endif

                </div>

                {{-- footer --}}
                <div class="card-footer bg-gray-200 border-success">

                    {{-- 放入教材 --}}
                    <form action="{{route('teacher.office.courses.text_materials.store',[$course_id,])}}"
                          method="post"
                    >
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto">
                                    {{-- input --}}
                                    <label for="text_material">放入新的教材</label>
                                    <input type="file"
                                           name="toimage"
                                           class="form-control-file" id="text_material">

                                </div>

                                <div class="col-auto">
                                    <button type="submit"
                                            class="btn btn-primary"
                                    >
                                        送出
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>


                </div>
                {{-- end footer --}}

            </div>

        </div>
    </div>

@endsection

