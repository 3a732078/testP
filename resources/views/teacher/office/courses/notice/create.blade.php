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
                    onclick="location.href='{{route('teacher.office.courses.notices',[$course_id,])}}'" style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="card border-success mb-3 " style="width: 1000px;margin-top: 50px;margin-left: 50px;">

        <form class="form-group" method="post" action="{{route('teacher.office.notice.store',[$course_id,])}}">
            @csrf
            {{-- Header--}}
            <div class="card-header bg-gray-200 border-success card bg-primary " style="background-color: #0f7ef1">
                <div class="row" style="width: auto" >
                    <div class="col-10">
                        <h3>
                            @php
                                $course = \App\Models\Course::find($course_id);
                            @endphp
                            {{$course -> name}} 【{{$course -> classroom}}】
                        </h3>
                    </div>
                    <div class="col-2">

                        <button type="submit"
                                onclick=""
                                class="btn btn-success ;">
                            完成
                        </button>
                    </div>
                </div>
            </div>

            {{-- body --}}
            <div class="card-body text-success">

                <form>

                    <div class="form-group">
                        <label for="notice_title">標題</label>
                        <input type="text" class="form-control"
                               name="notice_title"
                               id="notice_title" placeholder="很強的標題">
                    </div>

                    <div class="form-group">
                        <label for="notice_content">內容</label>
                        <textarea class="form-control"
                                  name="notice_content"
                                  placeholder="很強的內容"
                                  id="notice_content" rows="6"></textarea>
                    </div>
                </form>
            </div>
        </form>
    </div>
@endsection
