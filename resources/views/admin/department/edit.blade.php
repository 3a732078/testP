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
                    alert("科系名稱不可重複");
                </script>
            @endif
            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">
                    <form action="{{route('department.update',[$department -> id])}}" method="post">
                        @csrf
                        @method('PUT')

                        {{-- Header --}}
                        <div class="card-header" >
                            <div class="row" style="margin: 0 auto" >
                                <div class="col-lg-4" >
                                    <i class="fas fa-table mr-1" style="margin-top: 10px"></i>
                                    編輯科系 <img src="https://img.icons8.com/metro/26/000000/right.png"/> {{$department -> name}}
                                </div>
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-2" align="right">
                                    <button class="btn btn-outline-secondary"
                                            type="submit"
                                    >
                                        儲存
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Body --}}
                        <div class="card-body">
                            @error('name')<span style="color: red"><li> {{$message}}@enderror</li></span>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">科系名稱</span>
                                <input name = 'name' type="text"
                                       class="form-control" aria-label="Sizing example input"
                                       aria-describedby="inputGroup-sizing-sm" value="{{$department -> name}}"
                                >
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

@endsection

