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
                正處於【教室】環境
            </h6>
        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">
            <button type="button"
                    class="btn btn-success  "
                    onclick="location.href='{{route('teacher.office.notice.show',[$course_id,$notice -> id])}}'" style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-right"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="card border-success mb-3 " style="width: 1000px;margin-top: 50px;margin-left: 50px;">
        {{-- Header--}}
        <div class="card-header bg-gray-200 border-success card bg-primary " style="background-color: #0f7ef1">
             <div class="row">

                 <div class="col-4">
                     <h5>
                         文章內容
                     </h5>
                 </div>

                 <div class="col-4"></div>

                 <div class="col-4">
                     <h5>
                         {{$course -> name}}】【{{$course -> classroom }}
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
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>

                {{-- body --}}
                <tbody>

                    <tr>
                        <th scope="row" style="width: 200px;height: 10px">版名: </th>

                        <td> 課程公告留言板 </td>
                    </tr>

                    <tr>
                        <th scope="row" style="width: 200px;height: 10px">張貼者: </th>

                        {{-- 發布者 --}}
                        <td>
                            @if($notice -> teacher_id != null)
                                老師
                            @elseif($notice -> ta_id != null)
                                TA
                            @else
                                管理者
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row" style="width: 200px;height: 10px">張貼時間: </th>

                        <td> {{$notice -> created_at}} </td>
                    </tr>

                    <tr>
                        <th scope="row" style="width: 200px;height: 10px">標題: </th>

                        <td> {{$notice -> title}} </td>
                    </tr>

                    <tr style="height: 200px">
                        <th >
                            {{-- 內容 --}}
                            內容:
                        </th>
                        <td class="card bg-light w-auto h-auto" >
                            {{-- 內容 --}}
                            {{$notice -> content}}
                        </td>

                    </tr>


                </tbody>
            </table>
        </div>
    </div>
@endsection

