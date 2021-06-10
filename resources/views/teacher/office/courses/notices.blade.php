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
                    onclick="location.href='{{route('teacher.courses.notices',[$course_id,])}}'"
                    style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="card border-success mb-3 " style="width: 1000px;margin-top: 50px;margin-left: 50px;">
        {{-- Header--}}
        @php
            $course = \App\Models\Course::find($course_id);
        @endphp
        <div class="card-header bg-transparent border-success card bg-primary " style="background-color: #0f7ef1">
            <div class="row">
                <div class="col-8">
                    <h3>
                        {{$course ->name}} 【{{$course -> classroom}}】
                    </h3>
                </div>


                <div class="col-4">
                    <h3>
                        公告列表
                    </h3>
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
                    <th scope="col">編號</th>
                    <th scope="col">標題</th>
                    <th scope="col">發布者</th>
                    <th scope="col">
                        <button type="button"
                                class="btn btn-success "
                                onclick="location.href='{{route('teacher.office.notice.create',[$course_id,])}}'"
                        >
                            新增
                        </button>
                    </th>
                </tr>
                </thead>

                {{-- body --}}
                <tbody>
                    @if($notices -> count() != 0)

                        @foreach($notices as $notice)
                        <tr>
                            <th scope="row">{{$notice -> id}}</th>
                            <td> <h5>{{$notice -> title}}</h5></td>

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

                            {{-- 功能按鈕 --}}
                            <td>
                                <button type="button" class="btn btn-outline-primary "
                                        onclick="location.href='{{route('teacher.office.notice.show',[$course_id,$notice-> id])}}'"
                                >
                                    檢視
                                </button>

                                <form method="post"
                                      action="{{route('teacher.office.notice.destory',[$course_id,$notice-> id])}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger  "
                                    >
                                        刪除
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <th colspan="4">
                                尚未有任何有公告歐~~~~~
                            </th>
                        </tr>
                    @endif
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

