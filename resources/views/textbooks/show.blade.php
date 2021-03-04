@extends('layouts/textbooksshow')
@section('teatext')
    <form action="/textbooks/{{$id}}" method="POST">
        @csrf
        @method('DELETE')
        <button>刪除</button>
    </form>
    @foreach($filesname as $filenamex)
        <img id="scream" width="1000" height=""
             src="{{asset('images/'.$textbookimg->name.'/'.$filenamex)}}" alt="無圖片">
    @endforeach

@endsection


