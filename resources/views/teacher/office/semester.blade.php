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
            <div class="card-body text-left"
                 >
                <table class="table  border-bottom-secondary border-5">
                    <thead>
                        <th height="40px">課程名稱</th>
                        <th height="40px">
                            {{-- 查找年分 --}}
                            <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">
                                <option value="" selected="selected" >- - 年 - -</option>
                                @foreach($courses  -> unique('year') as $course)
                                    <option value="{{route('teacher.office.semester.year',[$course -> year,])}}" >{{$course -> year}}</option>
                                @endforeach

                            </select>
                        </th>
                        <th height="40px">
                            {{-- 查找學期 --}}
                            <select name="year" onchange="javascript:location.href = this.value;"  style="height: 30px;">
                                <option value="" selected="selected" >- - 學期 - -</option>
                                    <option value="{{route('teacher.office.semester.semester',[1,])}}" >上學期</option>
                                    <option value="{{route('teacher.office.semester.semester',[2,])}}" >下學期</option>

                            </select>
                        </th>
                        <th  height="40px"> </th>

                    </thead>

                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td height="25px" valign="middle">
                                {{$course -> name}}
                            </td>
                            <td height="25px" valign="middle">
                                {{$course -> year}}
                            </td>
                            <td height="25px" valign="middle">
                                {{$course -> semester}}
                            </td>
                            <td height="25px" valign="middle">
                                <button type="submit" class="btn btn-outline-secondary btn-sm"
                                        onclick="location.href = '{{route('teacher.office.semester.clone_by',[$course -> id])}}'">
                                    複製此課程從... <img height="20px" src="https://img.icons8.com/flat-round/64/000000/right--v1.png"/>
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

