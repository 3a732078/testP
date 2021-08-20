@extends('layouts.admin.main')

@section('title')
    Elearning
@endsection

{{-- TopBar left--}}
@section('header_item')
    <h3>匯入課程資訊</h3>
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
    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <div align="center">
        <div  class="card" style="background-color: #F0F0F0 ;width: 1200px;height: 600px">
            <div class="card-body text-left"
            >
                <table class="table  border-bottom-secondary border-5">
                        <tbody>
                        {{-- 匯入課程 --}}
                        <form action="course/import" enctype="multipart/form-data" method="post">
                            @csrf
                            <tr valign="middle">
                                <td height="25px">
                                    <h3>
                                        <b>
                                            匯入新學期課程
                                            <img style="height: 50px" class="mb-1" src="https://img.icons8.com/ios-glyphs/30/000000/right--v1.png"/>
                                        </b>
                                    </h3>
                                </td>
                                <td height="25px" valign="middle">
                                    <input type="file" name="course" class="form-control">
                                        @error('course')
                                        <li>
                                            <span style="color: red">
                                                {{$message}}
                                            </span>
                                        </li>
                                        @enderror
                                </td>
                                <td height="25px" valign="middle">
                                </td>
                                <td height="25px" valign="middle">
                                    <button type="submit" class="btn bg-gradient-info btn-sm"
                                    >
                                    <span style="color: #cbd5e0">
                                        <b>
                                            送出  <img class="mb-1" style="height: 20px" src="https://img.icons8.com/ios/50/000000/check-file.png"/>                                        </b>
                                    </span>
                                    </button>
                                </td>
                            </tr>

                        </form>

                        {{-- 匯入選課資料 --}}
                        <form action="course_student/import" enctype="multipart/form-data" method="post">
                            @csrf
                            <tr>
                                <td height="25px" valign="middle">
                                    <h3>
                                        <b>
                                            匯入選課資料
                                            <img style="height: 50px" class="mb-1" src="https://img.icons8.com/ios-glyphs/30/000000/right--v1.png"/>
                                        </b>
                                    </h3>
                                </td>
                                <td height="25px" valign="middle">
                                    <input type="file" name="course_student" class="form-control">
                                    @error('course_student')
                                    <li>
                                            <span style="color: red">
                                                {{$message}}
                                            </span>
                                    </li>
                                    @enderror
                                </td>
                                <td height="25px" valign="middle">
                                </td>
                                <td height="25px" valign="middle">
                                    <button type="submit" class="btn bg-gradient-info btn-sm"
                                    >
                                    <span style="color: #cbd5e0">
                                        <b>
                                            送出  <img class="mb-1" style="height: 20px" src="https://img.icons8.com/ios/50/000000/check-file.png"/>                                        </b>
                                    </span>
                                    </button>
                                </td>
                            </tr>

                        </form>

                        </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

