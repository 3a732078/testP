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
            <div class="card-body text-left">
                @if(session('status'))
                    <div class="alert alert-success">
                        <li>
                            <b>
                                {{session('status')}}
                            </b>
                        </li>
                    </div>
                @endif
                @if(session('errors'))
                    <div class="alert alert-danger">
                        <li>
                            <b>
                                {{session('errors') -> first()}}
                            </b>
                        </li>
                    </div>
                @endif
                <h3>{{$course -> name}}</h3>

                <table class="table  border-bottom-secondary border-5">
                    <thead>
                    <th height="40px">學號</th>

                    <th height="40px">
                        姓名
                    </th>

                    <th height="40px">
                        班級
                    </th>

                    <th  height="40px">
                        <button class="btn bg-gradient-success btn-sm"
                                onclick="location.href = '{{route('course_student.create',[$department -> id,$course ->id])}}'"
                        >
                            <span style="color: #F0F0F0"><b>新增修課學生</b></span>
                        </button>

                    </th>

                    </thead>

                    <tbody>
                    @foreach($students as $data)
                        <tr>
                            <td height="25px" valign="middle">
                                {{$data -> user -> account}}
                            </td>

                            <td height="25px" valign="middle">
                                {{$data -> user -> name}}
                            </td>

                            <td height="25px" valign="middle">
                                {{$data -> classroom}}
                            </td>

                            <td height="25px" valign="middle">
                                <button type="submit" class="btn btn-outline-danger btn-sm"
                                        onclick="location.href = '{{$data -> id}}/delete'"
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

