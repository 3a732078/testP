
@extends('layouts.teacher.main')

@section('search')
    <div align="left">
        <h3 class="mt-4">{{\App\Models\Course::find($class)->name}}▹教材筆記</h3>
    </div>
@endsection

{{-- Title --}}
@section('title')
    Elearning
@endsection

{{-- TopBar left --}}
@section('header_item')
    <div style="margin-right: 15px">

        <h3>{{\App\Models\Course::find($class) -> name}}</h3>

    </div>

    <div>

        <button type="button" onclick="location.href = '{{route('teacher.courses.notices',[$class])}}'"class="btn btn-sm btn-outline-secondary">公告區</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.text_materials',[$class])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.BN',[$class,0])}}'" class="btn btn-sm btn-primary">瀏覽筆記</button>
        <button type="button" onclick="location.href = '{{route('teacher.courses.TA_office',[$class])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
        <button type="button" onclick="location.href = '{{route('mail.index',[$class])}}'" class="btn btn-sm btn-outline-secondary">發送mail</button>

    </div>

@endsection

{{-- 頁面提示 header right --}}
@section('header_text')
    <div class="row row-cols-2" >

        <div class="col-sm-6">
        </div>

        <div class="col-6" style="margin-top: 10px;">
            <h6 style="margin-left: 15px">
                正處於【教室】環境
            </h6>
        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">
            <button type="button"
                    onclick="location.href = '{{route('teacher.office.courses.notices',[$class,])}} '"
                    class="btn btn-success  " style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-right"></i> 辦公室  </button>
        </div>
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
                        <div class="row">
                            <div class="col-lg-8">
                                <h5><i class="fa fa-cube" style="color: #A16B47;"></i>&ensp;
                                    <span style="color:#808080;">引用教材：{{$tkName}}</span>
                                </h5>
                            </div>

                                <div class="col-lg-4">
                                    <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">
                                        <option value="" selected="selected" style="text-align: center">- - 選擇教材 - -</option>
                                        @foreach($TMs as $data)
                                            <option value="{{route('teacher.courses.BN',[$class , $data -> id])}}" >{{$data -> name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                        </div>

                    </div>
                    @if(count($classNotes) > 0)
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
                                            @php
                                                $className=\App\Models\Note::where('title',$classNote['title'])->value('textfile')
                                            @endphp
                                            {{basename($className,'.json')}}
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
                    @else
                        <h3>
                            沒有分享的筆記
                        </h3>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection
