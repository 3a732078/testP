@extends('layouts/tahome')
<title>{{$course_name}}-學生聯絡頁面</title>

@section('tanav')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>課程</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">已選課程:</h6>
{{--                @if ($count > 0)--}}
{{--                    @for($i = 0; $i < $count; $i++)--}}
{{--                        <a class="collapse-item" href="/ta/classes/@php echo $tacid[$i]; @endphp" >@php echo $tac[$i]; @endphp</a>--}}
{{--                    @endfor--}}
{{--                @endif--}}
            </div>
        </div>
    </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#textbooks"
               aria-expanded="true" aria-controls="textbookss">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>教材</span>
            </a>
            <div id="textbooks" class="collapse" aria-labelledby="textbooks"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">教材相關:</h6>
                    <a class="collapse-item" href="/textbooks/create">新增教材</a>
                    <a class="collapse-item" href="/textbooks">教材管理</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">




@endsection

@section('notice')
<div class="container">
    <h2><a href="/ta/classes/{{$classId}}"><i class="fas fa-arrow-left" style="color:#00a6a6"></i></a>{{$course_name}}<a href="/ta"><i class="fas fa-home home" style="color:#00a6a6"></i></a></h2>
    <form>
        <table align="center">
            <ul class="tatable">
                <li class="table-header .bg-info">
                    <div class="col col-1"></div>
                    <div class="col col-2 text-white">班級</div>
                    <div class="col col-3"></div>
                    <div class="col col-4 text-white">學生姓名</div>
                </li>

                @for($i = 0; $i < $count; $i++)
                    <li class="table-row">
                        <div class="col col-1"></div>
                        <div class="col col-2">@php echo $classlist[$i]; @endphp</div>
                        <div class="col col-3"></div>
                        <div class="col col-4"><a href="/ta/questions/@php echo $stu_id[$i]; @endphp">@php echo $student_list[$i]; @endphp</a></div
                    </li>
                @endfor

            </ul>
        </table>
    </form>
    {{--<form>--}}
    {{--    <table>--}}
    {{--    <tr>--}}
    {{--    <td>--}}
    {{--        課程名稱--}}
    {{--    </td>--}}
    {{--        <td>--}}
    {{--            XXX--}}
    {{--        </td>--}}
    {{--    </tr>--}}

    {{-- <tr>--}}
    {{--     <td>--}}
    {{--         <a href="#">TA姓名</a>--}}
    {{--     </td>--}}
    {{-- </tr>--}}
    {{--    </table>--}}
    {{--</form>--}}
</div>
@endsection
<style>
    /*body {*/
    /*    display: flex;*/
    /*    justify-content: center;*/
    /*    align-items: center;*/
    /*    background: #C4E1FF;*/
    /*}*/
    /*table {*/
    /*    border: 1px solid #333;*/
    /*}*/
    .container {
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 10px;
        padding-right: 10px;
        text-align: center;
    }
    h2 {
        font-size: 26px;
        margin: 20px 0;
        text-align: center;
    }

    .tatable li {
        border-radius: 3px;
        padding: 25px 30px;
        display: flex;
        justify-content: space-between;
        margin-bottom: 25px;
    }
    .table-header {
        background-color: #95A5A6;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .table-row {
        background-color: #ffffff;
        box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
    }
    .col-1 {
        flex-basis: 25%;
    }
    .col-2 {
        flex-basis: 25%;
    }
    .col-3 {
        flex-basis: 25%;
    }
    .col-4 {
        flex-basis: 25%;
    }


</style>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

