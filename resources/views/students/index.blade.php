@extends('layouts/home')

{{-- TopBar left --}}
@section('header_item')

    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link active " aria-current="page" href='/students'>最新消息</a>
        </li>


        <li class="nav-item">
            <a class="nav-link "  href= '/students/behave'>校園行事曆</a>
        </li>
    </ul>

@endsection

@section('search')
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-3" style="margin-top: 10px">
            <input type="text" placeholder="搜尋.." name="searchs" style="outline: none;width: 330px;height: 42px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
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
                            @if(count($informations) > 0 )
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th width="200px">發佈者</th>
                                        <th width="500px">標題</th>
                                        <th width="200px">張貼時間</th>
                                        <th width="200px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($informations as $data)
                                        <tr>
                                            <td >
                                                {{$data -> poster}}
                                            </td>
                                            <td>
                                                {{$data -> title}}
                                            </td>
                                            <td>
                                                {{$data -> created_at}}
                                            </td>
                                            <td align="center" >
                                                <button class="btn btn-outline-secondary"
                                                        onclick="location.href = '{{$data -> id}}/show'"
                                                >
                                                    檢視
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
                                <h3>尚未張貼任何消息</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
