@extends('layouts.admin.main')

@section('title')
    Elearning
@endsection

{{-- TopBar left--}}
@section('header_item')
    <h3>{{$department -> name}}</h3>
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
@endsection


{{-- Content --}}
@section('content')
    <div align="center">
        <div  class="card" style="background-color: #F0F0F0 ;width: 1200px;height: 600px">
            <div class="card-body text-left"
            >
                <table class="table  border-bottom-secondary border-5">
                    <form action="course_update" method="post" enctype="multipart/form-data">
                        @csrf
                        <thead>
                        @if(session('errors'))
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

                        <th height="40px">{{$course -> name }}</th>

                        <th height="40px">
                        </th>
                        <th  height="40px">
                            <button class="btn btn-outline-secondary btn-sm"
                                    type="submit"
                            >
                                <span style="color: black"><b>送出</b></span>
                            </button>
                        </th>

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
                                    <input type="text" class="form-control" name="department_name"
                                           id="department_name" value="{{$course -> department -> name}}" >
                                    <label for="department_name">Department Name</label>
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
                                    <label for="course_name">Course Name</label>
                                    @error('course_name') <li><span style="color: red">{{$message}}</span></li>@enderror
                                </div>
                            </td>
                            <td height="25px" valign="middle">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="grade"
                                           id="grade" value="{{$course -> grade}}" >
                                    <label for="grade">Grade</label>
                                    @error('grade') <li><span style="color: red">{{$message}}</span></li>@enderror
                                </div>
                            </td>
                            <td height="25px" valign="middle">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="year"
                                           id="year" value="{{$course -> year}}" >
                                    <label for="year">Year</label>
                                    @error('year') <li><span style="color: red">{{$message}}</span></li>@enderror
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td height="25px" valign="middle">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control"
                                           id="classroom" name="classroom"
                                           value="{{$course -> classroom}}"
                                    >
                                    <label for="classroom">Classroom</label>
                                    @error('classroom') <li><span style="color: red">{{$message}}</span></li>@enderror
                                </div>
                            </td>
                            <td height="25px" valign="middle">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="semester"
                                           id="semester"  value="{{$course -> semester}}">
                                    <label for="semester">Semester</label>
                                    @error('semester') <li><span style="color: red">{{$message}}</span></li>@enderror
                                </div>
                            </td>
                        </tr>

                        </tbody>

                    </form>
                </table>
            </div>
        </div>
    </div>
@endsection

