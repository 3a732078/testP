@extends('layouts.teacher.main')
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

        <button type="button" onclick="location.href = '{{route('teacher.courses.notices',[$course_id])}}'"class="btn btn-sm btn-outline-secondary">公告區</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-primary">教材區</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.BN',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">瀏覽筆記</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>

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
                    onclick="location.href = '{{route('teacher.office.courses.text_materials',[$course_id,])}}'"
                    class="btn btn-success  " style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-right"></i> 辦公室  </button>
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
                        教材列表
                    </div>

                    {{-- body --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                @if( $textbooks -> count() > 0)
                                    {{-- head --}}
                                    <thead>
                                    <tr>
                                        <th>課程</th>
                                        <th>上傳時間</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($textbooks as $textbook)
                                        <tr>
                                            <td >
                                                {{$textbook -> name}}
                                            </td>
                                            <td>
                                                {{$textbook -> created_at}}
                                            </td>
                                            <td width="100" align="center">
                                                <button class="btn btn-outline-dark btn-sm"
                                                        type="submit"
                                                        onclick="location.href = '{{route('teacher.courses.text_materials.show',[$course_id,$textbook -> id])}}'"
                                                >
                                                    檢視
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h1>尚未上傳教材</h1>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div
@endsection

