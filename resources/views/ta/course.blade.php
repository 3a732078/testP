<div class="container">
    <h2>{{$course_name}}</h2>
    <form>
        <table align="center">
            <ul class="tatable">
                <li class="table-header">
                    <div class="col col-1">班級</div>
                    <div class="col col-2">座號</div>
                    <div class="col col-3">學生姓名</div>
                    <div class="col col-4"></div>
                </li>

                @for($i = 0; $i < $count; $i++)
                    <li class="table-row">
                        <div class="col col-1"></div>
                        <div class="col col-2">我們好像沒有座號..</div>
                        <div class="col col-3"></div>
                        <div class="col col-4"><a href="questions/@php echo $stu_id[$i]; @endphp">@php echo $student_list[$i]; @endphp</a></div>
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


