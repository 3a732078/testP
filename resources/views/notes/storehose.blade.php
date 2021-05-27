@extends('layouts/home')
@section('search')
    <div align="left">
        <h3 class="mt-4">{{\App\Models\Course::find($class)->name}}▹收藏筆記</h3>
    </div>
@endsection
@section('notice')
    <div id="layoutSidenav_content">
        <main>
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-heart" style="color: #B22222;"></i>&ensp;
                        收藏庫
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>標題</th>
                                    <th class="mh1">作者</th>
                                    <style type="text/css">
                                        .mh1{
                                            text-align:center;/** 设置水平方向居中 */
                                            vertical-align:middle/** 设置垂直方向居中 */
                                        }
                                    </style>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($favor as $row)
                                    <form method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <tr>
                                            <td>{{basename($row->textfile,'.json')}}</td>
                                            <td width="170" align="center">
                                                {{$row->user->name}}
                                            </td>
                                            <td width="170" align="center">
                                                <a class="btn btn-sm" style="background-color: #FFF380;color:#7E3817;" href="/notes/classes/{{$row->id}}"><i class="fas fa-angle-right">&ensp;檢視筆記</i></a>
                                    </form>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
