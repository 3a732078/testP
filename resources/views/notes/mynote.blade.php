@extends('layouts/home')
@section('notice')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        筆記列表
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>標題</th>
                                    <th class="mh1">引用教材</th>
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
                                @foreach ($notes as $note)
                                <form method="POST" role="form" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <tr>
                                        <td width="280">{{$note->title}}</td>
                                        <td width="500" align="center">
                                            @if($note->textbook==null)
                                               無引用教材
                                            @else
                                                {{$note->textbook->name}}
                                            @endif
                                        </td>
                                        <td width="170" align="center">
                                        <a class="btn btn-primary btn-sm" href="/mynotes/{id}">檢視筆記</a>
                                        <form action="#" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input name="delete" type="submit" onclick="javascript: form.action='/mynotes/{id}';" value="刪除筆記"  class="btn btn-danger btn-sm" >
                                        </form>
                                    </td>
                                    </tr>
                                </form>
{{--                                @endfor--}}
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
