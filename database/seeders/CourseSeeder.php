<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = ['統計學','會計學','管理數學','經濟學','微積分','資料庫'];
        $classroom = [
            ['四資','四流','四工','四冷'],
            ['一','二','三'],
            ['甲','乙'],
        ];

        $teacher_min_id = Teacher::all()->first()->id;
        $teacher_max_id = Teacher::all()->sortByDesc('id')->first()->id;

        for($int = 1 ; $int < 801 ; $int++){

            $ran_teacher_id = random_int($teacher_min_id,$teacher_max_id);
            $ran_department = random_int(1,4);//在$classroom使用時-1
            $ran_grade = random_int(1,3);
            $ran_classroom = random_int(1,2);
            $ran_courses = random_int(1,6);

            Course::create([
                'teacher_id' => $ran_teacher_id,
                'department_id' => $ran_department ,
                'name' => $courses[$ran_courses - 1 ],
                'grade' => $ran_grade + 1 ,
                'classroom' =>
                    $classroom[0][$ran_department - 1].
                    $classroom[1][$ran_grade - 1].
                    $classroom[2][$ran_classroom - 1 ],
                'year' => random_int(106,110),
                'semester' => random_int(1,2),
            ]);

        }

//        Course::factory()->count(800)->create();
    }
}
