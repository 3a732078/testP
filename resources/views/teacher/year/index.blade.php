@extends('layouts.teacher.main')
{{--@section('header_name')--}}
{{--    --}}{{-- 直接寫入 --}}
{{--    #--}}
{{--@endsection--}}

{{-- Title --}}
@section('title')
    Elearning
@endsection

{{-- TopBar Courses--}}
@section('header_item')
{{--        @php--}}
{{--            $courses = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get();--}}
{{--            $datas = array();--}}
{{--            foreach ($courses as $courses){--}}
{{--                $$datas[$courses -> id] = $courses -> where('year','=',110);--}}
{{--            }--}}
{{--        @endphp--}}

        @php
                        $courses = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get();
        @endphp
            @if ( count($courses) > 0)
                @foreach($courses as $course)

                    <ul>
                        <li>
                            <a class="collapse-item" href='{{ $course->id }}/index' >
                                <span >
                                    {{$course -> name}}
                                </span>
                            </a>
                        </li>
                    </ul>
                @endforeach
            @endif
    @endsection

    {{-- !選擇年度 --}}
    @section('year')

        @php
            $courses = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->teacher()->first()->courses()->get();

            $years = array();
            foreach ($courses as $course){
                $years[$course -> id] = $course -> year;
            }
            rsort($years);
            $datas = array();
            $year_flag = 10;
            $i = 1;
            foreach ($years as $year){
                if ($year_flag != $year){
                    $datas[$i] = $year;
                }
                $year_flag = $year;
                $i ++;
            }
            foreach ($datas as $data){
                echo "<a class= 'collapse-item' href='index/$data'>$data </a>";

            }
    @endphp

@endsection

{{-- Content --}}
@section('content')

@endsection

