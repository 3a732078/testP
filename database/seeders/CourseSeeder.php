<?php

namespace Database\Seeders;

use App\Models\Course;
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
        $teachers = User::where('type',"老師")->get();

        for($int = 1 ; $int < 20 ; $int++){
                $ran_courses = random_int(1,5);
                Course::create([
                    'teacher_id' => 1,
                    'department_id' => random_int(1,4),
                    'name' => $courses[$ran_courses],
                    'grade' => "2",
                    'classroom' => "四資三乙",
                    'year' => random_int(95,110),
                    'semester' => "1",
                ]);
        }
//        Course::factory()->count(100)->create();
    }
}
