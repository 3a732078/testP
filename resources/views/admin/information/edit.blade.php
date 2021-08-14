@extends('layouts.admin.main')
{{--@section('header_name')--}}
{{--    --}}{{-- 直接寫入 --}}
{{--    #--}}
{{--@endsection--}}

{{-- Title --}}
@section('title')
    Elearning
@endsection

{{-- TopBar --}}
@section('header_item')

    <ul class="nav nav-tabs">

        <<li class="nav-item ">
            <a class="nav-link  " aria-current="page" href='/admin/index'>最新消息</a>
        </li>

        <li class="nav-item">
            <a class="nav-link "  href= '/admin/behave'>校園行事曆</a>
        </li>


    </ul>

@endsection

{{-- 頁面提示 --}}
@section('header_text')
    <div class="row row-cols-2" >

        <div class="col-sm-6">
        </div>

        <div class="col-6" style="margin-top: 10px;">
            <h6 style="margin-left: 15px">
            </h6>
        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">

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
    <div id="layoutSidenav_content">
        <main>
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif

            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">
                    <form action="update" method="post" >
                        @csrf

                        {{-- Header --}}
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-4 " style="margin-top: 10px">
                                    <i class="fas fa-table mr-1"></i>
                                    最新消息
                                </div>
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-2">
                                    <button class="btn bg-gradient-primary"
                                            type="submit"
                                    >
                                        <span style="color:#dae0e5;">完成</span>
                                    </button>
                                    <button class="btn btn-outline-danger"
                                            onclick="location.href = 'delete'"
                                    >
                                        刪除
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover"
                                       id="dataTable" width="100%" cellspacing="0"
                                >
                                    <tbody>
                                    <tr>
                                        <th width="100px">
                                            張貼者:
                                        </th>
                                        <td >
                                            {{$information -> poster}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="100px">
                                            標題:
                                        </th>
                                        <td>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name = 'title'
                                                       placeholder="{{$information -> title}}"
                                                       aria-label="Recipient's username" aria-describedby="basic-addon2"
                                                >
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="100px">
                                            張貼時間:
                                        </th>
                                        <td>
                                            {{$information -> created_at}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th width="100px" valign="middle">
                                            內容:
                                        </th>
                                        <td>
                                            <p style="margin-top: 20px;margin-bottom: 20px">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name = 'content' style="height: auto"
                                                           placeholder="{{$information -> content}}"
                                                           aria-label="Recipient's username" aria-describedby="basic-addon2"
                                                    >
                                                </div>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

@endsection

