<html>
@include('layouts.teacher.head')

<body>

<div class="wrapper">
    <div id="one">
        <table border="1">
            <thead>
                <tr>
                    <td>
                        1
                    </td><td>
                        1
                    </td><td>
                        1
                    </td><td>
                        1
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>


@php
    $courses = \App\Models\User::find(Auth::id())->teacher()->first()->courses()->get();

    $years = array();
    foreach ($courses as $course){
        $years[$course -> id] = $course -> year;
    }
    echo $courses;
    rsort($years);
    $datas = array();
    $year_flag = 10;
    echo "<hr>";
    $i = 1;
    foreach ($years as $year){
        if ($year_flag != $year){
            $datas[$i] = $year;
        }
        $year_flag = $year;
        $i ++;
    }
        echo "<hr>";
    foreach ($datas as $data){
        echo $data . ",";
    }
@endphp


</body>
</html>





