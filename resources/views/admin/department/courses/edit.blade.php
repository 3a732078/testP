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
            @if($errors -> over -> any())
                <div class="alert alert-danger">
                    <li>
                        <b>
                            @php
                                $max_year = \App\Models\Course::all() -> sortByDesc('year')-> first() -> year ;
                            @endphp
                            不可修改超過{{$max_year}}學年
                        </b>
                    </li>
                </div>
            @endif

            <table class="table  border-bottom-secondary border-5">
                <form action="course_update" method="post" enctype="multipart/form-data">
                    @csrf
                    <thead>
                    <th height="40px">{{$course -> name }}</th>

                    <th height="40px">
                    </th>
                    <td  height="40px" align="right">
                        <button class="btn btn-outline-secondary btn-sm"
                                type="submit"
                        >
                            <span style="color: black"><b>送出</b></span>
                        </button>
                    </td>

                    </thead>

                    <tbody>
                    <tr>
                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"
                                       id="teacher_name" name="teacher_name"
                                       value=" {{$course -> teacher -> user -> name}}"
                                >
                                <label for="teacher_name">Teacher Name</label>
                                @error('teacher_name') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>
                        <td height="25px" valign="middle" colspan="2">
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" name="department_name" id="department_name">
                                    <option value="{{$department -> name}}" selected >{{$department -> name}}</option>
                                    @foreach($departments as $data)
                                        <option value="{{$data -> name}}">{{$data -> name}}</option>
                                    @endforeach
                                </select>
                                <label for="department_name">系所名稱</label>
                                @error('department_name') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"
                                       id="course_name" name="course_name"
                                       value="{{$course -> name}}"
                                >
                                <label for="course_name">課程名稱</label>
                                @error('course_name') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>
                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" name="grade" id="grade">
                                    <option value="{{$course -> grade}}" selected>請選擇年級</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <label for="grade">年級</label>
                                @error('grade') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>
                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="year"
                                       id="year" value="{{$course -> year}}" >
                                <label for="year">學年</label>
                                @error('year') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Default select example" name="classroom" id="classroom">
                                    <option value="{{$course -> classroom}}" selected>{{$course -> classroom}}</option>
                                    @if(mb_substr($course -> classroom,3,1,'utf-8') != '甲')
                                        <option value="{{mb_substr($course -> classroom , 0,3,'utf-8')}}甲">{{mb_substr($course -> classroom , 0,3,'utf-8')}}甲</option>
                                    @else
                                        <option value="{{mb_substr($course -> classroom , 0,3,'utf-8')}}乙">{{mb_substr($course -> classroom , 0,3,'utf-8')}}乙</option>
                                    @endif
                                </select>
                                <label for="classroom">班級</label>
                                @error('classroom') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>
                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="semester"
                                       id="semester"  value="{{$course -> semester}}">
                                <label for="semester">學期</label>
                                @error('semester') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>
                    </tr>

                    </tbody>

                </form>
            </table>
        </div>
    </div>
@endsection

