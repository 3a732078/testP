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
                    onclick="location.href='{{route('teacher.notice.show',[$course_id,$notice -> id])}}'" style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="card border-success mb-3 " style="width: 1000px;margin-top: 50px;margin-left: 50px;">

        <form class="form-group" method="post" action="{{route('teacher.office.notice.update',[$course_id,$notice -> id])}}">
            @csrf
            @method('put')
            {{-- Header--}}
            <div class="card-header bg-gray-200 border-success card bg-primary " style="background-color: #0f7ef1">
                <div class="row" style="width: auto" >
                    <div class="col-10">
                        <h3>
                            文章內容
                        </h3>
                    </div>
                    <div class="col-2">

                            <button type="submit"
                                    onclick="prink_check()"
                                    class="btn btn-success ;">
                                完成
                            </button>
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

                        <td>
                            {{-- 標題 ================ 【on edit】--}}
                            <input type="text" name="title" value="{{$notice -> title}}">
                        </td>
                    </tr>

                    <tr style="height: 200px">
                        <th >
                            {{-- 內容 --}}
                            內容:
                        </th>
                        <td class="card bg-light w-auto h-auto" >
                            {{-- 內容  ================ 【on edit】 --}}
                            <textarea name="notice_content" id="notice_content" cols="100" rows="10" >{{$notice -> content}}</textarea>

                        </td>

                    </tr>


                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection

