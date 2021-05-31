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

        $teachers = Teacher::all();

        for($int = 1 ; $int < 10 ; $int++){

            foreach ($teachers as $teacher){

                $ran_department = random_int(1,4);//在$classroom使用時-1
                $ran_grade = random_int(0,2);
                $ran_courses = random_int(0,4);
                $ran_class = random_int(0,1);

                Course::create([
                    'teacher_id' => $teacher -> id,
                    'department_id' => $ran_department,
                    'name' => $courses[$ran_courses],
                    'grade' => $ran_grade + 1 ,
                    'classroom' => $classroom[0][$ran_department-1].$classroom[1][$ran_grade]."甲",
                    'year' => random_int(95,110),
                    'semester' => "1",
                ]);
            }
        }
//        Course::factory()->count(20)->create();
    }
}
