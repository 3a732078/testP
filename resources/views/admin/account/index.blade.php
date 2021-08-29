@extends('layouts.admin.main')

@section('title')
    Elearning
@endsection

{{-- TopBar left--}}
@section('header_item')
    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link  " aria-current="page" href='/admin/index'>最新消息</a>
        </li>

    </ul>
@endsection

{{-- 頁面提示 --}}
@section('header_text')
@endsection

{{-- Content --}}
@section('content')
    <div id="layoutSidenav_content">
        <main>
            @if(session('errors'))
                <script>
                    alert("不可刪除已有課程的使用者");
                </script>
            @endif

            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">

                    {{-- Header --}}
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-4 " style="margin-top: 10px">
                                <i class="fas fa-table mr-1"></i>
                                帳號管理
                            </div>
                            <div class="col-lg-4" align="right">
                                {{-- 查找年分 --}}
                                <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">
                                    <option value="" selected="selected" >- - 使用者類型 - -</option>
                                    <option value="student">學生</option>
                                    <option value="teacher">老師</option>
                                </select>
                            </div>
                            <div class="col-lg-4" align="right">
                                <button class="btn bg-gradient-success btn-sm"
                                        onclick="location.href = 'create'"
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
                                    <span style="color: black"><b>匯入帳號資訊</b></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- body --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(count($users) > 0)
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th width="200px">#</th>
                                        <th width="200px">帳號</th>
                                        <th width="200px">姓名</th>
                                        <th width="200px">使用者類型</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $data)
                                        <tr>
                                            <td >
                                                {{$data -> id}}
                                            </td>
                                            <td>
                                                {{$data -> account}}
                                            </td>
                                            <td>
                                                {{$data -> name}}
                                            </td>
                                            <td>
                                                {{$data -> type}}
                                            </td>
                                            <td align="center" >
                                                <button class="btn bg-gradient-primary"
                                                        onclick="location.href = '{{$data -> id}}/edit'"
                                                >
                                                    <span style="color:#dae0e5;">編輯帳號資料</span>
                                                </button>
                                                <button class="btn btn-outline-danger"
                                                        onclick="location.href = '{{$data -> id}}/delete'"
                                                >
                                                    刪除帳號
                                                </button>
                                                @if( $data -> type == '學生')
                                                    <button class="btn btn-secondary"
                                                            onclick="location.href = '{{$data -> id}}/pause'"
                                                    >
                                                       暫停帳號
                                                    </button>
                                                    @endif
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
