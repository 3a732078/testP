@extends('layouts/home')

@section('header_item')
    <div style="margin-right: 15px">

        <h3>{{$course -> name}}</h3>

    </div>

{{--    <div>--}}

{{--        <button type="button" onclick="location.href = '{{route('student.courses.notices',[$course -> id])}}'"class="btn btn-sm btn-primary">公告區</button>--}}
{{--        <button type="button" onclick="location.href = '{{route('student.courses.text_materials',[$course -> id])}}'" class="btn btn-sm btn-outline-secondary">教材區</button>--}}
{{--        <button type="button" onclick="location.href = '{{route('student.courses.BN',[$course -> id])}}'" class="btn btn-sm btn-outline-secondary">筆記專區</button>--}}
{{--        <button type="button" onclick="location.href = '{{route('student.courses.contact_TA',[$course -> id])}}'" class="btn btn-sm btn-outline-secondary">聯絡TA</button>--}}

{{--    </div>--}}

@endsection

@section('notice')
    <div id="layoutSidenav_content">
        <main>
            @if ($message = Session::get('alert'))
                <script>alert("{{ $message }}");</script>
            @endif
            <div class="container-fluid">
                <div class="card mb-4" style="margin-top:20px">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        公告
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>標題</th>
                                    <th>發佈者</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($notices as $notice)
                                <form  method="POST" role="form" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}

                                    <tr>
                                    <td >
                                        {{$notice -> title}}
                                    </td>
                                    <td>
                                        @if($notice->teacher_id==null)
                                            {{\App\Models\Student::where('id',$notice->ta_id)-> first()->user()->value('name')}}
                                        @elseif($notice->ta_id==null)
                                            {{\App\Models\Teacher::where('id',$notice->teacher_id)-> first()->user()->value('name')}}
                                        @endif
                                    </td>
                                    <td width="100" align="center">
                                        <form action="/notices/{{$notice->id}}" method="POST">
                                            {{ csrf_field() }}
                                            <a class="btn btn-outline-dark btn-sm" href="/notices/{{$notice->id}}" >檢視公告</a>
                                        </form>
                                    </td>
                                    </tr>
                                </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
