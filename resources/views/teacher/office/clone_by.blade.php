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

        <li class="nav-item">
            <a class="nav-link" href='problem'>常見問題</a>
        </li>

        <li class="nav-item">
            <a class="nav-link "  href= 'behave'>校園行事曆</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href= 'system_suggest'>系統建議</a>
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
                    style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')
    <div align="center">
        <div  class="card" style="background-color: #F0F0F0 ;width: 1200px;height: 600px">
            <div class="card-header" text-left>
                <table >
                    <tbody>
                        <tr height=""><h3>複製課程教材到 「{{$course -> year}}_{{$course -> semester}}{{$course -> name}}」從...</h3></tr>
                        <tr height=""></tr>
                        <tr height=""></tr>
                        <tr height="x"></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body text-left">
                <table class="table  border-bottom-secondary border-5">
                    <thead>
                    <th height="40px">課程名稱</th>
                    <th height="40px">
                        {{-- 查找年分 --}}
                        <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">
                            <option value="" selected="selected" >- - 年 - -</option>
                            @foreach($courses  -> unique('year') as $data)
                                <option value="{{route('teacher.office.CB.year',[$course -> id,$data -> year,])}}" >{{$course -> year}}</option>
                            @endforeach

                        </select>
                    </th>
                    <th height="40px">
                        {{-- 查找學期 --}}
                        <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">
                            <option value="" selected="selected" >- - 學期 - -</option>
                            <option value="{{route('teacher.office.CB.semester',[$course -> id,1,])}}" >上學期</option>
                            <option value="{{route('teacher.office.CB.semester',[$course -> id,2,])}}" >下學期</option>

                        </select>
                    </th>
                    <th  height="40px"> </th>

                    </thead>

                    <tbody>
                    @foreach($courses as $data)
                        <tr>
                            <td height="25px" valign="middle">
                                {{$data -> name}}
                            </td>
                            <td height="25px" valign="middle">
                                {{$data -> year}}
                            </td>
                            <td height="25px" valign="middle">
                                {{$data -> semester}}
                            </td>
                            <td height="25px" valign="middle">
                                <button type="submit" class="btn btn-outline-secondary btn-sm"
                                        onclick="location.href = '{{route('teacher.office.CB.show',[$course -> id ,$data -> id])}}'">
                                    檢視  <img height="30px" src="https://img.icons8.com/dotty/80/000000/browse-folder.png"/>
                                </button>

                                <button class="btn btn-outline-secondary" onclick="location.href = '{{route('teacher.office.CB.clone',[$course->id,$data -> id])}}'">
                                    使用此課程複製
                                </button>
                                <button type="submit" class="btn btn-outline-secondary btn-sm"
                                        onclick="location.href = '{{route('teacher.office.CB.store',[$course -> id,$data -> id])}}'">
                                    使用此課程新增
                                </button>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

