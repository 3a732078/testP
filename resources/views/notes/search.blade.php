@extends('layouts/home')
@section('search')
    @if(isset($class))
        <div align="left">
            <h3 class="mt-4">{{\App\Models\Course::find($class)->name}}▹搜尋筆記</h3>
        </div>
    @endif
@endsection
@section('content')
    @if ($message = Session::get('alert'))
        <script>alert("{{ $message }}");</script>
    @endif
    <div class="card-header">
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-5">
            <input type="text" placeholder="搜尋.." name="searchs"
                   style="outline: none;width: 800px;height: 40px;margin-left:100px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-dark"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
    </div>
@endsection

@section('notice')
    <h4 class="mt-4">搜尋結果</h4>
    <div class="card-body">
@if($ans==true)
    @if(count($searchs)> 0)
        <div class="table-responsive">
            <table class="table task-table table table-hover table-bordered" hidden id="dataTable" width="100%" cellspacing="0"
                   style="background-color: #FFF5EE;color: #2d3748; border:2px #2d3748">
                <thead style="background-color: #bac8f3">
                <tr>
                    <th>標題</th>
                    <th class="mh1">引用教材</th>
                    <style type="text/css">
                        .mh1{
                            text-align:center;/** 设置水平方向居中 */
                            vertical-align:middle/** 设置垂直方向居中 */
                        }
                    </style>
                    <th class="mh1">所屬課程</th>
                    <th class="mh1">作者</th>
                    <th></th>
                </tr>
                </thead>

        @foreach ($searchs as $search)
            @if($class!==null)
                @if(\App\Models\Course::find($class)->name === $search->attach)
                <tbody>
                    <tr>
                    <td width="280">{{basename($search->textfile,'.json')}}</td>
                    <td width="500" align="center">
                        @if($search->textbook==null)
                            無引用教材
                        @else
                            {{$search->textbook->name}}
                        @endif
                    </td>
                    <td width="170" align="center">
                        @for($i=0;$i<count($courseName);$i++)
                            @if($search->attach===$courseName[$i])
                               {{$courseName[$i]}}
                            @endif
                        @endfor
                        @if($search->attach===null)
                            <span style="color:#8674A1;"> 無</span>
                        @endif
                    </td>
                    <td width="500" align="center">
                        {{$search->user->name}}
                    </td>
                    <td width="170" align="center">
                        @if($search->user_id==$id)
                        <a class="btn btn-primary btn-sm" href="/notes/{{$search->id}}">檢視筆記</a>
                        @else
                        <a class="btn btn-primary btn-sm" href="/notes/classes/{{$search->id}}">檢視筆記</a>
                        @endif
                    </td>
                    </tr>
                </tbody>

                @elseif(\App\Models\Course::find($class)->name !== $search->attach)
                    查無筆記
                    @php
                    $resp=false;
                    @endphp
                    @break;
                @endif
            @elseif($class === null)
                <tbody>
                <tr>
                    <td width="280">{{basename($search->textfile,'.json')}}</td>
                    <td width="500" align="center">
                        @if($search->textbook==null)
                            無引用教材
                        @else
                            {{$search->textbook->name}}
                        @endif
                    </td>
                    <td width="170" align="center">
                        @for($i=0;$i<count($courseName);$i++)
                            @if($search->attach===$courseName[$i])
                                {{--                                                    <span style="color:#2E8B57;">{{$courseName[$i]}}</span>--}}
                                {{--                                                    <span style="color:#B47157;background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">{{$courseName[$i]}}</span>--}}
                                {{$courseName[$i]}}
                            @endif
                        @endfor
                        @if($search->attach===null)
                            <span style="color:#8674A1;"> 無</span>
                        @endif
                    </td>
                    <td width="170" align="center">
                        {{$search->user->name}}
                    </td>
                    <td width="170" align="center">
                        @if($search->user_id==$id)
                            <a class="btn btn-primary btn-sm" href="/notes/{{$search->id}}">檢視筆記</a>
                        @else
                            <a class="btn btn-primary btn-sm" href="/notes/classes/{{$search->id}}">檢視筆記</a>
                        @endif
                    </td>
                </tr>
                </tbody>
            @endif
        @endforeach
            </table>
        </div>
    @else
       查無筆記
    @endif
@elseif($ans==false)

@endif
</div>
    <script>
        @if($resp === true)
            document.getElementById("dataTable").hidden=  false;
        @endif
    </script>
@endsection


