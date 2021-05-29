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
    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link "  href='index'>最新消息</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href='problem'>常見問題</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href= 'behave'>校園行事曆</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href= 'system_suggest'>系統建議</a>
        </li>
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>--}}
        {{--        </li>--}}
    </ul>
@endsection

{{-- 頁面提示 --}}
@section('header_text')
    <div class="row row-cols-2" >

        <div class="col-sm-6">
        </div>

        <div class="col-6">
            <h6 style="margin-left: 20px">
                正處於【教室】環境
            </h6>
        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">
            <button type="button" class="btn btn-success  " style="padding: 0px 30px 0 30px">  教室 => 辦公室  </button>
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

{{-- Content --}}
@section('content')

@endsection

