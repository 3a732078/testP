@extends('layouts/home')
@section('search')
    <div align="left">
        <h2 class="mt-4">{{$textbook->course->name}}▹教材▹{{$textbook->name}}</h2>
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
{{--                    {{$textbook->name}} ─&emsp;--}}
                    <a class="fa fa-book" href="/textbooks/show/{{$id}}" style="color: #2d3748">&ensp;教材</a>&ensp;/&ensp;

                    @if(\Illuminate\Support\Facades\Auth::user()->type=='老師')
                        <a class="fa fa-edit" href="#">&ensp;編輯教材</a>&ensp;/&ensp;
                    @endif

                    @if($def>0)
                        @if($newDef !== 0)
                            <a class="fa fa-thumbs-o-up" style="color:#B22222;" href="/def/{{$newDef}}">&ensp;預設筆記</a>
                        @else
                            <a class="fa fa-thumbs-o-up" style="color:#B22222;" href="/def/{{$def}}">&ensp;預設筆記</a>
                        @endif
                    @else
                        <a class="fa fa-thumbs-o-up" style="color:#B22222;" href="#" onclick="defnote()">&ensp;預設推薦筆記</a>
                    @endif

                    &ensp;/&ensp;
                    <form method="post" action="/notes/ccreate" style="margin:0px;display: inline;">
                        @csrf
                        <input type="hidden" name="textbookId" value="{{$id}}">
                        <input type="hidden" name="classId" value="{{$class}}">
                        <button type="submit" style="border:2px blue none;"><a class="fa fa-pencil-square-o">&ensp;新增教材筆記</a></button>
                    </form>
                </div>
                <p></p>
                <table width="100%" style="height:auto;">
                    <tr><td>
                        <div class="fixed-bottom" align="right">
                            <input readonly="readonly" id="page" value="" style="color: #be2617;text-align: center;" SIZE={{strlen(count($newImages))}}>&ensp;/&ensp;{{count($newImages)}}&ensp;,
                                <button onclick="bookimg('-')" id="up" class="btn btn-danger btn-sm">上一頁</button>
                                <button onclick="bookimg('+')" id="down" class="btn btn-danger btn-sm">下一頁</button>
                        </div>
                        <div class="divcss5" align="center">
                            <img class="card-img-top" id="photo" src="{{asset('/images/'.$textbook->name.'/'.$newImages[0])}}" width="800" height="1000"
                                 style="object-fit: contain;object-position: center top;" alt="">
                        </div>
                    </td></tr>
                </table>
            </div>
            </div>
        </main>
    </div>
    <script>
        let nowPage = 1;
        const totalPage = {{ count($newImages) }};
        const base = '{{ asset('/images/'.$textbook->name) }}';
        let images = [];
        compute();
        check();
        if (typeof nowPage !== 'undefined') {
            document.getElementById("page").value=`${nowPage}`
        }else{
            document.getElementById("page").value= 1
        }

        function compute() {
            @foreach($newImages as $row)
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
            if (symbol === '-'){
                if (nowPage > 1){
                    nowPage -= 1;
                    let a = base + "/" + images[nowPage - 1];
                    document.getElementById("photo").src = `${a}`;
                    document.getElementById("page").value = nowPage;
                    check();
                }
            }
            if (symbol === '+'){
                if (nowPage < totalPage){
                    nowPage += 1;
                    let a = base + "/" + images[nowPage - 1];
                    document.getElementById("photo").src = `${a}`;
                    document.getElementById("page").value = nowPage;
                    check();
                }
            }
        }

        function defnote(){
            var yes = confirm('尚無推薦筆記');

        }
    </script>
@endsection
