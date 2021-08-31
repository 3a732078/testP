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
                    @if(session('errors'))
                        <div class="alert alert-danger">
                            @php
                                $max_year = \App\Models\Course::all() -> sortByDESC('year') -> first() -> year;
                            @endphp
                            <b>不可新增超過 {{$max_year + 1}} 學年的課程 </b>
                        </div>
                    @endif
                    <form action="course_store" method="post">
                        @csrf
                        <tbody>
                        <tr>
                            <td align="left">
                                <h3>
                                    新增課程
                                </h3>
                            </td>
                            <td align="right">
                                <button class="btn btn-outline-secondary" type="submit">
                                    送出
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td height="25px" valign="middle">
                                <label for="teacher_name" class="form-label">教師名稱</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"
                                           id="teacher_name" aria-describedby="basic-addon3"
                                           name="teacher_name"
                                    >
                                </div>
                                @error('teacher_name') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </td>

                            <td colspan="2">
                                <label for="name" class="form-label">課程名稱</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control"
                                           id="name" aria-describedby="basic-addon3"
                                           name="name"
                                    >
                                </div>
                                @error('name') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </td>
                        </tr>

                        <tr>
                            <td height="25px" valign="middle">
                                <label for="grade" class="form-label">年級</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" aria-label="Default select example" name="grade" id="grade">
                                        <option selected>請選擇年級</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                @error('grade') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </td>

                            <td colspan="2">
                                <label for="classroom" class="form-label">班別</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" aria-label="Default select example" name="classroom" id="classroom">
                                        <option selected>請選擇班別</option>
                                        <option value="甲">甲</option>
                                        <option value="乙">乙</option>
                                    </select>
                                </div>
                                @error('classroom') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </td>

                        </tr>
                        </tbody>

                    </form>
                </table>
            </div>
        </div>
    </div>
@endsection

