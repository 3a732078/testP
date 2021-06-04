<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseStudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseStudent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $course_min_id = Course::first()->id;
        $student_min_id = Student::first()->id;

        $courses = Course::all();
        $students = Student::all();

        return [
            'student_id' => random_int(1,count($courses)) + $course_min_id - 1,
            'course_id' => random_int(1,count($students)) + $student_min_id - 1,
        ];
    }
}
