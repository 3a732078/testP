<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Department;
use App\Models\Teacher;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseImport implements ToModel
{

    public function model(array $row  )
    {
        if ($row[0] == '#'){
            $i = 0;
        }else{
            $i = $row[0];
        }
        if ($row[1] == '教師名稱'){
            $teacher_id = 1;
        }else{
            if (User::where('name',$row[1]) -> first() == null){
                $teacher_id = 1;
            }else{
                $teacher_id = User::where('name',$row[1]) -> first() -> teacher -> id;
            }
        }

        if (User::where('name',$row[1]) -> first() == null){
            $course_name = $row[3].$i;
        }else{
            $course_name = $row[3];
        }

        if ($row[2] == "系所名稱"){
            $department_id  = 1;
        }else{
            if (Department::where('name',$row[2]) -> first() == null){
                $department_id = 1;
            }else{
                $department_id = Department::where('name',$row[2]) -> first() -> id;
            }
        }
        if (Department::where('name',$row[2]) -> first() == null){
            $classroom = $row[2] . $i;
        }else{
            $classroom = $row[2];
        }

        if($row[4] == '年級' ||Department::where('name',$row[2]) -> first() == null || User::where('name',$row[1]) -> first() == null){
            $grade = 1000;
        }else{
            $grade = $row[4];
        }
        switch ($grade){
            case 1:
                $CG = '一';
                break;

                case 2:
                $CG = '二';
                break;

                case 3:
                $CG = '三';
                break;

                case 4:
                $CG = '四';
                break;

            default:
                $CG = '六九';
                break;
        }

        $Y = date('Y') - 1911;
        $m = date('m');

        if ($m > 6){
            $semester = '1';
            $year = $Y;
        }else{
            $semester = '2';
            $year = $Y - 1;
        }

        return new Course([
            'teacher_id' => $teacher_id,
            'department_id' => $department_id,
            'name' => $course_name,
            'grade' => $grade,
            'classroom' => $classroom,
            'year' => $year,
            'semester' => $semester,
        ]);
    }
}
