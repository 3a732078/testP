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
{{-- 修改topbar bd --}}
<style>
    .topbar{
        background-color: #6a1a21;
    }
</style>
{{-- 年度列表--}}
    <h1>
        <select class="form-select" aria-label="Default select example" onchange="self.location.href=options[selectedIndex].value">
            @foreach($years as $year)
                <option value="{{route('teacher.year',$course -> year)}}">
                    <h6>
                        {{$year}}學年度
                    </h6>
                </option>
            @endforeach
        </select>
    </h1>

{{-- 課程選單 --}}


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
            <button type="button" class="btn btn-success  " style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-right"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')
    <!-- =======  Section course title======= -->
    <section id="course_title" class="cousrse notion-bg">
        <div class="container">

            <div class="row">

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <h1>
                        110學年度上學期
                    </h1>
                </div>

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <h1>
                        {{$course -> name}}
                    </h1>
                </div>

                <div class="col-lg-6 col-md-4 col-2 d-flex align-items-center justify-content-center">
                    <img src="{{asset('assets/img/clients/client-3.png')}}" class="img-fluid" alt="">
                </div>
            </div>

        </div>
    </section>
    <!-- End Title Section -->

    <!-- ======= Content Section ======= -->
    <section id="course_content" class="course notice_bg">
        <div class="container">
            <div class="row">
                {{--   contant                 --}}
                    <div class="table-responsive">


                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>標題</th>
                                <th>發佈者</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($notices as $notice)
                                <tr>
                                    <td >
                                        {{$notice -> title}}
                                    </td>
                                    <td>
                                        $user ->name
                                    </td>
                                    <td width="100" align="center">
                                        <input type="button"
                                               class="btn btn-outline-dark btn-sm"
                                               onclick="location.href = '{{$notice->id}}'"
                                               value="檢視公告"
                                        />

                                        <form action="{{$selected -> id}}/{{$notice -> id}}"
                                              method="post"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                    type="submit"
                                            >
                                                刪除
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>


                    </div>


            </div>

        </div>
    </section>
    <!-- End Course Section -->

@endsection

