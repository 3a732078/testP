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
    <h3>
        <b>
            科系管理
        </b>
    </h3>

    <ul class="nav nav-tabs">

        <li class="nav-item ">
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
            @if(session('errors'))
                <script>
                    alert("不可刪除已有課程的科系");
                </script>
            @endif

            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">

                    {{-- Header --}}
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 " style="margin-top: 10px">
                                <i class="fas fa-table mr-1"></i>
                                科系管理
                            </div>
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-2">
                                <button class="btn bg-gradient-success"
                                        onclick="location.href = 'create'"
                                >
                                    <span style="color: #F0F0F0;">新增</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- body --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(count($departments) > 0)
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th width="200px">#</th>
                                        <th width="200px">科系名稱</th>
                                        <th width="200px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departments as $data)
                                        <tr>
                                            <td >
                                                {{$data -> id}}
                                            </td>
                                            <td>
                                                {{$data -> name}}
                                            </td>
                                            <td align="center" >
                                                <button class="btn btn-outline-secondary"
                                                        onclick="location.href = '{{$data -> id}}/index'"
                                                >
                                                    瀏覽學期課程
                                                </button>
                                                <button class="btn bg-gradient-primary"
                                                        onclick="location.href = '{{$data -> id}}/edit'"
                                                >
                                                    <span style="color:#dae0e5;">編輯</span>
                                                </button>
                                                <button class="btn btn-outline-danger"
                                                        onclick="location.href = '{{$data -> id}}/delete'"
                                                >
                                                    刪除
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h3>尚未有任何科系</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection

