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
        $course_minid = Course::all()->sortBy('id')->first()->id;
        $student_minid = Student::all()->sortBy('id')->first()->id;

        $courses = Course::all();
        $students = Student::all();

        for ($i = 1 ; $i < 12346 ; $i ++){
            $ran_course = random_int($course_minid,count($courses) + $course_minid -1 );
            $ran_student = random_int($student_minid,count($students) + $student_minid -1 );
            CourseStudent::create([
                'student_id' => $ran_student,
                'course_id' => $ran_course,
            ]);
        }

//        CourseStudent::factory()->count(3000)->create();
    }
}
