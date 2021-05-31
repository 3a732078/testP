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
<div class="row row-cols-2 card-header bg-transparent " style=" width: 650px;height: auto;" >
    <div class="col-sm-4">
        <h1>
            <select class="form-select" aria-label="Default select example" onchange="self.location.href=options[selectedIndex].value">
                <option >
                    <h6>
                        選擇年度
                    </h6>
                </option>
                @foreach($years as $year)
                    <option value="{{route('teacher.year.index',$year)}}">
                        <h6>
                            {{$year}}學年度
                        </h6>
                    </option>
                @endforeach
            </select>
        </h1>
    </div>

    <div class="col-sm-8">
        <button type="button" onclick="location.href = 'courses'" class="btn btn-sm btn-primary">公告區</button>
        <button type="button" onclick="location.href = 'text_materials'" class="btn btn-sm btn-outline-secondary">教材區</button>
        <button type="button" onclick="location.href = 'home_works'" class="btn btn-sm btn-outline-secondary">評量區</button>
        <button type="button" onclick="location.href = 'TA_offices'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
    </div>

    {{-- 第二列 --}}
    <div class="col-sm-12">
        <h6>
            @foreach($courses_year as $course)
                <a href="">
                    {{$course -> name}}({{$course -> classroom}}) |
                </a>
            @endforeach

        </h6>
    </div>
</div>

@endsection

{{-- 頁面提示 --}}
@section('header_text')
    <div class="row row-cols-2 "  >
            <div class="col-sm-12">
                <h6 style="margin-left: 20px">
                    正處於【教室】環境
                </h6>
            </div>

            <div class="col-sm-12">
                <button type="button" class="btn btn-success  " style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-right"></i> 辦公室  </button>
            </div>
        </div>
@endsection


{{-- Content --}}
@section('content')


@endsection

