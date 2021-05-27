@extends('layouts.teacher.main')

@section('content')
    <style>
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
            width: 200px;
        }
        #scrollDiv{
            display: inline-block;
            float: left;
            overflow-x: auto;
            white-space:nowrap;
        }

    </style>

    <table border="1">
        <tr>
            <td>
                <a href="#"><span>test</span></a>
            </td>
            <td>
                <a href="#"><span>test</span></a>
            </td>
            <td>
                <a href="#"><span>test</span></a>
            </td>
            <td>
                <a href="#"><span>test</span></a>
            </td>
            <td>
                <a href="#"><span>test</span></a>
            </td>
            <td>
                <a href="#"><span>test</span></a>
            </td>
            <td>
                <a href="#"><span>test</span></a>
            </td>

        </tr>
    </table>

    <title>Hello, world!</title>

    <h1>Hello, world!</h1>
    <!-- 選擇年度 -->
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            選擇年度
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="">Action</a>
        </div>
    </div>



@endsection


