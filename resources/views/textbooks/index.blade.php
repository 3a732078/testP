@extends('layouts/textbook')
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
            <div class="card mb-4">
                <div class="card-header">
                    <a class="fa fa-book" href="/textbook/1">教材</a>&ensp;/&ensp;
                    <a class="fa fa-edit" href="#">編輯教材</a>
                </div>

                <table width="100%" style="height:100%;">
                    <tr><td>
                        <div class="card-body" align="right">
                        <form action="/textbook/1" method="POST">
                            @for($i=0;$i<count($images);$i++)
                                @csrf
                                @method('POST')
                                <input name="num" type="submit" value="{{$i+1}}"  class="btn btn-danger btn-sm">
                            @endfor
                        </form>
                        </div>

{{--                        @foreach ($images as $image)--}}
                        <div class="divcss5" align="center">
                            <img class="card-img-top" src="/images/統計學測試/{{$images[$num-1]}}" alt="">
                        </div>
{{--                        @endforeach--}}
                </td></tr></table>
            </div>
            </div>
        </main>
    </div>
@endsection
