@extends('layouts/home')
@section('notice')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5><i class="fa fa-cube" style="color: #A16B47;"></i>&ensp;
                        <span style="color:#808080;">{{$tkName}}</span>&ensp;──&ensp;教材筆記</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>標題</th>
                                    <th class="mh1">作者</th>
                                    <th class="mh1">平均分數</th>
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
                                    @foreach ($classNotes as $classNote)
                                        <tr>
                                            <td>
                                                {{$classNote['title']}}
                                            </td>
                                            <td align="center">
                                                {{\App\Models\User::find($classNote['user_id'])->name}}
                                            </td>
                                            <td align="center" width="300">
                                                <span style="color:#F08080;">
                                                {{$classNote['avg']}}</span>
                                            </td>
                                            <td align="center" width="170">
                                                @if($classNote['user_id']==\Illuminate\Support\Facades\Auth::id())
                                                    <a class="btn btn-warning btn-sm" style="color: #704214" href="/notes/{{$classNote['id']}}">檢視筆記</a>
                                                @else
                                                    <a class="btn btn-warning btn-sm" style="color: #704214" href="/notes/classes/{{$classNote['id']}}">檢視筆記</a>
                                                @endif
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
