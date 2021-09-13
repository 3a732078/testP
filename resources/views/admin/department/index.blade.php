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

                            <div class="col-lg-4">
                            </div>

                            <div class="col-lg-4" align="right">
                                <button class="btn bg-gradient-success btn-sm"
                                        onclick="location.href = 'department/create'"
                                >
                                    <span style="color: #F0F0F0;">
                                        <b>
                                            新增
                                        </b>
                                    </span>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm"
                                        onclick="location.href = 'import'"
                                >
                                    <span style="color: black"><b>匯入學生課程資訊</b></span>
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
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <button class="btn btn-outline-secondary"
                                                                onclick="location.href = 'department/{{$data -> id}}'"
                                                        >
                                                            瀏覽學期課程
                                                        </button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button class="btn bg-gradient-primary"
                                                                onclick="location.href = 'department/{{$data -> id}}/edit'"
                                                        >
                                                            <span style="color:#dae0e5;">編輯</span>
                                                        </button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <form action="{{route('department.delete',[$data -> id])}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-outline-danger"
                                                                    type="submit"
                                                            >
                                                                刪除
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
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

