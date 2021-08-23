@extends('layouts.admin.main')

@section('title')
    Elearning
@endsection

{{-- TopBar left--}}
@section('header_item')
    <h3>{{$department -> name}}</h3>
    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link  " aria-current="page" href='/admin/index'>最新消息</a>
        </li>

    </ul>
@endsection

{{-- 頁面提示 --}}
@section('header_text')
@endsection


{{-- Content --}}
@section('content')
    <div align="center">
        <div  class="card" style="background-color: #F0F0F0 ;width: 1200px;height: 600px">
            <div class="card-body text-left"
            >
                <table class="table  border-bottom-secondary border-5">
                    <thead>
                    @if(session('status'))
                        <div class="alert alert-success">
                            <li>
                                <b>
                                    已刪除課程
                                </b>
                            </li>
                        </div>
                    @endif
                    @if(session('errors'))
                        <div class="alert alert-danger">
                            <li>
                                <b>
                                    不可刪除以選課的課程
                                </b>
                            </li>
                        </div>
                    @endif
                    <th height="40px">課程名稱</th>
                    <th height="40px">
                        {{-- 查找年分 --}}
                        <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">
                            <option value="" selected="selected" >- - 年 - -</option>
                            @foreach($courses  -> unique('year') as $course)
                                <option value="search_year/{{$course -> year}}" >{{$course -> year}}</option>
                            @endforeach

                        </select>
                    </th>
                    <th height="40px">
                        {{-- 查找學期 --}}
{{--                        <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">--}}
{{--                            <option value="" selected="selected" >- - 學期 - -</option>--}}
{{--                            <option value="{{route('teacher.office.semester.semester',[1,])}}" >上學期</option>--}}
{{--                            <option value="{{route('teacher.office.semester.semester',[2,])}}" >下學期</option>--}}

{{--                        </select>--}}
                        <b> - - 學期 - - </b>
                    </th>
                    <th  height="40px">
                        <button class="btn bg-gradient-success btn-sm"
                                onclick="location.href = '{{route('course.create',[$department -> id])}}'"
                        >
                            <span style="color: #F0F0F0"><b>新增課程</b></span>
                        </button>

                    </th>

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
                                <button type="submit" class="btn bg-gradient-info btn-sm"
                                        onclick="location.href = '{{route('course.edit',[$department -> id,$course -> id])}}'"
                                >
                                    <span style="color: #cbd5e0"><b>
                                            編輯課程資訊  <img class="mb-1" style="height: 20px" src="https://img.icons8.com/ios/50/000000/courses.png"/>
                                        </b></span>
                                </button>
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="location.href = '{{route('course.destroy',[$department -> id,$data -> id])}}'"
                                >
                                    <span style="color: black"><b>刪除</b></span>
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

