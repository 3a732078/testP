@extends('layouts.teacher.main')

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

        <button type="button" onclick="location.href = '{{route('teacher.office.courses.notices',[$course_id])}}'"class="btn btn-sm btn-outline-secondary">公告區</button>
        <button type="button" onclick="location.href = '{{route('teacher.office.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>
        <button type="button" onclick="location.href = '{{route('teacher.office.courses.BN',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">瀏覽筆記</button>
        <button type="button" onclick="location.href = '{{route('teacher.office.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-primary">TA相關事務</button>

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
                    onclick="location.href = '{{route('teacher.office.courses.TA_office',[$course_id,])}} '"
                    class="btn btn-success  " style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-right"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')
    <div align="center">
    <div class="card "  style="width:1200px ; height: 600px">
        {{-- Header --}}
        <div class="card-header card text-left" style = "">
            {{$receiver -> user -> name}}
        </div>

        {{-- Body --}}
        <div class="card-body bg-gray-700" >
            @if(isset($messages))
                @foreach($messages as $message)
                    @if($message -> sender == $sender -> user -> type)
                        {{-- 發送者 --}}
                        <div align="right" class="row-cols-2">
                            <div class="col-lg-12">
                                <img class="img-profile rounded-circle"
                                     src="{{asset('/home/img/undraw_profile.svg')}}"
                                     style="height: 20px"
                                >
                                <card style="width: 500px ; height: auto " class="card bg-light text-right">
                                    {{$message -> content}}
                                </card>
                            </div>
                            {{-- 第二列 --}}
                            <div class="col-lg-4" align="left">
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <p style="color: #dae0e5">
                                    {{$message -> created_at}}
                                </p>
                            </div>

                        </div>
                    @else
                        {{-- 收件者 --}}
                        <div align="left" class="row-cols-2">
                            <div class="col-lg-12">
                                <img class="img-profile rounded-circle"
                                     src="{{asset('/home/img/undraw_profile.svg')}}"
                                     style="height: 20px"
                                >
                                <card style="width: 500px ; height: auto " class="card bg-light text-right">
                                    {{$message -> content}}
                                </card>
                            </div>
                            {{-- 第二列 --}}
                            <div class="col-lg-4"> </div>
                            <div class="col-lg-4"> </div>
                            <div class="col-lg-4">
                                <p style="color: #dae0e5">
                                    {{$message -> created_at}}
                                </p>                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

        </div>

        {{-- Footer --}}
        <div class="card-header" style = "height: auto ; background-color: #95999c">
            <form action="{{route('teacher.office.TA.message.store',[$course -> id , $receiver -> id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                    </div>

                    <div class="col-lg-6">
                        <input type="text"
                               class=""
                               placeholder="輸入訊息"
                               name="message"
                               style="height: auto;width: 700px; margin-top: 20px;font-size: 18px">
                    </div>

                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-outline-primary" >
                            <img src="https://img.icons8.com/color/48/000000/filled-sent.png"/>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

