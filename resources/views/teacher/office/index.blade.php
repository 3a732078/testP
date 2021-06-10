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
                    class="btn btn-warning btn-sm"
                    onclick="location.href = '{{route('teacher.index',[])}} '"
                    style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection

{{-- search --}}
@section('search')
    {{--    <div class="search-container">--}}
    {{--        <form action="{{route('notes.search')}}" class="ml-md-3">--}}
    {{--            <input type="text" placeholder="搜尋.." name="searchs" style="outline: none;width: 330px;height: 42px;border-radius:20px;padding-left: 20px">--}}
    {{--            <button type="submit" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>--}}
    {{--        </form>--}}
    {{--    </div>--}}
@endsection



{{-- 課程列表 --}}
@section('side_courses')

@endsection

{{-- Content --}}
@section('content')

@endsection

