<meta name="viewport" content="width=device-width, initial-scale=1">
<div style="padding:20px;margin-top:30px;">
    <title>新增筆記</title>
    <h1>新增筆記　<button onclick="addeditor()"><i class="fas fa-plus"></i></button></h1>

    @if ($message = Session::get('alert'))
        <script>alert("{{ $message }}");</script>
    @endif

    <div id="addpeo" style="display:none">
        <form>
            列出同班同學名稱：
            <select>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
            @foreach($classmate as $classmates)
                {{$classmates}} <input type="checkbox">
            @endforeach
        </form>
    </div>

    <div style="display:none">
        <img id="scream" width="220" height="277"
             src="{{asset('images/uccu/uccu1.jpg')}}" alt="m">
    </div>

    <form id="json" name="json" method="POST" action="/notes" enctype="multipart/form-data">
        @csrf
        @method('POST')
        課程：
        <select id="class" name="class">

                @foreach($coursename as $coursenames)
                  <option>  {{$coursenames}} </option>
                @endforeach
                  <option>  無分類 </option>

        </select><br>
        筆記名稱：<input name="notename" id="notename"><br>



        <div style="display:none">
            <input name="json" id="json">
            <img id="jsonimg" width="220" height="277"
                 src="" alt="">

        </div>

        <button onclick="add()" id="send" name="send" type="submit">save</button>

        <div style="display: none">
            <input name="valuetojs" value="testsendvalue">
        </div>

    </form>

    文字：<input id="word" type="checkbox">
    插圖：<input id="pic" type="checkbox">


    <button><div id="clear">清空畫布</div></button>

{{--    <button onclick="save()">儲存</button>--}}

    <p id="demo"></p>

    <button onclick="opentext()">開啟文字方塊</button><br>
    <div id="addpa"><button id="firstpage" value="1">1</button></div>
    <button id="addpage">+</button>
    <div style="position: relative">
        <div align="left">
            <input readonly="readonly" id="page" value="" style="color: #be2617;text-align: center;" SIZE=1>&ensp;/&ensp;5&ensp;,
            <button onclick="changep()" id="num" class="btn btn-danger btn-sm">1</button>
{{--            第--}}
{{--            @for($i=0;$i<count($images);$i++)--}}
{{--                <button onclick="bookimg({{$i+1}})" id="num" class="btn btn-danger btn-sm">{{$i+1}}</button>--}}
{{--            @endfor頁--}}
        </div>

    <div style="position: relative;" id="above">
        <canvas id="note" width="1191" height="1684" style="position: absolute; left: 0; top: 0; z-index: 3;"></canvas>
        {{--    background-image:url({{asset('images/uccu/uccu1.jpg')}});--}}
        <canvas id="textlayer" width="1191" height="1684"
                style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas>
        <canvas id="imglayer" width="1191" height="1684"
                style="position: absolute; left: 0; top: 0; z-index: 1; background-image:url({{asset('images/uccu/uccu1.jpg')}}); "></canvas>
    </div>

    <canvas id="c2" width="1191" height="1684"></canvas>

</div>

<div class="tool" id="toolid">
    <a href="#about"><i class="fas fa-highlighter"></i> 螢光筆</a>
    <form style="margin:0" id="penform" name="penform">
        <a><input name="pen" id="pen" type="range" min="1" max="20" step="1" value="2"></a>
        <a><input readonly="readonly" name="penvalue" id="penvalue" size="1" style="text-align:center"></a>
        <a><input type="color" name="pencolor" id="pencolor" value="#000000"></a>
    </form>
    <a><i class="fas fa-font"></i><button onclick="textbox()" style="font-size: 17px;">文字</button><div class="textpx"><button class="textpx">
                <i class="fa fa-caret-down"></i>
            </button><div class="px">
                <form style="margin:0" id="textform" name="textform">
                    <select id="tpx">
                        <option value="" >文字大小</option>
                        <option value="14">14</option>
                        <option value="16">16</option>
                        <option value="20">20</option>
                        <option value="24">24</option>
                        <option value="32">32</option>
                        <option value="40">40</option>
                        <option value="64">64</option>
                        <option value="96">96</option>
                    </select>
                    <select id="tty">
                        <option value="" >字型設定</option>
                        <option value="Arial">Arial</option>
                        <option value="標楷體">標楷體</option>
                        <option value="新細明體">新細明體</option>
                        <option value="Arial Black">Arial Black</option>
                        <option value="Noto Sans TC">Noto Sans TC</option>
                    </select>
                    <input type="color" id="tco" value="#000000">
                </form>
            </div></div></a>

    <form style="margin:0" id="text" name="text">
        <a><input name="text" id="text"></a>
    </form>
    <a href="#clients"><i class="fas fa-eraser"></i> 橡皮擦<input id="erasere" type="checkbox"></a>

    <form style="margin:0" id="image" name="image" method="POST" action="/image" enctype="multipart/form-data" onsubmit="return imgtocanvas(e)">
        @csrf
        @method('POST')
        <a><i class="fas fa-camera"></i> 圖片<input type="file" name="img" id="imgup" accept="image/*;" capture="camera" ></a>
        <div style="display:none">
            <button id="to" name="to" type="submit" value="send"></button>
        </div>
    </form>
    <a href="/"><i class="fas fa-home home" style="color:#FFFFFF"></i></a>
    <a href="javascript:void(0);" class="icon" onclick="hidd()"><i class="fa fa-bars"></i></a>
</div>
{{--<textarea id="myTextarea" style="resize:none;width:1191px;height:1684px;">--}}
{{--        文字方塊測試~--}}
{{--    </textarea>--}}

<style>
    canvas {
        width: 1191px;
        height: 1684px;
    }

    body{
        background: #F0F0F0;
    }

    .tool {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        z-index: 4;
        background-color: #88A0A8;
        position: fixed;
        top: 0;
        width: 100%;
    }
    .tool a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .tool a:hover {
        background-color: #ddd;
        color: black;
    }

    .tool a.active {
        background-color: #4CAF50;
        color: white;
    }

    .tool .icon {
        display: none;
    }

    .tool button {
        background-color:transparent;
        border-style:none;
        color:white;
    }
    .tool button:hover {
        background-color: #ddd;
        color: black;
    }

    @media screen and (max-width: 600px) {
        .tool a:not(:first-child) {display: none;}
        .tool a.icon {
            float: right;
            display: block;
        }
    }
    @media screen and (max-width: 600px) {
        .tool.responsive {
            position: fixed;
            top: 0;
            width: 100%;}
        .tool.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }
        .tool.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
    }
    .home{
        float: right;
    }

    .px {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .px p{
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        z-index: 5;
    }

    .textpx:focus-within .px{
        display: block;
    }

</style>
<script>

    let isDrawing = false;
    let x = 0;
    let y = 0;

    const note = document.getElementById('note');
    const context = note.getContext('2d');
    const textlayer = document.getElementById('textlayer');
    const textcontext = textlayer.getContext('2d');
    const imglayer = document.getElementById('imglayer');
    const imgcontext = imglayer.getContext('2d');

    let textarea = document.createElement('textarea');
    textarea.value='';
    textarea.style="resize:none";
    textarea.style.width=1191;
    textarea.style.height=1684;

    let nowPage = 1;

    document.getElementById("page").value=`${nowPage}`;

    note.addEventListener('mousedown', e => {
        x = e.offsetX;
        y = e.offsetY;
        isDrawing = true;

        if (erasere.checked&&note.click) {
            for (var i = 0; i < lines.length; i++) {
                if (x >= lines[i].start[0] && x <= lines[i].end[0]&&y<=lines[i].start[1]+5&&y>=lines[i].start[1]-5) {
                    context.globalAlpha = 1;
                    context.lineWidth = document.penform.pen.value;
                    context.strokeStyle = "#ffffff";
                    var w=+lines[i].width[0];
                    context.lineWidth=w+1;
                    context.globalCompositeOperation="destination-out";
                    context.beginPath();
                    context.moveTo(lines[i].start[0], lines[i].start[1]);
                    context.lineTo(lines[i].end[0], lines[i].end[1]);
                    context.stroke();
                    context.closePath();
                    lines.splice(i, 1);
                    isDrawing = false;
                }
            }
            for(var j=0; j<textarr.length; j++){
                if(x<=textarr[j].location[0]+textarr[j].width&&x>=textarr[j].location[0]&&y<=textarr[j].location[1]&&y>=textarr[j].location[1]-textarr[j].height){
                    textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height, textarr[j].width, textarr[j].height+11);
                    textarr.splice(j, 1);
                    isDrawing = false;
                }
            }
            for(var k=0; k<picarr.length; k++){
                if(x<=picarr[k].location[0]+picarr[k].width[0]&&x>=picarr[k].location[0]&&y>=picarr[k].location[1]&&y<=picarr[k].location[1]+picarr[k].height[0]){
                    imgcontext.clearRect(picarr[k].location[0], picarr[k].location[1], picarr[k].width, picarr[k].height);
                    picarr.splice(k, 1);
                    isDrawing = false;

                }
            }
        }

        else if (isDrawing === true && erasere.checked===false ) {
            drawLine(context, x, y, e.offsetX, e.offsetY);
            x = e.offsetX;
            y = e.offsetY;
        }
    });

    note.addEventListener('mousemove', e => {
        if (erasere.checked===true||word.checked===true||pic.checked===true) {
            isDrawing = false;

        }

    });

    let lines = []
    window.addEventListener('mouseup', e => {
        if (isDrawing === true && erasere.checked===false && word.checked===false&&pic.checked===false) {
            drawLine(context, x, y, e.offsetX, e.offsetY);


            if (x !== e.offsetX) {

                const line = {
                    start: [x, y],
                    end: [e.offsetX, y],
                    color:[document.penform.pencolor.value],
                    width:[document.penform.pen.value]
                }
                lines.push(line)
            }
        }
        if(erasere.checked===false&&note.click&& word.checked===true&& pic.checked===false) {
            for (var j = 0; j < textarr.length; j++) {
                if(x<=textarr[j].location[0]+textarr[j].width&&x>=textarr[j].location[0]&&y<=textarr[j].location[1]&&y>=textarr[j].location[1]-textarr[j].height) {
                    console.log('hey tiz')

                    console.log(textarr[j].location[0])
                    console.log(textarr[j].location[1])
                    // textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height, textarr[j].width, textarr[j].height+11);
                    if(textarr[j].height>= 64){
                        textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height+25, textarr[j].width, textarr[j].height);
                    }
                    else
                    {
                        textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height, textarr[j].width, textarr[j].height+11);
                    }
                    textarr[j].location[0]=e.offsetX;
                    textarr[j].location[1]=e.offsetY;
                    console.log(textarr[j].location[0])
                    console.log(textarr[j].location[1])
                    console.log(textarr)
                    var a = JSON.stringify(textarr[j].form);
                    var length =a.length;
                    if(length===7){
                        textcontext.font = "30px Arial";
                        textcontext.fillStyle=textarr[j].color;
                        textcontext.fillText(textarr[j].text, textarr[j].location[0],textarr[j].location[1]);
                    }
                    else if (length!==7){
                        textcontext.font = textarr[j].form;
                        textcontext.fillStyle=textarr[j].color;
                        textcontext.fillText(textarr[j].text, textarr[j].location[0],textarr[j].location[1]);
                    }
                    // textcontext.font = textarr[j].form;
                    // textcontext.fillStyle=textarr[j].color;
                    // textcontext.fillText(textarr[j].text, textarr[j].location[0],textarr[j].location[1]);
                    textarr[j].width = textcontext.measureText(textarr[j].text).width;
                    textarr[j].height = parseInt(textcontext.font.match(/\d+/), 10);
                }
            }
        }

        if(erasere.checked===false&&note.click&& word.checked===false&& pic.checked===true) {
            for (var k = 0; k < picarr.length; k++) {
                if(x<=picarr[k].location[0]+picarr[k].width[0]&&x>=picarr[k].location[0]&&y>=picarr[k].location[1]&&y<=picarr[k].location[1]+picarr[k].height[0]) {
                    console.log('hey mochi')

                    console.log(picarr[k].location[0])
                    console.log(picarr[k].location[1])
                    imgcontext.clearRect(picarr[k].location[0], picarr[k].location[1], picarr[k].width, picarr[k].height);
                    picarr[k].location[0]=e.offsetX;
                    picarr[k].location[1]=e.offsetY;
                    console.log(picarr[k].location[0])
                    console.log(picarr[k].location[1])
                    console.log(picarr)


                    document.json.jsonimg.src="{{asset('images/')}}"+"/"+picarr[k].path[0]
                    var img = new Image();
                    img.src=document.json.jsonimg.src;
                    imgcontext.drawImage(img, picarr[k].location[0], picarr[k].location[1]);


                }
            }
        }

        else {
            x = 0;
            y = 0;

        }
        isDrawing = false;

    });
    note.addEventListener('touchstart', e => {
        document.getElementById("demo").innerHTML = "手機";
    });

    function drawLine(context, x1, y1, x2, y2) {
        context.beginPath();
        context.moveTo(x1, y1);
        context.lineTo(x2, y1);

        if(word.checked===false&&pic.checked===false) {
            context.stroke();
            context.closePath();
        }
    }


    let linetext= []
    function add(){
        linetext.push(textarr)
        linetext.push(lines)
        linetext.push(picarr)
        // wordarea.push(textarea.value)
        // linetext.push(wordarea)
        linetext.push(textarea.value)

        var linestr = JSON.stringify(linetext);
        console.log(linestr)

        let finalJson = [];
        finalJson[0]= JSON.parse(linestr);
        document.json.json.value = JSON.stringify(finalJson);

    }
    //new
    let textarr = []

    function textbox() {
        const dspace = document.text.text.value.replace(/^\s*|\s*$/g,"");
        if(dspace!=="") {
            const note = document.getElementById('note');
            const context = note.getContext('2d');
            const word = {
                location: [50, 50],
                text: [dspace],
                form:[document.textform.tpx.value + "px " + document.textform.tty.value],
                color:[document.textform.tco.value]
            }
            textarr.push(word)
            console.log(textarr)

            // textcontext.font = "30px Arial";
            if(document.textform.tpx.value===""||document.textform.tty.value===""){
                textcontext.font = "30px Arial";
            }
            else {
                textcontext.font = document.textform.tpx.value + "px " + document.textform.tty.value;
            }
            textcontext.fillStyle=document.textform.tco.value;
            textcontext.fillText(dspace, 50, 50);
            word.width = textcontext.measureText(word.text).width;
            word.height =parseInt(textcontext.font.match(/\d+/), 10);
        }
    }

    clear.addEventListener('click',function(){
        const note = document.getElementById('note');
        const context = note.getContext('2d');
        context.clearRect(0,0,note.width,note.height);
    });

    function save() {
        const note = document.getElementById('note');
        var dataURL=note.toDataURL('image/png');
        const link = document.createElement('a');
        link.innerText = '下載圖片';
        link.href = dataURL;
        link.download = 'download.png';
        document.body.appendChild(link);

    }


    window.onload = function() {

    }

    function hidd() {
        var x = document.getElementById("toolid");
        if (x.className === "tool") {
            x.className += " responsive";
        } else {
            x.className = "tool";
        }
    }


    function addeditor(){
        document.getElementById("addpeo").style.display="block";
    }

    // var opent = document.getElementById("note"),
    let isOpen = 0;
    let wordarea=[];
    function opentext(){

        if(isOpen === 0) {
            // textarea = document.createElement('textarea');
            // document.body.appendChild(textarea);
            isOpen = 2;
            var list=document.getElementById("above")
            list.insertBefore(textarea,list.childNodes[0]);
            note.style.display="none";
            textlayer.style.display="none";
            imglayer.style.display="none";

        } else {
            if (isOpen == 1) {
                textarea.hidden = false;
                isOpen = 2;
                var list=document.getElementById("above")
                list.insertBefore(textarea,list.childNodes[0]);
                note.style.display="none";
                textlayer.style.display="none";
                imglayer.style.display="none";
                textarea.style.display="block";
            }
            else {
                textarea.hidden = true;
                isOpen = 1;
                textarea.style.display="none";
                note.style.display="block";
                textlayer.style.display="block";
                imglayer.style.display="block";
            }
        }


        // textarea.value = "測試";
        // textarea.value='';
        // textarea.style="resize:none";
        // textarea.style.width=1191;
        // textarea.style.height=1684;

    }
    let jsonStash = [];//暫時儲存json
    let textarrStash = [];
    let linesStash = [];
    let picarrStash = [];
    let wordareaStash = [];

    var i;
    i=1;

    let pbtnarr=[];
    let moarray=[];
    addpage.addEventListener('click',function(){
        //儲存當前頁數
        pbtnarr.push(i)

        linetext.push(textarr)
        linetext.push(lines)
        linetext.push(picarr)
        linetext.push(textarea.value)
        var linestr = JSON.stringify(linetext);
        console.log("這是第"+i+"頁："+linestr);
        textarrStash[i-1] = textarr;
        linesStash[i-1] = lines;
        picarrStash[i-1] = picarr;
        wordareaStash[i-1] = textarea.value;
        jsonStash[i-1] =linestr;

        linetext = [];
        textarr = [];
        lines= [];
        picarr = [];
        textarea.value = '';

        // nowPage = num;
        nowPage=i;

        //清空
        const note = document.getElementById('note');
        const context = note.getContext('2d')
        context.clearRect(0,0,note.width,note.height);
        const textlayer = document.getElementById('textlayer');
        const textcontext = textlayer.getContext('2d');
        textcontext.clearRect(0,0,textlayer.width,textlayer.height);
        const imglayer = document.getElementById('imglayer');
        const imgcontext = imglayer.getContext('2d');
        imgcontext.clearRect(0,0,imglayer.width,imglayer.height);


        //添加新的一頁
        i=i+1;
        var pagebtn=document.createElement("button")
        var pagenum=document.createTextNode(i)
        pagebtn.appendChild(pagenum)


        console.log(pbtnarr);
        pagebtn.value=i;

        var pages=document.getElementById("addpa")
        pages.appendChild(pagebtn);
        // pages.insertBefore(pagebtn,pages.childNodes[0]);
        console.log(pagebtn.value+"-_-");

        //暫註解
        // document.getElementById('page').size=i;
        // console.log(document.getElementById('page').size);

//         console.log("陣列長度"+pbtnarr.length);
//         var pl=pbtnarr.length;
//         for(j=2;j<=pl+2;j++){
// console.log("你點的是第"+j+"個按鈕");
//
//         }
        //aaaaa
        moarray.pop();
        moarray.push(pagebtn.value);
        console.log("啦啦"+moarray);

        pagebtn.onclick = function() {
            console.log("當前點擊頁數"+pagebtn.value);
            console.log("當前點擊頁數之內容："+jsonStash[moarray-1]);
            // linetext = [];
            // textarr = [];
            // lines= [];
            // picarr = [];
            // textarea.value = '';
            console.log("啊啊上一頁是"+(moarray[0]));
            console.log("啊啊上一頁的陣列是"+(moarray-1));
            linetext.push(textarr)
            linetext.push(lines)
            linetext.push(picarr)
            linetext.push(textarea.value)
            var linestr = JSON.stringify(linetext);
            console.log("而現在是這是第"+pagebtn.value+"頁唷!");
            textarrStash[moarray-1] = textarr;
            linesStash[moarray-1] = lines;
            picarrStash[moarray-1] = picarr;
            wordareaStash[moarray-1] = textarea.value;
            jsonStash[moarray-1] =linestr;

            console.log("上一個頁面儲存的新內容"+jsonStash[moarray-1]);
            linetext = [];
            textarr = [];
            lines= [];
            picarr = [];
            textarea.value = '';

            moarray.pop();
            moarray.push(pagebtn.value)
            console.log("唷唷現在是"+(moarray[0]));
            console.log("唷唷現在是哪個陣列"+(moarray-1));

            // //儲存切換頁面前頁數內容
            // pbtnarr.push(i)
            //
            // linetext.push(textarr)
            // linetext.push(lines)
            // linetext.push(picarr)
            // linetext.push(textarea.value)
            // var linestr = JSON.stringify(linetext);
            // console.log("這是第"+i+"頁："+linestr);
            // textarrStash[nowPage - 1] = textarr;
            // linesStash[nowPage - 1] = lines;
            // picarrStash[nowPage - 1] = picarr;
            // wordareaStash[nowPage - 1] = textarea.value;
            // jsonStash[nowPage - 1] =linestr;
            //
            // linetext = [];
            // textarr = [];
            // lines= [];
            // picarr = [];
            // textarea.value = '';
            //
            // // nowPage = num;
            // nowPage=i;
            //
            // //清空
            // const note = document.getElementById('note');
            // const context = note.getContext('2d')
            // context.clearRect(0,0,note.width,note.height);
            // const textlayer = document.getElementById('textlayer');
            // const textcontext = textlayer.getContext('2d');
            // textcontext.clearRect(0,0,textlayer.width,textlayer.height);
            // const imglayer = document.getElementById('imglayer');
            // const imgcontext = imglayer.getContext('2d');
            // imgcontext.clearRect(0,0,imglayer.width,imglayer.height);

            //清空
            const note = document.getElementById('note');
            const context = note.getContext('2d')
            context.clearRect(0,0,note.width,note.height);
            const textlayer = document.getElementById('textlayer');
            const textcontext = textlayer.getContext('2d');
            textcontext.clearRect(0,0,textlayer.width,textlayer.height);
            const imglayer = document.getElementById('imglayer');
            const imgcontext = imglayer.getContext('2d');
            imgcontext.clearRect(0,0,imglayer.width,imglayer.height);

            if (typeof jsonStash[moarray-1] !== 'undefined') {
                //換到n頁時，給n頁的值
                textarr = textarrStash[moarray-1];
                lines= linesStash[moarray-1];
                picarr = picarrStash[moarray-1];
                textarea.value = wordareaStash[moarray-1];
                //json decode
                const objson=JSON.parse(jsonStash[moarray-1]);
                const note = document.getElementById('note');
                const context = note.getContext('2d');
                const textlayer = document.getElementById('textlayer');
                const textcontext = textlayer.getContext('2d');
                const imglayer = document.getElementById('imglayer');
                const imgcontext = imglayer.getContext('2d');

                for(var k=0;k<objson[2].length;k++){ // 畫圖片（第三個ARRAY）
                    document.json.jsonimg.src="{{asset('images/')}}"+"/"+objson[2][k].path[0]
                    var img = new Image();
                    img.src=document.json.jsonimg.src;
                    console.error(document.json.jsonimg.src)
                    imgcontext.drawImage(img, objson[2][k].location[0], objson[2][k].location[1]);//drawImage(image, x, y)或drawImage(image, x, y, width, height) width跟height是縮放用的
                    console.error(objson[2][k].location[0], objson[2][k].location[1]);
                }
                for(var j=0 ; j < objson[0].length ; j++){ //文字
                    var l = JSON.stringify(objson[0][j].form);
                    var length =l.length;
                    if(length===7){
                        console.log("是");
                        textcontext.font = "30px Arial";
                        textcontext.fillStyle=objson[0][j].color;
                        textcontext.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                    }
                    else if (length!==7){
                        console.log("否");
                        textcontext.font = objson[0][j].form;
                        textcontext.fillStyle=objson[0][j].color;
                        textcontext.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                    }
                }
                for(var i=0 ; i < objson[1].length ; i++){ //畫線
                    context.globalAlpha = 0.5;
                    context.lineWidth=objson[1][i].width[0]
                    context.strokeStyle = objson[1][i].color[0];
                    context.beginPath();
                    context.moveTo(objson[1][i].start[0],objson[1][i].start[1]);
                    context.lineTo(objson[1][i].end[0],objson[1][i].end[1]);
                    context.stroke();
                    context.closePath();
                }
                // linetext = [];
                // textarr = [];
                // lines= [];
                // picarr = [];
                // textarea.value = '';

                // while (moarray.length) {
                //     moarray.pop();
                // }
                // console.log("當前陣列內容"+moarray);
            }

        }
    });

    const array=[];

    function changep(){

        //儲存當前頁數
        pbtnarr.push(i)

        linetext.push(textarr)
        linetext.push(lines)
        linetext.push(picarr)
        linetext.push(textarea.value)
        var linestr = JSON.stringify(linetext);
        console.log("這是第"+i+"頁："+linestr);
        textarrStash[nowPage - 1] = textarr;
        linesStash[nowPage - 1] = lines;
        picarrStash[nowPage - 1] = picarr;
        wordareaStash[nowPage - 1] = textarea.value;
        jsonStash[nowPage - 1] =linestr;

        linetext = [];
        textarr = [];
        lines= [];
        picarr = [];
        textarea.value = '';

        // nowPage = num;
        nowPage=i;

        //清空
        const note = document.getElementById('note');
        const context = note.getContext('2d')
        context.clearRect(0,0,note.width,note.height);
        const textlayer = document.getElementById('textlayer');
        const textcontext = textlayer.getContext('2d');
        textcontext.clearRect(0,0,textlayer.width,textlayer.height);
        const imglayer = document.getElementById('imglayer');
        const imgcontext = imglayer.getContext('2d');
        imgcontext.clearRect(0,0,imglayer.width,imglayer.height);

        // var pagebtn=document.createElement("button")
        // var pagenum=document.createTextNode(i)
        // pagebtn.appendChild(pagenum)
        //
        // pagebtn.value=i;
        //
        // var pages=document.getElementById("addpa")
        // pages.insertBefore(pagebtn,pages.childNodes[0]);
        // console.log(pagebtn.value);
        //
        //
        // linetext.push(textarr)
        // linetext.push(lines)
        // linetext.push(picarr)
        // linetext.push(textarea.value)
        // var linestr = JSON.stringify(linetext);
        // console.log(linestr)
        // textarrStash[nowPage - 1] = textarr;
        // linesStash[nowPage - 1] = lines;
        // picarrStash[nowPage - 1] = picarr;
        // wordareaStash[nowPage - 1] = textarea.value;
        // jsonStash[nowPage - 1] =linestr;
        //
        // linetext = [];
        // textarr = [];
        // lines= [];
        // picarr = [];
        // textarea.value = '';
        //
        // nowPage = num;
        //
        // const note = document.getElementById('note');
        // const context = note.getContext('2d')
        // context.clearRect(0,0,note.width,note.height);
        // const textlayer = document.getElementById('textlayer');
        // const textcontext = textlayer.getContext('2d');
        // textcontext.clearRect(0,0,textlayer.width,textlayer.height);
        // const imglayer = document.getElementById('imglayer');
        // const imgcontext = imglayer.getContext('2d');
        // imgcontext.clearRect(0,0,imglayer.width,imglayer.height);

    }
</script>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script>
    $("#imgupload").change(function(){
        readURL(this);

    });

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    var imageLoader = document.getElementById('imgup');
    imageLoader.addEventListener('change', imgtocanvas, false);
    let picarr=[]

    function imgtocanvas(e){

        $("#image").ajaxSubmit(function() {
        });


        var reader = new FileReader();
        reader.onload = function(e){
            var img = new Image();
            img.onload = function(){

                imgcontext.drawImage(img,0,0,img.width,img.height);
                const pic = {
                    location: [0, 0],
                    path: [imageLoader.value.split("\\").pop()],
                    width:[img.width],
                    height:[img.height]
                }

                picarr.push(pic)
                console.log(picarr)
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    }

    pen.addEventListener("change", function (){

        for(var p=0;p<=20;p++){
            console.log(p)
            console.log(document.penform.pen.value)
            document.penform.penvalue.value=document.penform.pen.value;
            const pensize=+document.penform.pen.value;
            if (pensize === p) {
                context.globalAlpha = 0.5;
                context.globalCompositeOperation = "source-over";
                context.lineWidth = p;
                context.strokeStyle = document.penform.pencolor.value;

            }
        }

    },false);


    pencolor.addEventListener("change", function (){
        context.globalCompositeOperation = "source-over";
        document.penform.penvalue.value=document.penform.pen.value;
        context.globalAlpha = 0.5;
        context.strokeStyle = document.penform.pencolor.value;

    },false);

</script>



<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
