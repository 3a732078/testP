@extends('layouts/home')
@section('search')
    <div align="left">
        <h2 class="mt-4">{{$deftextbook->course->name}}▹教材</h2>
    </div>
@endsection
@section('notice')
    <style>
        .divcss5{
            padding-bottom:0%;
            height:auto;
        }
        .divcss5 img{
            height:auto;
            max-width: 90%;
            text-align:center;
            width: 100%;
            overflow: hidden;
            z-index:1;
        }

        .fixed-bottom {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color:transparent;
        }
    </style>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-header">
                        {{$deftextbook->name}} ─&emsp;
                        <a class="fa fa-book" href="/textbooks/show/{{$deftextbook->id}}" style="color: #2d3748">&ensp;教材</a>&ensp;/&ensp;

                        @if(\Illuminate\Support\Facades\Auth::user()->type=='老師')
                            <a class="fa fa-edit" href="#">&ensp;編輯教材</a>&ensp;/&ensp;
                        @endif

                            <a class="fa fa-thumbs-o-up" style="color:#B22222;" href="/def/{{$id}}">&ensp;預設筆記</a>

                        &ensp;/&ensp;
                            <form method="post" action="/notes/ccreate" style="margin:0px;display: inline;">
                                @csrf
                                <input type="hidden" name="textbookId" value="{{$deftextbook->id}}">
                                <input type="hidden" name="classId" value="{{$class}}">
                                <button type="submit" style="border:2px blue none;"><a class="fa fa-pencil-square-o">&ensp;新增課程筆記</a></button>
                            </form>
                    </div>
                    <p></p>

{{--                    <table width="100%" style="height:auto;">--}}
{{--                        <tr><td>--}}
                                <div class="fixed-bottom" align="right">
                                    <input readonly="readonly" id="page" value="" style="color: #be2617;text-align: center;" SIZE={{strlen(count($images))}}>&ensp;/&ensp;{{count($images)}}&ensp;,
                                    <button onclick="bookimg('-')" id="up" class="btn btn-danger btn-sm">上一頁</button>
                                    <button onclick="bookimg('+')" id="down" class="btn btn-danger btn-sm">下一頁</button>
                                </div>
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}

                    <table align="center" width="95%">
                        <tr><td width="15%"></td>
                            <td width="70%">
                                <form id="json" name="json">
                                    <div style="display:none">
                                        id：<input name="id" id="id" value="{{$id}}"><br>
                                        {{--        課程：<input name="class" id="class" value="{{$class}}"><br>--}}
                                        課程：<input name="class" id="class" value=""><br>
                                        筆記名稱：<input name="notename" id="notename" value="{{$name}}"><br>
                                        <img id="jsonimg" width="220" height="277"
                                             src="" alt="">
                                    </div>

                                    <title>{{$name}}</title>

                                    <h5 align="center">
                                        筆記名稱：{{$name}}&ensp;|&ensp;
                                        作者：{{$author}}
                                    </h5>

                                    <div style="display:none">
                                        <input readonly="readonly" id="call" name="call" value="{{$json}}">
                                    </div>
                                </form>
                            </td>
                            <td align="right" width="15%">
                                    <p><button style="outline: none;border-radius: 25px;padding:5px 15px;"
                                       onclick="opentext()">開啟文字方塊</button></p>
                            </td>
                        </tr>
                    </table>


                    <div style="position: relative;" id="above">
                    <div align="center">
                        @if($textbookId!==null)
                            <canvas id="note" width="1000" height="1413" style="background-image:url('{{asset('/images/'.$textbook->name.'/'.$images[0])}}');background-repeat:no-repeat; background-size:contain;"></canvas>
                        @elseif($textbookId===null)
                            <canvas id="note" width="1000" height="1413" style="height:auto;"></canvas>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <style>
        canvas {
            border: 1px solid black;
            width: 1000px;
            height: 1413px;
        }
        body{
            background: #F0F0F0;
        }
        .btn-hover:hover {
            background: #f95738;
        }
    </style>

    <script>
        let imagePage = 1;
        let isloading = false;
        let nowPage = 1;
        let jsonStash = [];
        let wordareaStash = [];

        @if($textbookId!==null)
            @if(count($images)> 0)
            // document.getElementById("page").value=`${nowPage}`;

            if (typeof nowPage !== 'undefined') {
                document.getElementById("page").value=`${nowPage}`
            }else{
                document.getElementById("page").value= 1
            }
            @endif
        @endif
        @if($textbookId===null)
            @if($images> 0)
            // document.getElementById("page").value=`${nowPage}`;

            if (typeof nowPage !== 'undefined') {
                document.getElementById("page").value=`${nowPage}`
            }else{
                document.getElementById("page").value= 1
            }
            @endif
        @endif
        window.addEventListener("load", function (){

            var test=document.json.call.value;

            let objsonNow=JSON.parse(test);
            for (var i = 0; i < objsonNow.length ; i++) {
                jsonStash[i] = objsonNow[i];
                wordareaStash[i] = objsonNow[i][3];
            }
            let objson = objsonNow[0];


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
                // context.font = "30px Arial";
                // context.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                var l = JSON.stringify(objson[0][j].form);
                var length =l.length;
                if(length===7){
                    console.log("是");
                    context.font = "30px Arial";
                    context.fillStyle=objson[0][j].color;
                    context.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                }
                else if (length!==7){
                    console.log("否");
                    context.font = objson[0][j].form;
                    context.fillStyle=objson[0][j].color;
                    context.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                }
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
            textarea.value = objson[3];
        },false);


        @if($textbookId!==null)
            const base = '{{ asset('/images/'.$textbook->name) }}';
            let images = [];
            compute();
            const totalPage = {{ count($images) }};

        @endif

        check();

        function compute() {
            @foreach($images as $row)
            images.push('{{$row}}');
            @endforeach
        }

        function check() {
            if (nowPage === 1){
                document.getElementById("up").disabled = true;
            }
            if (nowPage === totalPage){
                document.getElementById("down").disabled = true;
            }
            if (nowPage !== 1 && nowPage !== totalPage){
                document.getElementById("up").disabled = false;
                document.getElementById("down").disabled = false;
            }
        }
        function bookimg(symbol) {
            const note = document.getElementById('note');
            const context = note.getContext('2d');

            context.clearRect(0,0,note.width,note.height);
            textarea.value = '';

            if (symbol === '-'){
                if (nowPage > 1){
                    nowPage -= 1;
                    @if($textbookId!==null)
                        let a = base + "/" + images[nowPage - 1];
                        document.getElementById('note').style.backgroundImage=`url(${a})`;
                    @endif
                    document.getElementById("page").value = nowPage;
                    changeJson(nowPage - 1);
                    check();
                }
            }
            if (symbol === '+'){
                if (nowPage < totalPage){
                    nowPage += 1;
                    @if($textbookId!==null)
                        let a = base + "/" + images[nowPage - 1];
                        document.getElementById('note').style.backgroundImage=`url(${a})`;
                    @endif
                    document.getElementById("page").value = nowPage;
                    check();
                    changeJson(nowPage - 1);
                }
            }
        }
        function changeJson(index) {
            document.getElementById("page").value=`${index+1}`;
            const objson=jsonStash[index];
            const note = document.getElementById('note');
            const context = note.getContext('2d');
            textarea.value = wordareaStash[index];

            for(var k=0;k<objson[2].length;k++){
                document.json.jsonimg.src="{{asset('images/')}}"+"/"+objson[2][k].path[0]
                var img = new Image();
                img.src=document.json.jsonimg.src;
                console.log(document.json.jsonimg.src)
                context.drawImage(img, objson[2][k].location[0], objson[2][k].location[1]);

            }
            for(var j=0 ; j < objson[0].length ; j++){
                // context.font = "30px Arial";
                // context.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                var l = JSON.stringify(objson[0][j].form);
                var length =l.length;
                if(length===7){
                    console.log("是");
                    context.font = "30px Arial";
                    context.fillStyle=objson[0][j].color;
                    context.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                }
                else if (length!==7){
                    console.log("否");
                    context.font = objson[0][j].form;
                    context.fillStyle=objson[0][j].color;
                    context.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                }
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
        }

        let textarea = document.createElement('textarea');
        textarea.value='';
        textarea.style="resize:none";
        textarea.style.width='1000px';
        textarea.style.height='1413px';

        let isOpen = 0;
        let wordarea=[];
        function opentext(){
            console.log("1");
            if(isOpen === 0) {
                // textarea = document.createElement('textarea');
                // document.body.appendChild(textarea);
                isOpen = 2;
                var list=document.getElementById("above")
                list.insertBefore(textarea,list.childNodes[0]);
                note.style.display="none";

            } else {
                if (isOpen == 1) {
                    textarea.hidden = false;
                    isOpen = 2;
                    var list=document.getElementById("above")
                    list.insertBefore(textarea,list.childNodes[0]);
                    note.style.display="none";
                    textarea.style.display="block";
                }
                else {
                    textarea.hidden = true;
                    isOpen = 1;
                    textarea.style.display="none";
                    note.style.display="block";
                }
            }
        }
    </script>

@endsection
