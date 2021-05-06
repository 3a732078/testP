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
                                        <td width="280">{{basename($note->textfile,'.json')}}</td>
                                        <td width="500" align="center">
                                            @if($note->textbook_id==null)
                                               無引用教材
                                            @else
                                                {{$note->textbook->name}}
                                            @endif
                                        </td>
                                        <td width="170" align="center">
                                        <a class="btn btn-primary btn-sm" href="/notes/{{$note->id}}">檢視筆記</a>
                                </form>
                                        <form action="/notes/{{$note->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">刪除筆記</button>
                                        </form>
                                    </td>
                                    </tr>

{{--                                @endfor--}}
                                @endforeach
                                @foreach ($assist as $note)
                                    <form method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <tr>
                                            <td width="280">{{basename($note->textfile,'.json')}}</td>
                                            <td width="500" align="center">
                                                @if($note->textbook_id==null)
                                                    無引用教材
                                                @else
                                                    {{\App\Models\Textbook::where('id',$note->textbook_id)->value('name')}}
                                                @endif
                                            </td>
                                            <td width="170" align="center">
                                                <a class="btn btn-primary btn-sm" href="/notes/{{$note->id}}">檢視筆記</a>
                                    </form>
                                    <form action="/notes/{{$note->id}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">刪除筆記</button>
                                    </form>
                                    </td>
                                    </tr>

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
