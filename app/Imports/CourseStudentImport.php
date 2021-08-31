<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class CourseStudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $course = Course::where('name',$row[1]) -> get();
        $course = $course -> where('year',date('Y') - 1911 );

        $student = User::where('name',$row[2]) -> get() ;
        if (count($course) < 1){
            $course_id = 2;
        }else{
            $course_id = $course[0] -> id;
        }
        if ( count($student) < 1){
            $course_id = 3;
            $student_id = 4;
        }else{
            $student_id = $student[0] -> student -> id;
        }
        if ($row[1] == '課程名稱' ){
            $course_id = 1;
        }

        return new CourseStudent([
            'student_id' => $student_id ,
            'course_id' => $course_id ,
        ]);
    }
}
