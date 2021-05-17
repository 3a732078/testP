@extends('layouts/home')
@section('search')
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-3">
            <input type="text" placeholder="搜尋.." name="searchs" style="outline: none;width: 330px;height: 42px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
@endsection
