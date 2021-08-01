@extends('layouts/home')

@section('header_item')

    <div style="margin-right: 15px">

        <h3>{{$course -> name}}</h3>

    </div>

@endsection

@section('search')
    <table style="width: 100%;margin-top:-25px">
        <tr>
            <td align="right">
                <h2 class="mt-4"><a class="btn btn-outline-dark btn-sm" style="width:200px; height:30px;"
                                    href="/classes/{{$notice->course_id}}" >返回公告列表</a></h2>
            </td>
        </tr>
    </table>
@endsection

@section('notice')
    <div id="layoutSidenav_content">
        <main>
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif
            <div class="container-fluid">

                <div class="card mb-4" style="margin-top:10px">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        公告發佈者：
                        @if($notice->teacher_id==null)
                            {{\App\Models\Student::where('id',$notice->ta_id)-> first()->user()->value('name')}}
                        @elseif($notice->ta_id==null)
                            {{\App\Models\Teacher::where('id',$notice->teacher_id)-> first()->user()->value('name')}}
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="form-group width">
                            <h5 class="card-title">
                                <span style="color:#4682B4;background-image: linear-gradient(transparent 50%, rgb(255, 229, 180) 50%)">
                                    <b>標題</b></span>：{{$notice->title}}
                            </h5>
                        </div>
                        <hr class="sidebar-divider"><br>
                        <div class="form-group width" style="margin-top:-30px">
                            <div>
                                <h5 class="card-title">
                                <span style="color:#4682B4;background-image: linear-gradient(transparent 50%, rgb(255, 229, 180) 50%)">
                                    <b>內容</b></span>：
                                    <p></p>&emsp;&emsp;&emsp;{{$notice->content}}</h5>
                            </div>
                        </div>
                    </div>

                </div>
{{--                <a class="btn btn-outline-dark btn-sm" style="width:200px;height:30px;" href="{{route('classes.index')}}" >返回公告列表</a>--}}
            </div>
        </main>
    </div>
@endsection
