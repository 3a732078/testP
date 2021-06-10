@extends('layouts/tahome')
<head>

    <meta charset="utf-8">

    <title>私訊(TA)-{{$classn}}</title>

</head>
@section('tanav')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>課程</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">已選課程:</h6>
                {{--                @if ($count > 0)--}}
                {{--                    @for($i = 0; $i < $count; $i++)--}}
                {{--                        <a class="collapse-item" href="/ta/classes/@php echo $tacid[$i]; @endphp" >@php echo $tac[$i]; @endphp</a>--}}
                {{--                    @endfor--}}
                {{--                @endif--}}
            </div>
        </div>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#textbooks"
           aria-expanded="true" aria-controls="textbookss">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>教材</span>
        </a>
        <div id="textbooks" class="collapse" aria-labelledby="textbooks"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">教材相關:</h6>
                <a class="collapse-item" href="/textbooks/create">新增教材</a>
                <a class="collapse-item" href="/textbooks">教材管理</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">




@endsection

@section('notice')
<div class="container">
{{--    <div class="message-blue">--}}
{{--        <p class="message-content">現在是2021/01/22下午2:57分</p>--}}
{{--        <div class="message-timestamp-left"><a href="#">TA</a> 發送時間</div>--}}
{{--    </div>--}}

{{--    <div class="message-orange">--}}
{{--        <p class="message-content">好喔 謝謝</p>--}}
{{--        <div class="message-timestamp-right">學生 發送時間</div>--}}
{{--    </div>--}}

{{--    <div class="message-blue">--}}
{{--        <p class="message-content">我是TA</p>--}}
{{--        <div class="message-timestamp-left"><a href="#">TA</a> 發送時間</div>--}}
{{--    </div>--}}
    {{$classn}}-與學生訊息頁面
    <p>___________________________</p>
    @foreach ($questions as $question)
        @if($question->response)
            <div class="message-blue">
                <p class="message-content">{{$question->content}}</p>
                <div class="message-timestamp-left"><a href="#">TA</a> {{$question->time}}</div>
            </div>
        @else
            <div class="message-orange">
                <p class="message-content">{{$question->content}}</p>
                <div class="message-timestamp-right">學生 {{$question->time}}</div>
            </div>

        @endif
    @endforeach
</div>
<form action="/ta/questions" method="POST" role="form" id="form">
    @csrf
    @method('POST')
    <input id="send" name="send" placeholder="輸入內容．．．">
    <div style="display:none">
        <input id="stuid" name="stuid" value="{{$id}}">
        <input id="taid" name="taid" value="{{$ta}}">
        <input id="classid" name="classid" value="{{$class}}">
    </div>
    <button>送出</button>
</form>
<a href="/ta/course/{{$class}}"><i class="fas fa-arrow-left" style="color:#00a6a6"></i></a>|<a href="/ta"><i class="fas fa-home home" style="color:#00a6a6"></i></a>
@endsection
<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400);

    .container {
        width: 400px;
        padding: 10px;
    }

    .message-blue {
        position: relative;
        margin-left: 20px;
        margin-bottom: 10px;
        padding: 10px;
        background-color: #A8DDFD;
        width: 200px;
        height: 50px;
        text-align: left;
        font: 400 .9em 'Open Sans', sans-serif;
        border: 1px solid #97C6E3;
        border-radius: 10px;
    }

    .message-orange {
        position: relative;
        margin-bottom: 10px;
        margin-left: calc(100% - 240px);
        padding: 10px;
        background-color: #f8e896;
        width: 200px;
        height: 50px;
        text-align: left;
        font: 400 .9em 'Open Sans', sans-serif;
        border: 1px solid #dfd087;
        border-radius: 10px;
    }

    .message-content {
        padding: 0;
        margin: 0;
    }

    .message-timestamp-right {
        position: absolute;
        font-size: .85em;
        font-weight: 300;
        bottom: 5px;
        right: 5px;
    }

    .message-timestamp-left {
        position: absolute;
        font-size: .85em;
        font-weight: 300;
        bottom: 5px;
        left: 5px;
    }

    .message-blue:after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-top: 15px solid #A8DDFD;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        top: 0;
        left: -15px;
    }

    .message-blue:before {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-top: 17px solid #97C6E3;
        border-left: 16px solid transparent;
        border-right: 16px solid transparent;
        top: -1px;
        left: -17px;
    }

    .message-orange:after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-bottom: 15px solid #f8e896;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        bottom: 0;
        right: -15px;
    }

    .message-orange:before {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        border-bottom: 17px solid #dfd087;
        border-left: 16px solid transparent;
        border-right: 16px solid transparent;
        bottom: -1px;
        right: -17px;
    }

</style>
<script>
    window.onload = function() {
        var element = document.getElementById("form");
        element.scrollIntoView({block: "end"});
    }
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
