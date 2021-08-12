<?php

namespace App\Imports;

use App\Models\CourseStudent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseStudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CourseStudent([
            'student_id' => $row[0],
            'course_id' => $row[1],
        ]);
    }
}
