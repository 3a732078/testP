<head>

    <meta charset="utf-8">

    <title>(課堂筆記)顯示筆記</title>

</head>
<h1>課堂筆記</h1>

<div style="display:none">
    <img id="scream" width="220" height="277"
         src="{{asset('images/uccu/uccu1.jpg')}}" alt="The Scream">

</div>
<form id="json" name="json">

    <div style="display:none">
        id：<input name="id" id="id" value="{{$id}}"><br>
{{--        課程：<input name="class" id="class" value="{{$class}}"><br>--}}
        課程：<input name="class" id="class" value=""><br>
        筆記名稱：<input name="notename" id="notename" value="{{$name}}"><br>
        收藏狀態：<input id="favorstatus" name="favorstatus" value="{{$favor}}">
        評分狀態：<input id="scorestatus" name="scorestatus" value="{{$sscore}}">
        <img id="jsonimg" width="220" height="277"
             src="" alt="">
    </div>
{{--    課程：{{$class}}<br>--}}
    筆記名稱：{{$name}}<br>
    <div style="display:none">
        <input readonly="readonly" id="call" name="call" value="{{$json}}">
    </div>

</form>



<form id="favor" name="favor" method="POST" action="/favor" onsubmit="return favorto()">
    @csrf
    @method('POST')
    <div style="display:none">
        id：<input name="id" id="id" value="{{$id}}"><br>
    </div>
    <input onclick="favorto()" id="heart" name="heart" type="checkbox" class="heart">
    <label for="heart" class="heart">❤</label>
    <div style="display:none"><button id="favorbtn" name="favorbtn">送出</button></div>
</form>


<div class="move">
    <button onclick="scorebtn()" id="scorebtn" class="btn-hover">評分</button>
    <input class="hideable hide" type="text" name="name" placeholder="輸入評分">
</div>


<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<div class="stars hideable hide move">
    <form action="/score" method="POST" id="score" name="score">
        @csrf
        @method('POST')
        <div style="display:none">
            id：<input name="id" id="id" value="{{$id}}"><br>
        </div>
        <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
        <label class="star star-5" for="star-5"></label>
        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
        <label class="star star-4" for="star-4"></label>
        <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
        <label class="star star-3" for="star-3"></label>
        <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
        <label class="star star-2" for="star-2"></label>
        <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
        <label class="star star-1" for="star-1"></label>
    </form>
        <button name="ssend" id="ssend" onclick="sconfirm()">送出</button>
</div>
<br>
←上一頁<input id="page" value="當前頁數/總頁數">下一頁→
{{--{{$notes->links()}}//頁數--}}
<br>

<br>
<canvas id="note" width="1191" height="1684" style="background-image:url({{asset('images/uccu/uccu1.jpg')}}); "></canvas>



<form id="comments" name="comments" method="POST" action="/comments">
    @csrf
    @method('POST')
    新增留言
    <div style="display: none">
        <input id="note_id" name="note_id" value="{{$id}}">
    </div>
    <input readonly="readonly" id="" name="" value="{{$uname}}">
    <textarea id="contents" name="contents">留言內容</textarea>
    <button>留言</button>
</form>

顯示留言<i class="far fa-comment-dots"></i>
@foreach($comments as $comment)
<input readonly="readonly" id="" name="" value="{{$comment->user_id}}">
<textarea readonly="readonly">{{$comment->content}}</textarea>
    <br><br>
@endforeach
<button>判斷身分如果是該使用者的話會出現"回覆"按鈕</button>
點回覆按鈕會展開textarea輸入 然後按下'送出" 就會回覆

<style>
    canvas {
        border: 1px solid black;
        width: 1191px;
        height: 1684px;
    }
    body{
        background: #F0F0F0;
    }
    .btn-hover:hover {
        background: #F95738;
    }

    .move {
        position: relative;
        margin-left: 0;
        -webkit-transition: 0.6s margin-left;
        transition: 0.6s margin-left;
    }

    .slided {
        margin-left: 170px;
    }

    .hideable.hide {
        opacity: 0;
        -webkit-transition: 0.2s 0s opacity;
        transition: 0.2s 0s opacity;
    }

    .hideable.show {
        opacity: 1;
        -webkit-transition: 0.3s 0.4s opacity;
        transition: 0.3s 0.4s opacity;
    }

    /*---*/

    div.stars {
        width: 200px;
        display: inline-block;
    }

    input.star { display: none; }

    label.star {
        float: right;
        padding: 10px;
        font-size: 18px;
        color: #444;
        transition: all .2s;
    }

    input.star:checked ~ label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.star-5:checked ~ label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952;
    }

    input.star-1:checked ~ label.star:before { color: #F62; }

    label.star:hover { transform: rotate(-15deg) scale(1.3); }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }


    input.heart {
        position: absolute;
        left: -100vw;
    }

    label.heart {
        color: #aab8c2;
        cursor: pointer;
        font-size: 18px;
        align-self: center;
        transition: color 0.2s ease-in-out;
    }

    label.heart:hover {
        color: grey;
    }

    input.heart:checked + label {
        color: #e2264d;
        will-change: font-size;
        animation: heart 1s cubic-bezier(.17, .89, .32, 1.49);
    }



    @keyframes heart {0%, 17.5% {font-size: 0;}}


</style>
<script>

    window.addEventListener("load", function (){



        var test=document.json.call.value;

        const objson=JSON.parse(test);

        var note = document.getElementById("note");
        var context = note.getContext("2d");
        for(var k=0;k<objson[2].length;k++){
                document.json.jsonimg.src="{{asset('images/')}}"+"/"+objson[2][k].path[0]
            var img = new Image();
            img.src=document.json.jsonimg.src;
            console.log(document.json.jsonimg.src)
            context.drawImage(img, objson[2][k].location[0], objson[2][k].location[1]);

        }
        for(var j=0 ; j < objson[0].length ; j++){
            context.font = "30px Arial";
            context.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
        }
        for(var i=0 ; i < objson[1].length ; i++){
            context.globalAlpha = 0.5;
            context.lineWidth=objson[1][i].width[0]
            context.strokeStyle = objson[1][i].color[0];
            context.beginPath();
            context.moveTo(objson[1][i].start[0],objson[1][i].start[1]);
            context.lineTo(objson[1][i].end[0],objson[1][i].end[1]);
            context.stroke();
            context.closePath();
        }



        if(document.json.favorstatus.value==="0"){

            document.getElementById("heart").checked = false;
        }
        if(document.json.favorstatus.value==="1"){

            document.getElementById("heart").checked = true;
        }

        switch (document.json.scorestatus.value) {
        case '1':
            document.getElementById("star-1").checked = true;
            break;

        case '2':
            document.getElementById("star-2").checked = true;
            break;

        case '3':
            document.getElementById("star-3").checked = true;
            break;

        case '4':
            document.getElementById("star-4").checked = true;
            break;

        case '5':
            document.getElementById("star-5").checked = true;
             break;

        }

        if(document.json.scorestatus.value){
            document.getElementById("ssend").disabled=true;
        }
    },false);
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script>
    function scorebtn(){
        $('.move').toggleClass('slided');
        $('.hideable').toggleClass('hide').toggleClass('show');
    }
</script>

<script>
    function favorto(){
        $("#favor").ajaxSubmit(function() {
        });
    }
</script>

<script>
    function sconfirm(){
        var yes = confirm('只能送出一次評分,按下確認後送出');

        if (yes) {
            alert('已送出評分');
            $("#score").ajaxSubmit(function() {
            });
            document.getElementById("ssend").disabled=true;
        } else {
        }
    }
</script>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>




