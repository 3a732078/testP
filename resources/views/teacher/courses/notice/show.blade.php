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

    <div style="margin-right: 15px">
        <h3>{{$course -> name}}</h3>
    </div>

    <div>
        <button type="button" onclick="location.href = '{{route('teacher.courses.notices',[$course_id])}}'"class="btn btn-sm btn-primary">公告區</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.BN',[$course_id,0])}}'" class="btn btn-sm btn-outline-secondary">瀏覽筆記</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
    </div>

@endsection

@section('courses_function')
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

    <div id="layoutSidenav_content">
        <main>
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif
                <div class="card mb-4" style="margin-top:10px">
                    {{-- Header --}}
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        公告發佈者：
                        @if($notice->teacher_id==null)
                            {{\App\Models\Student::where('id',$notice->ta_id)-> first()->user()->value('name')}}
                        @elseif($notice->ta_id==null)
                            {{\App\Models\Teacher::where('id',$notice->teacher_id)-> first()->user()->value('name')}}
                        @endif
                    </div>

                    {{-- Body --}}
                    <div class="card-body">
                        <div class="form-group width">
                            <h5 class="card-title">
                                <span style="color:#4682B4;background-image: linear-gradient(transparent 50%, rgb(255, 229, 180) 50%)">
                                    <b>標題</b>
                                </span>：{{$notice->title}}
                            </h5>
                        </div>
                        <hr class="sidebar-divider"><br>
                        <div class="form-group width" style="margin-top:-30px">
                            <div>
                                <h5 class="card-title">
                                    <span style="color:#4682B4;background-image: linear-gradient(transparent 50%, rgb(255, 229, 180) 50%)">
                                        <b>內容</b>
                                    </span>：
                                    {{$notice->content}}
                                </h5>
                            </div>
                        </div>
                    </div>

                </div>
                {{--                <a class="btn btn-outline-dark btn-sm" style="width:200px;height:30px;" href="{{route('classes.index')}}" >返回公告列表</a>--}}
            </div>
        </main>
    </div>

@endsection

