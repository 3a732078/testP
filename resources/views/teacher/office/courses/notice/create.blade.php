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
                        <option value="{{route('teacher.year.index',[$year,2])}}">
                            <h6>
                                {{$year}}學年度【下學期】
                            </h6>
                        </option>

                        <option value="{{route('teacher.year.index',[$year,1])}}">
                            <h6>
                                {{$year}}學年度【上學期】
                            </h6>
                        </option>
                    @endforeach
                </select>
            </h1>
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
                                        <a href="{{route('teacher.office.courses.notices',$course -> id)}}" role="tab"  aria-selected="false">
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

    <div class="card border-info mb-3 " style="width: 1000px;margin-top: 50px;margin-left: 50px;">

        <form class="form-group" method="post" action="{{route('teacher.office.notice.store',[$course_id,])}}">
            @csrf
            {{-- Header--}}
            <div class="card-header bg-gray-200 border-bottom-info card " style="background-color: #0f7ef1">
                <div class="row" style="width: auto" >
                    <div class="col-6">
                        <h5>
                            @php
                                $course = \App\Models\Course::find($course_id);
                            @endphp
                            {{$course -> name}} 【{{$course -> classroom}}】
                        </h5>
                    </div>

                    <div class="col-4">
                        <h5>
                            新增公告
                        </h5>
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
            <div class="card-body text-lg-left text-info">

                <form>

                    <div class="form-group">
                        <label for="notice_title">
                            <b>標題</b>
                        </label>
                        <input type="text" class="form-control"
                               name="notice_title"
                               id="notice_title"
                               placeholder="請在這裡輸入標題">
                    </div>

                    <div class="form-group">
                        <label for="notice_content">
                           <b> 內容</b>
                        </label>
                        <textarea class="form-control"
                                  name="notice_content"
                                  id="notice_content" rows="6"
                                  placeholder="請在這裡輸入內容"
                        ></textarea>

                    </div>
                </form>
            </div>
        </form>
    </div>
@endsection

