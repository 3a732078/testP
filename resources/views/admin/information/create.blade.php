@extends('layouts.admin.main')

{{-- Title --}}
@section('title')
    Elearning
@endsection

{{-- TopBar --}}
@section('header_item')

    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link " aria-current="page" href='/admin/index'>最新消息</a>
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
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif

            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">
                    <form action="{{route('information.store')}}" method="post">
                        @csrf

                        {{-- Header --}}
                        <div class="card-header" >
                            <div class="row" style="margin: 0 auto" >
                                <div class="col-lg-4" >
                                    <i class="fas fa-table mr-1" style="margin-top: 10px"></i>新增消息
                                </div>
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-2">
                                    <button class="btn btn-outline-secondary"
                                            type="submit"
                                    >
                                        儲存
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- body --}}
                        <div class="card-body">
                            @error('title')<span style="color: red"><li> {{$message}}@enderror</li></span>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">標題</span>
                                <input name = 'title' type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            @error('content')<span style="color: red"><li> {{$message}}@enderror</li></span>
                            <div class="form-floating">
                                <textarea name = 'content' class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">內容</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

@endsection

