@extends('layouts/home')

{{-- TopBar left --}}
@section('header_item')

    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link active " aria-current="page" href='/students'>最新消息</a>
        </li>

    </ul>

@endsection

@section('search')
    @if(\Illuminate\Support\Facades\Auth::user() -> status == '暫停')
        <div class="search-container">
            <form  class="ml-md-3" style="margin-top: 10px">
                <input type="text" placeholder="搜尋.." name="searchs" style="outline: none;width: 330px;height: 42px;border-radius:20px;padding-left: 20px">
                <button onclick="stop_status()" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>
            </form>
        </div>
    @else
        <div class="search-container">
            <form action="{{route('notes.search')}}" class="ml-md-3" style="margin-top: 10px">
                <input type="text" placeholder="搜尋.." name="searchs" style="outline: none;width: 330px;height: 42px;border-radius:20px;padding-left: 20px">
                <button type="submit" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>
            </form>
        </div>
    @endif
@endsection

@section('navno')
    {{--    <hr class="sidebar-divider">--}}
    {{--    <div class="sidebar-heading">--}}
    {{--        建立--}}
    {{--    </div>--}}
    <li class="nav-item" style="margin-top: -10px">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseU"
           aria-expanded="true" aria-controls="collapseU">
            <i class="fas fa-book-open"></i>
            <span style="margin-left: 3px">寫筆記</span>
        </a>
        <div id="collapseU" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">相關資訊:</h6>
                <a class="collapse-item" href="/notes/create">新增筆記</a>
                <a class="collapse-item" href="{{route('notes.mynotes')}}">筆記列表</a>
            </div>
        </div>
    </li>
@endsection

@section('content')
    <div id="layoutSidenav_content">
        <main>
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif

            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">

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
                                <button class="btn btn-outline-secondary"
                                        onclick="location.href = '/students'"
                                >
                                    <span style="color:#dae0e5;"><span style="color: black">反回</span> <img style="height: 20px" src="https://img.icons8.com/ios-filled/50/000000/fire-exit.png"/></span>
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
                                        {{$information -> title}}
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
                                            {{$information -> content}}
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
