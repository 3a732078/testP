@extends('layouts.teacher.office.main')
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
@endsection

@section('courses_function')
    <button type="button" onclick="location.href = '{{route('teacher.courses.notices',[$course_id])}}'"class="btn btn-sm btn-outline-secondary">公告區</button>
    <button type="button" onclick="location.href = '{{route('teacher.courses.text_materials',[$course_id])}}'" class="btn btn-sm btn-primary">教材區</button>
    <button type="button" onclick="location.href = '{{route('teacher.courses.BN',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">瀏覽筆記</button>
    <button type="button" onclick="location.href = '{{route('teacher.courses.TA_office',[$course_id])}}'" class="btn btn-sm btn-outline-secondary">TA相關事務</button>
@endsection

{{-- 頁面提示 --}}
@section('header_text')
    <div class="row row-cols-2" >

        <div class="col-sm-6">
        </div>

        <div class="col-6" style="margin-top: 10px;">
            <h6 style="margin-left: 15px">
                正在【辦公室】環境
            </h6>
        </div>

        <div class="col-sm-6">
        </div>

        <div class="col-sm-6">
            <button type="button"
                    class="btn btn-warning  "
                    onclick="location.href='{{route('teacher.courses.TA_office',[$course_id,])}}'"
                    style="padding: 0px 30px 0 30px">  教室 <i class="fas fa-hand-point-left"></i> 辦公室  </button>
        </div>
    </div>
@endsection


{{-- Content --}}
@section('content')

    <div class="row" style="margin-top:50px;margin-left: 50px;width: auto ; height: 1000px">

        <div class="col-auto">

            <div class="card border-left-warning mb-3" style="width: 1000px;height: auto">

                {{--Header --}}
                <div class="card-header bg-gray-700 border-success">
                    <h4 style="color: #dae0e5 ">
                        @php
                            $course = \App\Models\Course::find($course_id);
                        @endphp
                        {{$course -> name}}【{{$course -> classroom}}】
                    </h4>
                </div>

                {{-- Body --}}
                <div class="card-body text-success bg-gray-200" style="height: 300px">
                    @php
                        $text_materials = \App\Models\Course::find($course_id)
                            ->textbooks()->get();
                    @endphp

                    @if(count($text_materials) == 0)

                        <h5>
                            尚未放入任何教材
                        </h5>

                    @else

                        <table class="table">

                            {{-- head --}}
                            <thead>
                                <tr>
                                    <th scope="col">名稱</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>

                            {{-- Body --}}
                            <tbody>
                                @foreach($text_materials as $text_material)
                                    <tr>

                                        <th colspan="2" scope="row">{{$text_material -> name}}</th>

                                        <td colspan="2">

                                            <form method="post" action="{{route('teacher.office.courses.text_materials.delete',[$course_id,$text_material->id,])}}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-danger"
                                                >
                                                    刪除
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    @endif

                </div>

                {{-- footer --}}
                <div class="card-footer bg-gray-200 border-success">

                    {{-- 放入教材 --}}
                    <form action="{{route('teacher.office.courses.text_materials.store',[$course_id,])}}"
                          method="post"
                    >
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-auto">
                                    {{-- input --}}
                                    <label for="text_material">放入新的教材</label>
                                    <input type="file"
                                           name="toimage"
                                           class="form-control-file" id="text_material">

                                </div>

                                <div class="col-auto">
                                    <button type="submit"
                                            class="btn btn-primary"
                                    >
                                        送出
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>


                </div>
                {{-- end footer --}}

            </div>

        </div>
    </div>

@endsection

