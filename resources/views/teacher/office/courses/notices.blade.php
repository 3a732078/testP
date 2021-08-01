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
                    onclick="location.href='{{route('teacher.courses.notices',[$course_id,])}}'"
                    style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
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
            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">

                    {{-- header --}}
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        公告
                    </div>

                    {{-- body --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

                                {{-- head --}}
                                <thead>
                                <tr>
                                    <th>標題</th>
                                    <th>發佈者</th>
                                    <th width="100" align="center">
                                        <button type="button"
                                                class="btn btn-outline-success btn-sm"
                                                style="margin-left: 15px"
                                                onclick="location.href='{{route('teacher.office.notice.create',[$course_id,])}}'"
                                        >
                                            新增
                                        </button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($notices as $notice)
                                    <form  method="POST" role="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}

                                        <tr>
                                            <td >
                                                {{$notice -> title}}
                                            </td>
                                            <td>
                                                @if($notice->teacher_id==null)
                                                    {{\App\Models\Student::where('id',$notice->ta_id)-> first()->user()->value('name')}}
                                                @elseif($notice->ta_id==null)
                                                    {{\App\Models\Teacher::where('id',$notice->teacher_id)-> first()->user()->value('name')}}
                                                @endif
                                            </td>
                                            <td width="100" align="center">
                                                {{-- 檢視 --}}
                                                <form action="{{route('teacher.office.notice.show',[$course -> id,$notice -> id])}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <a class="btn btn-outline-dark btn-sm"
                                                       href="{{route('teacher.office.notice.show',[$course -> id,$notice -> id])}}" >檢視公告
                                                    </a>
                                                </form>

                                                {{-- 刪除 --}}
                                                <form method="post"
                                                      action="{{route('teacher.office.notice.destory',[$course_id,$notice-> id])}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm "
                                                    >
                                                        刪除
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection

