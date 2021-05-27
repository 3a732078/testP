<meta name="viewport" content="width=device-width, initial-scale=1">
<div style="padding:20px;margin-top:30px;">
    <head>

        <meta charset="utf-8">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </head>

    <h1>顯示&編輯筆記</h1>
{{--    　<button onclick="addeditor()"><i class="fas fa-plus"></i></button>--}}

{{--    <div id="addpeo" style="display:none">--}}
{{--        <form id="inn" name="inn" method="POST" action="/addass" onsubmit="return addto()">--}}
{{--            @csrf--}}
{{--            @method('POST')--}}
{{--            列出同班同學名稱：--}}
{{--            <select>--}}
{{--                <option>1</option>--}}
{{--                <option>2</option>--}}
{{--                <option>3</option>--}}
{{--                <option>4</option>--}}
{{--            </select>--}}
{{--            @foreach($classmate as $classmates)--}}
{{--                {{$classmates}} <input type="checkbox">--}}
{{--            @endforeach--}}

{{--            @php--}}
{{--                $tu=array();--}}
{{--            @endphp--}}
{{--            @if($ass!=null)--}}
{{--            @foreach($ass as $asss)--}}
{{--                {{$asss->user_id}} <input id="hey" name="hey" value="共同撰寫者為：{{$asss->user_id}}">--}}
{{--                @php--}}
{{--                $a=$asss->user_id;--}}
{{--                array_push($tu,$a);--}}
{{--                $output=implode("",$tu);--}}
{{--                echo $output;--}}
{{--                print_r($tu);--}}
{{--                $countli=count($tu);--}}
{{--                @endphp--}}
{{--            @endforeach--}}
{{--            @else--}}
{{--            @php--}}
{{--                $output=null;--}}
{{--                $countli=null;--}}
{{--            @endphp--}}
{{--            @endif--}}
{{--            @for($i = 0; $i < $count; $i++)--}}

{{--                    <div class="col col-1">@php echo $classmate[$i];@endphp</div>--}}
{{--                    <div class="col col-2"><input id="@php echo $userid[$i]; @endphp" name="addp[]" onclick="addto()" type="checkbox" value="@php echo $userid[$i]; @endphp"></div>--}}
{{--                <input name="xx" id="xx" value="@php echo $userid[$i]; @endphp">--}}
{{--                <?php--}}
{{--                $tests=$userid[$i];--}}
{{--                ?>--}}
{{--            @endfor--}}
{{--            <div style="display:none">--}}
{{--                <input name="noteid" id="noteid" value="{{$id}}">--}}
{{--            </div>--}}
{{--            <input name="uu" id="uu" value="777">--}}
{{--            <p id="inv"></p>--}}
{{--            <button name="addd" id="addd" value="送出邀請"></button>--}}
{{--        </form>--}}



{{--    </div>--}}


    加入協同者
    <button onclick="addeditor()" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
        ＋
    </button>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">協同者添加/刪除</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="addpeo">
                        <form id="inn" name="inn" method="POST" action="/addass" onsubmit="return addto()">
                            @csrf
                            @method('POST')

                            @php
                                $tu=array();
                            @endphp
                            @if($ass!=null)
                                @foreach($ass as $asss)
                                    @php
                                        $a=$asss->user_id;
                                        array_push($tu,$a);
                                        $output=implode("",$tu);
                                        $countli=count($tu);
                                    @endphp
                                @endforeach
                            @else
                                @php
                                    $output=null;
                                    $countli=null;
                                @endphp
                            @endif
                            @for($i = 0; $i < $count; $i++)

                                <div class="col">@php echo $classmate[$i];@endphp <input id="@php echo $userid[$i]; @endphp" name="addp[]" onclick="addto()" type="checkbox" value="@php echo $userid[$i]; @endphp"></div>

                                <?php
                                $tests=$userid[$i];
                                ?>
                            @endfor
                            <div style="display:none">
                                <input name="noteid" id="noteid" value="{{$id}}">
                            </div>
                        </form>



                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>

    <div style="display:none">
        <img id="scream" width="220" height="277"
             src="{{asset('images/uccu/uccu1.jpg')}}" alt="The Scream">

    </div>

    <form id="json" name="json" method="POST" action="{{ route('notes.update',$id) }}" enctype="multipart/form-data" style="margin:0px;display: inline;">
        @csrf
        @method('PATCH')

        <title>{{$name}}</title>

        <div style="display:none">
            id：<input name="id" id="id" value="{{$id}}">
            分享狀態：<input id="sharestatus" name="sharestatus" value="{{$share}}">
        </div>
        <br><br>
{{--        //下面是跟課程有關的 20210127 (先註解,之後要弄回來)--}}
        {{--    課程：<input name="class" id="class" value="{{$class}}"><br>--}}
        @if($className!==null)
            <p>
            課程：<span class="span.mark-pen"
                  style="background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">{{$className}}</span>
            </p>
        @elseif($className===null)
            <p>
            課程：<span class="span.mark-pen"
                     style="background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">無</span>
            </p>
        @endif
        筆記名稱：<input name="notename" id="notename" value="{{$name}}">&ensp;
        <div style="display:none">
{{--            入口--}}
            <input id="tbook" value="{{$textbookId}}">
        <input readonly="readonly" id="call" name="call" value="{{$json}}">
        </div>

        <div style="display:none">
{{--            出口--}}
        <input name="json" id="json">
        </div>

        <div style="display:none">
            <img id="jsonimg" width="220" height="277"
                 src="" alt="">
        </div>

        <button onclick="add()" id="send" name="send" type="submit">儲存筆記</button>
        <div style="display: none">
            <input name="valuetojs" value="testsendvalue">
        </div>

    </form>

    <form action="/notes/{{$id}}" method="POST" style="margin:0px;display: inline;">
        @csrf
        @method('DELETE')
        <div style="display: none"><button id="ydelete" name="ydelete">刪除</button></div>
    </form>
    <button onclick="dconfirm()">刪除筆記</button><br>
    <br>

{{--    ←上一頁<input id="page" value="當前頁數/總頁數">下一頁→--}}
    {{--{{$notes->links()}}//頁數--}}

    移動文字：<input id="word" type="checkbox">&ensp;,
    移動插圖：<input id="pic" type="checkbox">&emsp;


    <button><div id="clear">清空畫布</div></button>

    <button onclick="opentext()" class="btn btn-outline-info"><i class="fa fa-book" aria-hidden="true"></i></button><br>


    <button onclick="save()">儲存</button>

    <form id="share" name="share" method="POST" action="{{ route('notes.share',$id) }}" onsubmit="return shareto()">
        @csrf
        @method('PATCH')
        <div style="display:none">
            id：<input name="id" id="id" value="{{$id}}"><br>
        </div>
        <input onclick="shareto()" id="sharebox" name="share" type="checkbox" class="share">
        <label for="share" class="share"><i class="fas fa-retweet"></i></label>
        <div style="display:none"><button id="send" name="send">send</button></div>
    </form>
    <br>
    <div style="position: relative">
        @if($textbookId!==null)
        @if(count($images)> 0)
            <div class="container-fluid" align="right" style="position: absolute;display:block;right: 100px; top: -50px;">
                <input readonly="readonly" id="page" value="" style="color: gray;text-align: center;" SIZE={{strlen(count($images))}}>&ensp;/&ensp;{{count($images)}}&ensp;,
                第
                @for($i=0;$i<count($images);$i++)
                    <button onclick="bookimg({{$i+1}})" id="num" class="btn btn-danger btn-sm">{{$i+1}}</button>
                @endfor頁&emsp;
                </p>
            </div>
        @endif
        @endif
            @if($textbookId===null)
        @if($images> 0)
            <div class="container-fluid" align="right" style="position: absolute;display:block;right: 100px; top: -50px;">
                <input readonly="readonly" id="page" value="" style="color: gray;text-align: center;" SIZE={{strlen($images)}}>&ensp;/&ensp;{{$images}}&ensp;,
                第
                @for($i=0;$i<$images;$i++)
                    <button onclick="bookimg({{$i+1}})" id="num" class="btn btn-danger btn-sm">{{$i+1}}</button>
                @endfor頁&emsp;
                </p>
            </div>
        @endif
            @endif

        <div style="position: relative;" id="above">
            @if($textbookId!==null)
                <canvas id="note" width="1000" height="1413" style="position: absolute; left: 0; top: 0; z-index: 4;"></canvas>
                <canvas id="textlayer" width="1000" height="1413"
                        style="position: absolute; left: 0; top: 0; z-index: 3;"></canvas>
                <canvas id="imglayer" width="1000" height="1413"
                        style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas>
                <canvas id="textbooklayer" width="1000" height="1413"
                        style="position: absolute; left: 0; top: 0px; z-index: 1;
                            background-image:url('{{asset('/images/'.$textbook->name.'/'.$images[0])}}');background-repeat:no-repeat; background-size:contain;">
                </canvas>
            @elseif($textbookId===null)
                <div style="position: absolute;">
                    <canvas id="note" width="1000" height="1413" style="position: absolute; left: 0; top: 0; z-index: 3;"></canvas>

                    <canvas id="textlayer" width="1000" height="1413"
                            style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas>
                    <canvas id="imglayer" width="1000" height="1413"
                            style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas>
                    <img class="card-img-top" id="photo" src="" align="left"
                         style="object-fit: contain;margin-top:16px;height: auto;width: auto;" alt="">
                </div>
            @endif
        </div>

        <canvas id="c2" width="1000" height="1413"></canvas>
    </div>
</div>

<form id="comments" name="comments" method="POST" action="/comments">
    @csrf
    @method('POST')
    <br><table><tr><td>&emsp;
                新增留言&thinsp;<i class="far fa-comment-dots"></i>&ensp;
                <div style="display: none">
                    <input id="note_id" name="note_id" value="{{$id}}">
                </div></td>
            {{--留言者--}}
            <td>
                <input readonly="readonly" id="" name="" value="{{$uname}}" SIZE=10
                       style="background-color:transparent;border:0px solid;border-bottom:0.5px gray solid;">：
            </td>
            <td>
                <textarea style="resize:none; background-color:transparent; border:0.5px solid; border-color:#000000" cols="55" rows="2" id="contents" name="contents">留言內容</textarea>
            </td>
            <td>
                <button>留言</button>
            </td></tr>
    </table>
</form>
@if(count($comments)> 0)
    <hr class="sidebar-divider">&emsp;
    顯示留言 &thinsp;<i class="fa fa-comments"></i><br>
    @foreach($comments as $comment)
        <div class="container-fluid" style="margin-left:90px;">
            <table><tr>
                    {{--留言者名稱--}}
                    <td style="vertical-align:text-top;font-size:18px;">
                        <br>
                        <input readonly="readonly" id="" name="" value="{{$comment->user->name}}" style="background-color:transparent;border:0px solid;border-bottom:0.5px gray solid;"
                               SIZE={{strlen($comment->user->name)}}>：
                    </td>
                    {{--留言內容--}}
                    <td valign="top" colspan="2" width="300px"><br>
                        <textarea readonly="readonly" id="comment{{$comment->id}}"
                                  style="resize:none; background-color:transparent; border-style:dashed;" cols="100" rows="4">{{$comment->content}}</textarea>
                        {{--                        <textarea readonly="readonly" id="comment{{$comment->id}}"--}}
                        {{--                                  style="resize:none; background-color:transparent;border:0px solid;border-bottom:0.5px gray solid;" cols="100" rows="auto">{{$comment->content}}</textarea>--}}
                        <p></p>
                    </td>
                    {{--編輯留言--}}
                    <td valign="center"><br>
                        &ensp;<a class="btn btn-secondary btn-lg active btn-sm"  onclick="reply({{$comment->id}}, '')" data-toggle="collapse" href="#collapseExample{{$comment->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$comment->id}}">
                            回覆
                        </a>
                        @if ($comment->user_id == \Illuminate\Support\Facades\Auth::id())<br>
                        &ensp;<button onclick="textview('comment{{$comment->id}}')" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter">
                            編輯留言
                        </button>
                        <form action="/comments/{{$comment->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            &ensp;<button class="btn btn-danger btn-sm">刪除留言</button>
                        </form>
                        @endif
                    </td>
                </tr>

                {{--回覆留言--}}
                @foreach($replies as $reply)
                    @if($reply->comment_id==$comment->id)
                        <tr>
                            <td ></td>
                            <td valign="top" align="left" colspan="2" width="300px" style="border-bottom:0.5px gray dotted;line-height:30px;">&ensp;&ensp;
                                <i class="fa fa-angle-right"></i>&ensp;
                                {{$reply->user->name}}：
                                {{$reply->content}}&emsp;
                                <a class="btn btn-tumbir active btn-sm" style="color: #205081;border:0.5px gray solid;" data-toggle="collapse" onclick="reply({{$comment->id}}, {{$reply->id}})" href="#collapseExample{{$comment->id}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$comment->id}}">
                                    回覆</a>
                                @if ($reply->user_id == \Illuminate\Support\Facades\Auth::id())|
                                <form action="/comments/{{$reply->id}}" method="POST" style="margin:0px;display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-google btn-sm" style="color: #CB2027;border:0.5px gray solid;">刪除留言</button>
                                </form>
                                @endif
                            </td>
                            <td width="200px" >

                            </td>
                        </tr>
                    @endif
                @endforeach

                {{--回覆留言#collapseExample--}}
                <tr><td colspan="5">
                        <form method="POST" action="{{ url('/replies')}}">
                            <p>
                            <div class="collapse" id="collapseExample{{$comment->id}}">
                                @csrf
                                <div class="container-fluid" style="margin-left:118px;line-height:15px;">
                                    <i class="fa fa-angle-right"></i>&ensp;
                                    <input type="hidden" id="note_id" name="note_id" value="{{$id}}">
                                    <input type="hidden" id="comment_id" name="comment_id" value="{{$comment->id}}">
                                    <input type="hidden" id="replyId{{$comment->id}}" name="replyId" value="">
                                    <textarea style="resize:none; background-color:transparent;border:0px solid;border-bottom:0.5px gray solid;font-size:15px;line-height:15px;"
                                              cols="80" rows="2" id="reply" name="reply" placeholder="&ensp;留言內容......"></textarea>
                                    <button type="submit" class="btn btn-group btn-lg active btn-sm" style="margin-bottom:30px;">留言</button>

                                </div>
                            </div>
                            </p>
                        </form></td>
                </tr>
            </table>
        </div>
    @endforeach
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">編輯留言</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p></p>
            <div class="container-fluid">
                <form method="POST" role="form" enctype="multipart/form-data" action="{{ url('/comments/edit')}}">
                    @csrf
                    @method('POST')
                    <p><textarea name="content1" id="comment123" style="resize:none;" cols="60" rows="5"></textarea></p>
                    <input type="hidden" name="zzz" id="comment666" value="">
                    <button type="submit" class="btn btn-info pd-x-20">Update</button>
                </form>
            </div>
        </div>
    </div>
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
                <form style="margin:0" id="textform" name="textform" class="textform">
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
    <a href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a>
    <a href="/"><i class="fas fa-home home" style="color:#FFFFFF"></i></a>
    <a href="javascript:void(0);" class="icon" onclick="hidd()"><i class="fa fa-bars"></i></a>
</div>
{{--<textarea id="myTextarea" style="resize:none;width:1191px;height:1684px;">--}}
{{--        文字方塊測試~--}}
{{--    </textarea>--}}
<style>
    canvas {
        border: 1px solid black;
        width: 1000px;
        height: 1413px;
    }
    body{
        background: #F0F0F0;
    }

    /*---*/

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
        height:100px;
    }
    .tool a {
        float: left;
        display: block;
        color: #f2f2f2 !important;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .tool a:hover {
        background-color: #ddd;
        color: black !important;
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
    let imagePage = 1;
    // let isloading = false;
    let nowPage = 1;
    let jsonStash = [];
    let textarrStash = [];
    let linesStash = [];
    let picarrStash = [];
    let wordareaStash = [];
    let pimg = [];
    let textbook=document.json.tbook.value;

    let textarea = document.createElement('textarea');
    textarea.value='';
    textarea.style="resize:none";
    textarea.style.width=1000;
    textarea.style.height=1413;
    @if($textbookId!==null)
        @if(count($images)> 0)
        document.getElementById("page").value=`${nowPage}`;
        @endif
    @endif
    @if($textbookId===null)
        @if($images> 0)
        document.getElementById("page").value=`${nowPage}`;
        @endif
    @endif

    var test=document.json.call.value;
    let objsonNow=JSON.parse(test);

    for (var i = 0; i < objsonNow.length ; i++) {
        jsonStash[i] =   JSON.stringify(objsonNow[i]);
        textarrStash[i] = objsonNow[i][0];
        linesStash[i] = objsonNow[i][1];
        picarrStash[i] = objsonNow[i][2];
        wordareaStash[i] = objsonNow[i][3];
        pimg[i] = objsonNow[i][4];
    }

    if (typeof objsonNow[0][4] !== 'undefined'){
        let a = "../photo/" + pimg[0];
        document.getElementById("photo").src = `${a}`;
    }

    let objson = objsonNow[0];

    let isDrawing = false;
    let x = 0;
    let y = 0;

    const note = document.getElementById('note');
    const context = note.getContext('2d');
    const textlayer = document.getElementById('textlayer');
    const textcontext = textlayer.getContext('2d');
    const imglayer = document.getElementById('imglayer');
    const imgcontext = imglayer.getContext('2d');
    @if($textbookId!==null)
        const textbooklayer = document.getElementById('textbooklayer');
        const textbookcontext = textbooklayer.getContext('2d');
    @endif


    note.addEventListener('mousedown', e => {
        x = e.offsetX;
        y = e.offsetY;
        isDrawing = true;

        if (erasere.checked&&note.click) {
            for (var i = 0; i < lines.length; i++) {
                if (x >= lines[i].start[0] && x <= lines[i].end[0] && y <= lines[i].start[1] + 5 && y >= lines[i].start[1] - 5) {
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
            for (var j = 0; j < textarr.length; j++) {
                if (x <= textarr[j].location[0] + textarr[j].width && x >= textarr[j].location[0] && y <= textarr[j].location[1] && y >= textarr[j].location[1] - textarr[j].height) {
                    textcontext.clearRect(textarr[j].location[0], textarr[j].location[1] - textarr[j].height, textarr[j].width, textarr[j].height + 11);
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
        else if (isDrawing === true && erasere.checked===false) {
            drawLine(context, x, y, e.offsetX, e.offsetY);
            x = e.offsetX;
            y = e.offsetY;
        }
    });

    note.addEventListener('mousemove', e => {
        if (erasere.checked===true) {
            isDrawing = false;
        }
    });
    let lines=objson[1];
    window.addEventListener('mouseup', e => {
        if (isDrawing === true && erasere.checked===false && word.checked===false&& pic.checked===false) {
            drawLine(context, x, y, e.offsetX, e.offsetY);

            if (x !== e.offsetX) {

                const line = {
                    start: [x, y],
                    end: [e.offsetX, y],
                    color:[document.penform.pencolor.value],
                    width:[document.penform.pen.value]
                }

                lines.push(line)
                console.log(lines)
                console.log('1123')
            }
        }
        if(erasere.checked===false&&note.click && word.checked===true) {
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
        if(erasere.checked===false&&note.click&& pic.checked===true) {
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

    function drawLine(context, x1, y1, x2, y2) {
        context.beginPath();

        context.moveTo(x1, y1);
        context.lineTo(x2, y1);

        if(word.checked===false) {
            context.stroke();
            context.closePath();
        }
    }


    clear.addEventListener('click',function(){
        const note = document.getElementById('note');
        const context = note.getContext('2d');
        context.clearRect(0,0,note.width,note.height);

        const textlayer = document.getElementById('textlayer');
        const textcontext = textlayer.getContext('2d');
        textcontext.clearRect(0,0,textlayer.width,textlayer.height);

        const imglayer = document.getElementById('imglayer');
        const imgcontext = imglayer.getContext('2d');
        imgcontext.clearRect(0,0,imglayer.width,imglayer.height);


        jsonStash[nowPage - 1] = null;
        textarrStash[nowPage - 1]  = null;
        linesStash[nowPage - 1]  = null;
        picarrStash[nowPage - 1]  = null;
        wordareaStash[nowPage - 1] = '';

        linetext = [];
        textarr = [];
        lines= [];
        picarr = [];
        textarea.value = '';
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

    window.addEventListener("load", function (){

        for(var k=0;k<objson[2].length;k++){
            document.json.jsonimg.src="{{asset('images/')}}"+"/"+objson[2][k].path[0]
            var img = new Image();
            img.src=document.json.jsonimg.src;
            console.log(document.json.jsonimg.src)
            imgcontext.drawImage(img, objson[2][k].location[0], objson[2][k].location[1]);//drawImage(image, x, y)或drawImage(image, x, y, width, height) width跟height是縮放用的

        }
        for(var j=0 ; j < objson[0].length ; j++){
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
        if(document.json.sharestatus.value==="0"){

            document.getElementById("sharebox").checked = false;
        }
        if(document.json.sharestatus.value==="1"){

            document.getElementById("sharebox").checked = true;
        }

    },false);

    let linetext= []
    function add(){

            //暫時儲存
            linetext.push(textarr)
            linetext.push(lines)
            linetext.push(picarr)
            linetext.push(textarea.value)
            var linestr = JSON.stringify(linetext);

            textarrStash[nowPage - 1] = textarr;
            linesStash[nowPage - 1] = lines;
            picarrStash[nowPage - 1] = picarr;
            wordareaStash[nowPage - 1] = textarea.value;
            jsonStash[nowPage - 1] =linestr;

            let finalJson = [];
            //最後儲存的json
            @if($textbookId!==null)
                for (var i = 0; i < {{count($images)}}; i++) {
                    if (jsonStash[i] == null) finalJson[i] = [[],[],[],''];
                    else finalJson[i] = JSON.parse(jsonStash[i]);
                }
            @endif
            @if($textbookId===null)
                if (typeof objsonNow[0][4] === 'undefined') {
                    for (var i = 0; i < {{$images}}; i++) {
                        if (jsonStash[i] == null) finalJson[i] = [[], [], [], ''];
                        else finalJson[i] = JSON.parse(jsonStash[i]);
                    }
                }
                if(typeof objsonNow[0][4] !== 'undefined'){
                    for (var i = 0; i < objsonNow.length; i++) {
                        if (pimg[i] !== null){
                            var x = pimg[i];
                        }else{
                            var x = '';
                        }
                        if (jsonStash[i] == null)
                            finalJson[i] = [[],[],[],'',x];
                        else {
                            finalJson[i] = JSON.parse(jsonStash[i]);
                            finalJson[i][4] = x;
                        }
                    }

                }
            @endif
            console.log(finalJson)
            document.json.json.value = JSON.stringify(finalJson);
    }

    let textarr =objson[0];
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
            word.height = parseInt(textcontext.font.match(/\d+/), 10);
        }
    }

</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script>
    function score(){
        $('.move').toggleClass('slided');
        $('.hideable').toggleClass('hide').toggleClass('show');
    }
</script>

<script>
    function addto(){
        $("#inn").ajaxSubmit(function() {
        });
    }
</script>

<script>
    function shareto(){
        $("#share").ajaxSubmit(function() {
        });
    }
</script>

<script>
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
        var tests="<?php echo $output; ?>";
        console.log(tests);
        var taz="<?php echo $countli; ?>";
        console.log("陣列長度？："+taz);
        for(var i=0 ; i < taz ; i++){
            console.log(tests[i]);
            var u=tests[i];
            // console.log(document.inn.u.value);
            document.getElementById(u).checked = true;
//             if(document.inn.u.value===u){
// console.log("yes");
//                 document.getElementById("u").checked = true;
//             }
        }
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
            if (typeof objsonNow[0][4] !== 'undefined'){
                document.getElementById("photo").display="none";
            }
            @if($textbookId!==null)
                textbooklayer.style.display="none";
            @endif

        } else {
            if (isOpen == 1) {
                textarea.hidden = false;
                isOpen = 2;
                var list=document.getElementById("above")
                list.insertBefore(textarea,list.childNodes[0]);
                note.style.display="none";
                textlayer.style.display="none";
                imglayer.style.display="none";
                @if($textbookId!==null)
                    textbooklayer.style.display="none";
                @endif
                if (typeof objsonNow[0][4] !== 'undefined'){
                    document.getElementById("photo").display="none";
                }
                textarea.style.display="block";
            }
            else {
                textarea.hidden = true;
                isOpen = 1;
                textarea.style.display="none";
                note.style.display="block";
                textlayer.style.display="block";
                imglayer.style.display="block";
                if (typeof objsonNow[0][4] !== 'undefined'){
                    document.getElementById("photo").display="block";
                }
                @if($textbookId!==null)
                    textbooklayer.style.display="block";
                @endif
            }
        }


        // textarea.value = "測試";
        // textarea.value='';
        // textarea.style="resize:none";
        // textarea.style.width=1191;
        // textarea.style.height=1684;

    }


    // function invite(){
    //     const form = document.forms['inn'];
    //     // console.log(document.inn.3.id);
    //     // console.log(document.inn.inv.value);
    //     const value = form.elements.uu.name;
    //     console.log(value);
    //     const value2 = form.elements.xx.value;
    //     console.log(value2);
    //     const xc=document.getElementById("xx").value;
    //     // document.getElementById("inv").innerText="你對"+xc+"發送了邀請";
    //     // console.log(document.penform.pen.value)
    //     console.log("為"+document.inn.xx.value);
    //
    //
    //     // document.write(tests);
    // }
</script>

<script>
    function dconfirm(){
        var yes = confirm('確定刪除請按確認');

        if (yes) {
            alert('已刪除該筆記');
            var button = document.getElementById('ydelete');
            button.form.submit();
        } else {

        }

    }
</script>

<script>
    var imageLoader = document.getElementById('imgup');
    imageLoader.addEventListener('change', imgtocanvas, false);
    let picarr=objson[2]

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
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    }
    pen.addEventListener("change", function (){

        for(var p=0;p<=20;p++){
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

    function bookimg(num) {
        //獲得資源
        const note = document.getElementById('note');
        const context = note.getContext('2d');
        const textlayer = document.getElementById('textlayer');
        const textcontext = textlayer.getContext('2d');
        const imglayer = document.getElementById('imglayer');
        const imgcontext = imglayer.getContext('2d');

        linetext.push(textarr)
        linetext.push(lines)
        linetext.push(picarr)
        linetext.push(textarea.value)
        // wordarea.push(textarea.value)
        // linetext.push(wordarea)
        var linestr = JSON.stringify(linetext);

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
        // wordarea = [];

        nowPage = num;
        context.clearRect(0,0,note.width,note.height);
        textcontext.clearRect(0,0,textlayer.width,textlayer.height);
        imgcontext.clearRect(0,0,imglayer.width,imglayer.height);
        //清除文字方塊陣列

        @if($textbookId!==null)
        const base = '{{asset('/images/'.$textbook->name)}}';
        let images = [];
        @foreach($images as $row)
        images.push('{{$row}}');
        @endforeach
            imagePage={{count($images)}};
        console.error(imagePage,222);
        let a = base+"/"+images[num-1];
        document.getElementById('textbooklayer').style.backgroundImage=`url(${a})`;
        @endif

        //判斷筆記類型
        if (typeof objsonNow[0][4] !== 'undefined'){
            if (objsonNow[num-1][4]===null){
                console.error('yes')
                document.getElementById("photo").hidden = true;
            }else{
                document.getElementById("photo").hidden =false;

                let a = "../photo/" + pimg[nowPage - 1];
                document.getElementById("photo").src = `${a}`;
                // let picimg = [];
                // pimg.forEach(element=>picimg.push(element));
                }
        }
        changeJson(num - 1);
    }

    function changeJson(index) {
        if (typeof jsonStash[index] !== 'undefined') {
            document.getElementById("page").value=`${index+1}`;
            textarr = textarrStash[index];
            lines= linesStash[index];
            picarr = picarrStash[index];
            textarea.value = wordareaStash[index];
            const objson=JSON.parse(jsonStash[index]);
            // objson=JSON.parse(jsonStash[index]);
            const note = document.getElementById('note');
            const context = note.getContext('2d');
            const textlayer = document.getElementById('textlayer');
            const textcontext = textlayer.getContext('2d');
            const imglayer = document.getElementById('imglayer');
            const imgcontext = imglayer.getContext('2d');

            for(var k=0;k<objson[2].length;k++){
                document.json.jsonimg.src="{{asset('images/')}}"+"/"+objson[2][k].path[0]
                var img = new Image();
                img.src=document.json.jsonimg.src;
                imgcontext.drawImage(img, objson[2][k].location[0], objson[2][k].location[1]);//drawImage(image, x, y)或drawImage(image, x, y, width, height) width跟height是縮放用的
            }
            for(var j=0 ; j < objson[0].length ; j++){
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

    }
</script>

<script type="text/javascript">
    function textview(id) {
        document.getElementById("comment123").value =
            document.getElementById(id).value;
        document.getElementById("comment666").value = id;

    }

    function reply(commentId, replyId) {
        document.getElementById("replyId"+commentId).value = replyId;
    }
</script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>


