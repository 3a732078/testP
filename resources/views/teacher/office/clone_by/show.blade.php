@extends('layouts.teacher.office.main')

@section('title')
    Elearning
@endsection

{{-- TopBar left--}}
@section('header_item')
    <h3>課程複製</h3>
    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link  " aria-current="page" href='index'>最新消息</a>
        </li>

    </ul>
@endsection

{{-- 頁面提示 --}}
@section('header_text')
    <div class="row row-cols-2" >

        <div class="col-sm-6">
        </div>

        <div class="col-6" style="margin-top: 10px;">
            <h6 style="margin-left: 15px">
                正在【辦公室】環境
            </h6>
        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">
            <button type="button"
                    class="btn btn-warning  "
                    onclick="location.href='{{route('teacher.index', [] )}}'"
                    style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室
            </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')
    <div align="center">
        <div  class="card" style="background-color: #F0F0F0 ;width: 1200px;height: 600px">
            <div class="card-header" text-left>
                <table >
                    <td>
                        <h3>
                            複製「{{$clone_by -> year}}_{{$clone_by -> semester}}{{$clone_by -> name}}」的教材到「{{$course -> year}}_{{$course -> semester}}{{$course -> name}}」
                        </h3>
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>
                        <button class="btn btn-outline-secondary" onclick="location.href = '{{route('teacher.office.CB.clone',[$course->id,$clone_by -> id])}}'">
                            確定   <img height="30px" src="https://img.icons8.com/wired/64/000000/checked-2.png"/>
                        </button>
                    </td>
                </table>
            </div>
            <div class="card-body text-left"            >
                <table class="table">
                    <thead>
                    <th height="40px">
                        <h1>
                            {{$clone_by -> year}}_{{$clone_by -> semester}}{{$clone_by -> name}}
                        </h1>
                    </th>
                    <th height="40px">

                    </th>
                    <th height="40px">

                    </th>
                    <th  height="40px">
                        教材列表
                    </th>
                    </thead>

                    <tbody>
                    @foreach($text_materials as $data)
                        <tr>
                            <td height="25px" valign="middle">
                                {{$data -> name}}
                            </td>
                            <td height="25px" valign="middle">
                            </td>
                            <td height="25px" valign="middle">
                            </td>
                            <td height="25px" valign="middle">
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

