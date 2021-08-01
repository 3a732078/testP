@extends('layouts.teacher.office.main')
{{--@section('header_name')--}}
{{--    --}}{{-- 直接寫入 --}}
{{--    #--}}
{{--@endsection--}}

{{-- Title --}}
@section('title')
    Elearning
@endsection


{{-- TopBar left--}}
@section('header_item')
    <div style="margin-right: 15px">

        <h3>{{$course -> name}}</h3>

    </div>

    <div>

        <button type="button" onclick="location.href = '{{route('teacher.office.courses.notices',[$course_id])}}'"class="btn btn-sm btn-primary">公告區</button>
        <button type="button" onclick="location.href = '{{route('teacher.office.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>
        <button type="button" onclick="location.href = '{{route('teacher.office.courses.BN',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">瀏覽筆記</button>
        <button type="button" onclick="location.href = '{{route('teacher.office.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>

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
                    onclick="location.href='{{route('teacher.notice.show',[$course_id,$notice -> id])}}'" style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="row "style="margin-top: 50px;margin-left: 50px;">

        <div class="col-auto">
            <div class="card border-4 mb-3 "style="width: 1000px;" >
                {{-- Header--}}
                <div class="card-header bg-gray-200 border-bottom-warning card bg-primary " style="background-color: #0f7ef1">

                    <div class="row">
                        <div class="col-4">
                            <h5>
                                文章內容
                            </h5>
                        </div>

                        <div class="col-4"></div>

                        <div class="col-2">
                            <button type="button"
                                    onclick="location.href = '{{route('teacher.office.notice.edit',[$course_id,$notice->id])}}'"
                                    class="btn btn-outline-primary ;"
                            >
                                修改
                            </button>
                        </div>

                        <div class="col-2">
                            <form method="post"
                                  action="{{route('teacher.office.notice.destory',[$course_id,$notice-> id])}}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        onclick="prink_delete_check()"
                                        class="btn btn-danger  "
                                >
                                    刪除
                                </button>
                            </form>
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
        </div>

        {{-- === col --}}
        <div class="col-auto">
            <button class="btn-lg btn-success"
                    onclick="location.href = '{{route('teacher.office.notice.create',[$course_id,])}}'"
                {{--                style="margin-top: -1500px; margin-left: 1050px"--}}
            >
                新增公告
            </button>
        </div>

    </div>





@endsection

