<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enote</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
<body>
<div align="center">
    <div class="card mt-4 "  style="width:1200px ; height: 600px">
        {{-- Header --}}
        <div class="card-header card text-left "  >
            <div class="row">
                <div class="col-lg-4">
                    {{$receiver -> user -> name}}
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <button class="btn btn-outline-secondary btn-sm" onclick="location.href = '/ta/classes/{{$course -> id}}'">
                        首頁<img style="height: 20px" src="https://img.icons8.com/ios-filled/50/000000/fire-exit.png"/>
                    </button>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="card-body bg-gray-700" style="overflow: auto" >
            @if(count($messages) > 0)
                @foreach($messages as $message)
                    @if($message -> sender == $sender -> user -> type)
                        {{-- 發送者 --}}
                        <div align="right" class="row-cols-2">
                            <div class="col-lg-12">
                                <img class="img-profile rounded-circle"
                                     src="{{asset('/home/img/undraw_profile.svg')}}"
                                     style="height: 20px"
                                >
                                <card style="width: 500px ; height: auto " class="card bg-light text-right">
                                    {{$message -> content}}
                                </card>
                            </div>
                            {{-- 第二列 --}}
                            <div class="col-lg-4" align="left">
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <p style="color: black">
                                    {{$message -> created_at}}
                                </p>
                            </div>

                        </div>
                    @else
                        {{-- 收件者 --}}
                        <div align="left" class="row-cols-2">
                            <div class="col-lg-12">
                                <img class="img-profile rounded-circle"
                                     src="{{asset('/home/img/undraw_profile.svg')}}"
                                     style="height: 20px"
                                >
                                <card style="width: 500px ; height: auto " class="card bg-light text-right">
                                    {{$message -> content}}
                                </card>
                            </div>
                            {{-- 第二列 --}}
                            <div class="col-lg-4"> </div>
                            <div class="col-lg-4"> </div>
                            <div class="col-lg-4">
                                <p style="color: #dae0e5">
                                    {{$message -> created_at}}
                                </p>                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

        </div>

        {{-- Footer --}}
        <div class="card-header" style = "height: auto ; background-color: #95999c">
            <form action="{{route('teacher.office.TA.message.store',[$course -> id , $receiver -> id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-2">
                    </div>

                    <div class="col-lg-6">
                        <input type="text"
                               class=""
                               placeholder="輸入訊息"
                               name="message"
                               style="height: auto;width: 700px; margin-top: 20px;font-size: 18px">
                    </div>

                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-outline-primary" >
                            <img src="https://img.icons8.com/color/48/000000/filled-sent.png"/>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
