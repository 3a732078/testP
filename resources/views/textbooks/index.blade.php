@extends('layouts/home')
@section('notice')
    <style>
        .divcss5{
            border:1px;
            solid:#000;
        }
        .divcss5 img{
            border:1px;
            max-height: 70%;
            max-width: 70%;
        }
    </style>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h2 class="mt-4">{{$textbook->course->name}}▹教材</h2>
            <div class="card mb-4">
                <div class="card-header">
                    {{$textbook->name}} ─&emsp;
{{--                    <a class="fa fa-book" href="/textbooks/show/{{$id}}">&ensp;教材</a>--}}
                    @if(\Illuminate\Support\Facades\Auth::user()->type=='老師')
                    <a class="fa fa-edit" href="#">&ensp;編輯教材</a>
                    &ensp;/&ensp;
                    @endif
                    @if($def>0)
                    <a class="fa fa-thumbs-o-up" style="color: 	#B22222;" href="/notes/classes/{{$def}}">&ensp;推薦的筆記</a>
                    @else
                        <a class="fa fa-thumbs-o-up" style="color: 	#B22222;" href="#" onclick="defnote()">&ensp;推薦的筆記</a>
                    @endif
                    &ensp;/&ensp;
                    <form method="post" action="/notes/ccreate" style="margin:0px;display: inline;">
                        @csrf
                        <input type="hidden" name="textbookId" value="{{$id}}">
                        <input type="hidden" name="classId" value="{{$class}}">
                        <button type="submit" style="border:2px blue none;"><a class="fa fa-pencil-square-o">&ensp;新增課程筆記</a></button>
                    </form>
                </div>

                <table width="100%" style="height:100%;">
                    <tr><td>
                        <div class="card-body" align="right">
                            <input readonly="readonly" id="page" value="" style="color: #be2617;text-align: center;" SIZE={{strlen(count($newImages))}}>&ensp;/&ensp;{{count($newImages)}}&ensp;,
                            第
                            @for($i=0;$i<count($newImages);$i++)
                                <button onclick="bookimg({{$i+1}})" id="num" class="btn btn-danger btn-sm">{{$i+1}}</button>
                            @endfor頁
                        </div>
                        <div class="divcss5" align="center">
                            <img class="card-img-top" id="photo" src="{{asset('/images/'.$textbook->name.'/'.$newImages[0])}}" width="800" height="1000"
                                 style="object-fit: contain;left: 0; top: 50px; z-index: 1;" alt="">
                        </div>
                    </td></tr>
                </table>
            </div>
            </div>
        </main>
    </div>
    <script>
        if (typeof nowPage !== 'undefined') {
            document.getElementById("page").value=`${nowPage}`
        }else{
            document.getElementById("page").value= 1
        }

        function bookimg(num) {
            nowPage = num;
            console.error(nowPage)
            //換頁內容
            const base = '{{asset('/images/'.$textbook->name)}}';
            let images = [];
            @foreach($newImages as $row)
            images.push('{{$row}}');
            @endforeach
            console.error(images.length, 123);
            let a = base + "/" + images[num - 1];
            document.getElementById("photo").src = `${a}`;
            document.getElementById("page").value=`${num}`;
        }

        function defnote(){
            var yes = confirm('尚無推薦筆記');

        }
    </script>
@endsection
