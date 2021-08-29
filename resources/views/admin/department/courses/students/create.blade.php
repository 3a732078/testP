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
                @if(session('errors'))
                    <div class="alert alert-danger">

                    </div>
                @endif

                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
                <h3>
                    {{$course -> name}}:新增修課學生
                </h3>
                <table class="table  border-bottom-secondary border-5">
                    @if(count($students) > 0)
                        <thead>
                        <th>學號</th>
                        <th>姓名</th>
                        <th>班級</th>
                        <th align="right">
                            <button class="btn btn-outline-secondary"
                                    onclick="location.href = '{{route('course.students',[$department -> id,$course -> id])}}'"
                            >
                                返回
                            </button>
                        </th>
                        </thead>

                        <tbody>
                        @foreach($students as $data)
                            <tr>
                                <td width="100px" height="25px" valign="middle">
                                    {{$data -> user -> account}}
                                </td>

                                <td width="100px" height="25px" valign="middle">
                                    {{$data -> user -> name}}
                                </td>

                                <td width="200px" height="25px" valign="middle">
                                    {{$data -> classroom}}
                                </td>

                                <td width="50px" height="25px" valign="middle">
                                    <button onclick="location.href = '{{$data -> id}}/store'"
                                            class="btn bg-gradient-success "
                                    >
                                        <span style="color: #cbd5e0">
                                            <b>新增</b>
                                        </span>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    @else

                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection

