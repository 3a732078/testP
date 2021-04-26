@extends('layouts/home')
@section('content')
    <div class="card-header">
    <div class="search-container">
        <form action="{{route('notes.search')}}" class="ml-md-5">
            <input type="text" placeholder="搜尋.." name="searchs"
                   style="width: 800px;height: 40px;margin-left:100px;border-radius:20px;padding-left: 20px">
            <button type="submit" class="btn btn-dark"><i class="fa fa-search fa-1g"></i></button>
        </form>
    </div>
    </div>
@endsection

@section('notice')
    <h4 class="mt-4">搜尋結果</h4>
    <div class="card-body">
@if($ans==true)
    @if(count($searchs)> 0)
        <div class="table-responsive">

        @foreach ($searchs as $search)
            <form method="POST" role="form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <table class="table task-table table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0"
                       style="background-color: #FFFDD0;color: #2d3748; border:2px #2d3748">
                    <thead style="background-color: #bac8f3">
                    <tr>
                        <th>標題</th>
                        <th class="mh1">引用教材</th>
                        <style type="text/css">
                            .mh1{
                                text-align:center;/** 设置水平方向居中 */
                                vertical-align:middle/** 设置垂直方向居中 */
                            }
                        </style>
                        <th class="mh1">作者</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td width="280">{{$search->title}}</td>
                    <td width="500" align="center">
                        @if($search->textbook==null)
                            無引用教材
                        @else
                            {{$search->textbook->name}}
                        @endif
                    </td>
                    <td width="500" align="center">
                        {{$search->user->name}}
                    </td>
                    <td width="170" align="center">
                        @if($search->user_id==$id)
                        <a class="btn btn-primary btn-sm" href="/notes/{{$search->id}}">檢視筆記</a>
                        @else
                        <a class="btn btn-primary btn-sm" href="/notes/classes/{{$search->id}}">檢視筆記</a>
                        @endif
                    </td>
                </tr>
                    </tbody>
                </table>
            </form>
        @endforeach
        </div>
    @else
       查無筆記
    @endif
@elseif($ans==false)

@endif
</div>
@endsection


