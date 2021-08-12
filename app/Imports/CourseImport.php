<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseImport implements ToModel
{

    public function model(array $row )
    {
        return new Course([
            'teacher_id' => $row[0],
            'department_id' => $row[1],
            'name' => $row[2],
            'grade' => $row[3],
            'classroom' => $row[4],
            'year' => $row[5],
            'semester' => $row[6],
        ]);
    }
}
