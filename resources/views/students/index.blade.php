@extends('layouts/home')

{{-- TopBar left --}}
@section('header_item')

    <ul class="nav nav-tabs">

        <li class="nav-item ">
            <a class="nav-link active " aria-current="page" href='/students'>最新消息</a>
        </li>


        <li class="nav-item">
            <a class="nav-link "  href= '/students/behave'>校園行事曆</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href= '/students/system_suggest'>系統建議</a>
        </li>


    </ul>

@endsection

@section('search')
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-3" style="margin-top: 10px">
            <input type="text" placeholder="搜尋.." name="searchs" style="outline: none;width: 330px;height: 42px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-primary" style="border-radius:10px;"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
@endsection
@section('navno')
{{--    <hr class="sidebar-divider">--}}
{{--    <div class="sidebar-heading">--}}
{{--        建立--}}
{{--    </div>--}}
    <li class="nav-item" style="margin-top: -10px">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseU"
           aria-expanded="true" aria-controls="collapseU">
            <i class="fas fa-book-open"></i>
            <span style="margin-left: 3px">寫筆記</span>
        </a>
        <div id="collapseU" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">相關資訊:</h6>
                <a class="collapse-item" href="/notes/create">新增筆記</a>
                <a class="collapse-item" href="{{route('notes.mynotes')}}">筆記列表</a>
            </div>
        </div>
    </li>
@endsection
