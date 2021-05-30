@extends('layouts/home')
@section('search')
    <div align="left">
        <h3 class="mt-4">{{\App\Models\Course::find($class)->name}}▹收藏庫</h3>
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
{{--                        收藏庫--}}
                        <button  class="btn btn-default btn-xs" onclick="change('courses')" id="coursehref" style="color:black;background-color: #9ca8b8 ;line-height: 20px;">課程之筆記</button>
                        <button  class="btn btn-default btn-xs" onclick="change('only')" id="onlyhref" style="color:black;background-color: #9ca8b8 ;line-height: 20px;">純筆記</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="course">
                            <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr style="background-color: #E6C3C3; color: rgb(101,101,101);border:2px #2d3748">
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
                                    @if(\App\Models\Course::find($class)->name === $row->attach)
                                    <form method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <tr>
                                            <td>{{basename($row->textfile,'.json')}}</td>
                                            <td width="170" align="center">
                                                {{$row->user->name}}
                                            </td>
                                            <td width="170" align="center">
                                                <a class="btn btn-sm" style="background-color: #FBE251; color: rgb(101,101,101);" href="/notes/classes/{{$row->id}}"><i class="fas fa-angle-right">&ensp;檢視筆記</i></a>
                                    </form>
                                    </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            </div>


                        <div id="only">
                            <table class="table table-hover table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                <thead>
                                <tr style="background-color: #E6C3C3; color: rgb(101,101,101);border:2px #2d3748">
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
                                    @if($row->attach===null)
                                        <form method="POST" role="form" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <tr>
                                                <td>{{basename($row->textfile,'.json')}}</td>
                                                <td width="170" align="center">
                                                    {{$row->user->name}}
                                                </td>
                                                <td width="170" align="center">
                                                    <a class="btn btn-sm" style="background-color: #FBE251; color: rgb(101,101,101);" href="/notes/classes/{{$row->id}}"><i class="fas fa-angle-right">&ensp;檢視筆記</i></a>
{{--                                                    #C78550--}}
                                        </form>
                                        </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById("coursehref").disabled = true;
        document.getElementById("onlyhref").disabled = false;
        document.getElementById("course").hidden =  false;
        document.getElementById("only").hidden =  true;

        function change(judgment) {

            if (judgment === 'courses'){
                console.error(123);
                document.getElementById("coursehref").disabled = true;
                document.getElementById("onlyhref").disabled = false;
                document.getElementById("course").hidden =  false;
                document.getElementById("only").hidden =  true;
            }
            if (judgment === 'only'){
                console.error(456);
                document.getElementById("coursehref").disabled = false;
                document.getElementById("onlyhref").disabled = true;
                document.getElementById("course").hidden =  true;
                document.getElementById("only").hidden =  false;
            }
        }
    </script>
@endsection
