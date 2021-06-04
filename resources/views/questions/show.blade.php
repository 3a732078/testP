<head>

    <meta charset="utf-8">

    <title>私訊</title>

</head>
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
{{--        <p class="message-content">我是學生</p>--}}
{{--        <div class="message-timestamp-left"><a href="#">TA</a> 發送時間</div>--}}
{{--    </div>--}}
    與TA訊息頁面
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
<form action="/questions" method="POST" role="form" id="form">
    @csrf
    @method('POST')
    <input id="send" name="send" placeholder="輸入內容．．．">
    <div style="display:none">
        <input id="taid" name="taid" value="{{$id}}">
        <input id="studentid" name="studentid" value="{{$student}}">
        <input id="classid" name="classid" value="{{$class}}">
    </div>
    <button>送出</button>
</form>

<a href="/classes/{{$classId}}"><i class="fas fa-arrow-left" style="color:#00a6a6"></i></a>


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
