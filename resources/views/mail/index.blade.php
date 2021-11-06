<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enote</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
@if(session('errors'))
    <div class="alert alert-success">
        {{session('errors')}}
    </div>
@endif
<div align="center">
    <div  class="card" style="background-color: #F0F0F0 ;width: 1200px;height: 600px;overflow:auto;" >
        <div class="card-body text-left">
            @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
            @endif

            <table class="table  border-bottom-secondary border-5">
                <thead>
                    <th width="100">學號</th>
                    <th width="100">姓名</th>
                    <th width="200">Email   </th>
                    <th width="150" align="right">
                        <b class="ml-5"> 課程老師:</b> {{$teacher -> user -> name}}
                    </th>

                    <th width="50" align="right">
                        @if(\Illuminate\Support\Facades\Auth::user() -> type == '老師')
                            <button onclick="location.href = '{{route('teacher.courses.notices',[$course -> id])}}'"
                                    class="btn btn-outline-secondary"
                            >
                                返回
                            </button>
                        @else
                            <button onclick="location.href = '/classes/{{$course -> id}}'"
                                    class="btn btn-outline-secondary"
                            >
                                返回
                            </button>
                        @endif
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

                        <td height="25px" valign="middle" colspan="2">
                            @if(!isset($data -> user -> email) )
                                <div align="middle"><b >尚未設定Email</b></div>
                            @else
                                {{$data -> user -> email}}
                            @endif
                        </td>

                        <td height="25px" valign="middle">
                            <button onclick="location.href = '{{$data -> user -> id}}/create'" class="btn btn-outline-secondary btn-sm"
                            >
                                    <span style="color: black">
                                        <b>
                                            Mail  <img style="height: 20px" src="https://img.icons8.com/material-two-tone/24/000000/mail.png"/>
                                        </b>
                                    </span>
                            </button>
                        </td>
                    </tr>
                @endforeach



                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
