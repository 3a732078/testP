@extends('layouts/home')
@section('search')
    <div align="left">
        @if($class !== null)
            <h3 class="mt-4">{{\App\Models\Course::find($class)->name}}▹筆記列表</h3>
        @elseif($class === null)
            <h3 class="mt-4">筆記列表</h3>
        @endif
    </div>
@endsection
@if($class === null)
    @section('navno')
{{--        <hr class="sidebar-divider">--}}
{{--        <div class="sidebar-heading">--}}
{{--            建立--}}
{{--        </div>--}}
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
@endif
@section('notice')
    <div id="layoutSidenav_content">
        <main>
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-folder" aria-hidden="true" style="color: #FAD689"></i>&ensp;
{{--                        筆記列表 - &ensp;--}}
                        <button  class="btn btn-default btn-xs" onclick="change('course')" id="coursehref" style="color:black;background-color: #B5CAA0 ;line-height: 20px;">課程之筆記</button>
                        <button  class="btn btn-default btn-xs" onclick="change('assist')" id="assisthref" style="color:black;background-color: #B5CAA0 ;line-height: 20px;">協同筆記</button>
                        <button  class="btn btn-default btn-xs" onclick="change('author')" id="authorhref" style="color:black;background-color: #B5CAA0 ;line-height: 20px;">純筆記</button>
{{--                        #B4A582--}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
{{--                            課程之筆記--}}
                        @if($class !== null)
                            <div id="course">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr style="background-color: #77969A ;color: black; border:2px #2d3748">
                                    <th>標題</th>
                                    <th class="mh1">引用教材</th>
                                    <style type="text/css">
                                        .mh1{
                                            text-align:center;/** 设置水平方向居中 */
                                            vertical-align:middle/** 设置垂直方向居中 */
                                        }
                                    </style>
                                    <th class="mh1">所屬課程</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($notes as $note)
                                    @if(\App\Models\Course::find($class)->name === $note->attach)
                                    <tr>
                                        <td width="280">{{basename($note->textfile,'.json')}}</td>
                                        <td width="500" align="center">
                                            @if($note->textbook_id==null)
                                               無引用教材
                                            @else
                                                <span class="span.mark-pen"
                                                      style="background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">{{$note->textbook->name}}</span>
                                            @endif
                                        </td>
                                        <td width="170" align="center">
                                            @for($i=0;$i<count($courseName);$i++)
                                                @if($note->attach===$courseName[$i])
{{--                                                    <span style="color:#2E8B57;">{{$courseName[$i]}}</span>--}}
{{--                                                    <span style="color:#B47157;background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">{{$courseName[$i]}}</span>--}}
                                                    {{$courseName[$i]}}
                                                @endif
                                            @endfor
                                            @if($note->attach===null)
                                                <span style="color:#8674A1;"> 無</span>
                                            @endif
                                        </td>
                                        <td width="170" align="center">
                                            <a class="btn btn-primary btn-sm" href="/notes/{{$note->id}}">檢視筆記</a>

                                            <form action="/notes/{{$note->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">刪除筆記</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            </div>
{{--                            協同筆記--}}
                            <div id="assist">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr style="background-color: #77969A ;color: #2d3748; border:2px #2d3748">
                                    <th>標題</th>
                                    <th class="mh1">引用教材</th>
                                    <style type="text/css">
                                        .mh1{
                                            text-align:center;/** 设置水平方向居中 */
                                            vertical-align:middle/** 设置垂直方向居中 */
                                        }
                                    </style>
                                    <th class="mh1">所屬課程</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($assist as $note)
                                    @if(\App\Models\Course::find($class)->name === $note->attach || $note->attach===null)
                                    <form method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <tr>
                                            <td width="280">{{basename($note->textfile,'.json')}}</td>
                                            <td width="500" align="center">
                                                @if($note->textbook_id==null)
                                                    無引用教材
                                                @else
                                                    <span class="span.mark-pen"
                                                          style="background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">{{\App\Models\Textbook::where('id',$note->textbook_id)->value('name')}}</span>
                                                @endif
                                            </td>
                                            <td width="170" align="center">
                                                @for($i=0;$i<count($courseName);$i++)
                                                    @if($note->attach===$courseName[$i])
{{--                                                        <span style="color:#2E8B57;background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">{{$courseName[$i]}}</span>--}}
                                                        {{$courseName[$i]}}
                                                    @endif
                                                @endfor
                                                @if($note->attach===null)
                                                    <span style="color:#8674A1;"> 無</span>
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
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            @endif
{{--                            純筆記--}}
                            <div id="author">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr style="background-color: #77969A ;color: black; border:2px #2d3748">
                                        <th>標題</th>
                                        <th class="mh1">引用教材</th>
                                        <style type="text/css">
                                            .mh1{
                                                text-align:center;/** 设置水平方向居中 */
                                                vertical-align:middle/** 设置垂直方向居中 */
                                            }
                                        </style>
                                        <th class="mh1">所屬課程</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($notes as $note)
                                        @if($note->attach===null)
                                            <tr>
                                                <td width="280">{{basename($note->textfile,'.json')}}</td>
                                                <td width="500" align="center">
                                                    @if($note->textbook_id==null)
                                                        無引用教材
                                                    @endif
                                                </td>
                                                <td width="170" align="center">
                                                    @if($note->attach===null)
                                                        <span style="color:#8674A1;"> 無</span>
                                                    @endif
                                                </td>
                                                <td width="170" align="center">
                                                    <a class="btn btn-primary btn-sm" href="/notes/{{$note->id}}">檢視筆記</a>

                                                    <form action="/notes/{{$note->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">刪除筆記</button>
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
        @if($class === null)
            document.getElementById("coursehref").hidden=  true;
            document.getElementById("assisthref").hidden=  true;
            // document.getElementById("authorhref").disabled = true;
            document.getElementById("course").hidden=  true;
            document.getElementById("assist").hidden=  true;
            document.getElementById("author").hidden=  false;
        @elseif($class !== null)
            document.getElementById("coursehref").disabled = true;
            document.getElementById("assisthref").disabled=  false;
            document.getElementById("authorhref").disabled = false;
            document.getElementById("course").hidden=  false;
            document.getElementById("assist").hidden=  true;
            document.getElementById("author").hidden=  true;
        @endif

        function change(judgment) {

            if (judgment === 'course'){
                console.error(123);
                document.getElementById("coursehref").disabled = true;
                document.getElementById("assisthref").disabled=  false;
                document.getElementById("authorhref").disabled = false;
                document.getElementById("course").hidden=  false;
                document.getElementById("assist").hidden=  true;
                document.getElementById("author").hidden=  true;
            }
            if (judgment === 'assist'){
                console.error(456);
                document.getElementById("coursehref").disabled = false;
                document.getElementById("assisthref").disabled=  true;
                document.getElementById("authorhref").disabled = false;
                document.getElementById("course").hidden=  true;
                document.getElementById("assist").hidden=  false;
                document.getElementById("author").hidden=  true;
            }
            if (judgment === 'author'){
                @if($class !== null)
                    console.error(456);
                    document.getElementById("coursehref").disabled = false;
                    document.getElementById("assisthref").disabled=  false;
                    document.getElementById("authorhref").disabled = true;
                    document.getElementById("course").hidden=  true;
                    document.getElementById("assist").hidden=  true;
                    document.getElementById("author").hidden=  false;
                @endif
            }
        }
    </script>
@endsection
