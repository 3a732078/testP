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
@section('hearder_item')
    {{-- !先選擇年度   --}}
@endsection

{{-- search --}}
@section('search')
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-3">
            <input type="text" placeholder="搜尋.." name="searchs" style="outline: none;width: 330px;height: 42px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
@endsection

{{-- 頁面提示 --}}
@section('header_text')
    <h3 style="margin-left: 20px">
        您好!正處於【教室】環境
    </h3>
@endsection

{{-- 課程列表 --}}
@section('side_courses')
    <h5 class="collapse-header">課程列表:</h5>
    @foreach($years as $year)
    <select class="form-select" aria-label="Default select example" onchange="self.location.href=options[selectedIndex].value">
        <option value="{{route('teacher.course',$year)}}"><h6>{{$year}}學年度</h6></option>
        @foreach($courses as $course)
            <option value="{{$course -> id}}/index">
                <h5>
                    <a href="#">
                        {{$course -> name}} ({{$course -> classroom}})
                    </a>
                </h5>
            </option>
        @endforeach
    </select>
    </a>
    @endforeach
@endsection

{{-- Content --}}
@section('content')

@endsection

