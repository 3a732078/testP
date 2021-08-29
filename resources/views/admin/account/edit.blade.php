@extends('layouts.admin.main')

@section('title')
    Elearning
@endsection

{{-- TopBar left--}}
@section('header_item')
    <h3>帳號管理</h3>
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
            @if(session('errors'))
            @endif

            <table class="table  border-bottom-secondary border-5">
                <form action="update" method="post" enctype="multipart/form-data">
                    @csrf
                    <thead>
                    <th height="40px">
                        <b>編輯帳號</b>
                    </th>

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
                                       id="account" name="account" value={{$user -> account}}
                                >
                                <label for="account">帳號</label>
                                @error('account') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>

                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control"
                                       id="password" name="password" placeholder= " "
                                >
                                <label for="password">新密碼</label>
                                @if($errors -> password -> any())
                                    <span style="color: red">
                                        <li>
                                            與前密碼相同
                                        </li>
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td height="25px" valign="middle">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"
                                       id="name" name="name" value={{$user -> name}}
                                >
                                <label for="name">姓名</label>
                                @error('name') <li><span style="color: red">{{$message}}</span></li>@enderror
                            </div>
                        </td>

                        <td height="25px" valign="middle">
                            @if($user -> type == '老師')
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example"
                                            name="type" id="type"
                                    >
                                        <option value="老師" selected>老師</option>
                                        <option value="學生">學生</option>
                                    </select>
                                    <label for="type">使用者類型</label>
                                </div>
                                @else
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example"
                                            name="type" id="type"
                                    >
                                        <option value="學生" selected>學生</option>
                                        <option value="老師">老師</option>
                                    </select>
                                    <label for="type">使用者類型</label>
                                 </div>
                            @endif
                            @error('type') <li><span style="color: red">{{$message}}</span></li>@enderror
                        </td>
                    </tr>

                    <tr>
                        <td height="25px" valign="middle">
                            @if($user -> mail != null)
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control"
                                           id="email" name="email" value={{$user -> email}}
                                    >
                                    <label for="email">信箱</label>
                                </div>
                            @else
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control"
                                           id="email" name="email" placeholder=" "
                                    >
                                    <label for="email">請設定信箱 : UserName@gmail.com</label>
                                </div>
                            @endif
                            @if($errors -> email -> any())
                                <span style="color: red">
                                        <li>
                                            請輸入Google信箱
                                        </li>
                                    </span>
                            @endif
                        </td>

                        <td height="25px" valign="middle">
                            @if($user -> status == '使用')
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example"
                                            name="status" id="status"
                                    >
                                        <option value="使用" selected>使用</option>
                                        <option value="暫停">暫停</option>
                                    </select>
                                    <label for="status">使用者狀態</label>
                                </div>
                            @else
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Default select example"
                                            name="status" id="status"
                                    >
                                        <option value="暫停" selected>暫停</option>
                                        <option value="使用">使用</option>
                                    </select>
                                    <label for="status">使用者狀態</label>
                                </div>
                            @endif
                            @error('type') <li><span style="color: red">{{$message}}</span></li>@enderror
                        </td>
                    </tr>
                    </tbody>

                </form>
            </table>
        </div>
    </div>
@endsection

