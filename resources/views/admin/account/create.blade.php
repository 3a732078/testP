@extends('layouts.admin.main')

@section('title')
    Elearning
@endsection

{{-- TopBar left--}}
@section('header_item')
    <h3>新增使用者帳號</h3>
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
        <table class="table  border-bottom-secondary border-5" style="width: 1000px">
            <form action="store" method="post">
                @csrf
                <tbody>
                @if(session('errors'))
                    <div class="alert alert-danger">
                        <b>欄位不可空白</b>
                    </div>
                @endif
                @if(session('status'))
                    <div class="alert alert-success">
                        <b>新增成功</b>
                    </div>
                @endif
                <tr>
                    <td align="left">
                    </td>
                    <td align="right">
                        <button class="btn btn-outline-secondary" type="submit">
                            送出
                        </button>
                    </td>
                </tr>
                <tr>
                    <td height="25px" valign="middle">
                        <label for="teacher_name" class="form-label">名字</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control"
                                   id="user_name" aria-describedby="basic-addon3"
                                   name="user_name"
                            >
                        </div>
                        @error('user_name') <li><span style="color: red">{{$message}}</span></li>@enderror
                    </td>

                    <td colspan="2">
                        <label for="DepartmentName" class="form-label">系所</label>
                        <div class="input-group mb-3">
                            <select name="DepartmentName"  class="form-select" aria-label="Default select example">
                                <option value="" selected>請選擇系所</option>
                                @foreach($departments as $data)
                                    <option value="{{$data -> name}}"> {{$data -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('DepartmentName') <li><span style="color: red">{{$message}}</span></li>@enderror
                    </td>
                </tr>

                <tr>
                    <td height="25px" valign="middle">
                        <label for="Type" class="form-label">使用者類型</label>
                        <div class="input-group mb-3">
                            <select name="Type"  class="form-select" aria-label="Default select example">
                                <option value="" selected>請選擇使用者類型</option>
                                <option value="學生">學生</option>
                                <option value="老師">老師</option>
                            </select>
                        </div>
                        @error('Type') <li><span style="color: red">{{$message}}</span></li>@enderror
                    </td>

                    <td colspan="2">

                    </td>
                </tr>

                <tr>
                    <td height="25px" valign="middle">
                        <label for="grade" class="form-label">學生必填</label>
                        <div class="input-group mb-3">
                            <select name="grade" id="grade" class="form-select" aria-label="Default select example" >
                                <option value="" selected>請選擇年級</option>
                                <option value="一"> 一</option>
                                <option value="二"> 二</option>
                                <option value="三"> 三</option>
                                <option value="四"> 四</option>
                            </select>
                        </div>
                        @error('grade') <li><span style="color: red">{{$message}}</span></li>@enderror
                    </td>

                    <td colspan="2">
                        <label for="class" class="form-label"></label>
                        <div class="input-group mb-3">
                            <select name="class" id="class"  class="form-select" aria-label="Default select example">
                                <option value="" selected>請選擇班別</option>
                                    <option value="甲"> 甲</option>
                                    <option value="乙"> 乙</option>
                            </select>
                        </div>
                        @error('class') <li><span style="color: red">{{$message}}</span></li>@enderror
                    </td>
                </tr>
                </tbody>

            </form>
        </table>

    </div>
@endsection
