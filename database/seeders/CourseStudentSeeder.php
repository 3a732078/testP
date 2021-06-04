<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Database\Seeder;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course_min_id = Course::all()->first()->id;
        $student_min_id = Student::all()->first()->id;

        $courses = Course::all();
        $students = Student::all();

        for ($i = 1 ; $i < 12346 ; $i ++){
            $ran_course = random_int($course_min_id,count($courses) + $course_min_id -1 );
            $ran_student = random_int($student_min_id,count($students) + $student_min_id -1 );

            CourseStudent::create([
                'student_id' => $ran_student,
                'course_id' => $ran_course,
            ]);
        }

//        CourseStudent::factory()->count(1600 )->create();

        // 一堂課 20 個學生左右
    }
}
