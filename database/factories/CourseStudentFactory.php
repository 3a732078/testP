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
        $courses = Course::all();
        $students = Student::all();

        $ran_course = random_int(1,count($courses));
        $ran_student = random_int(1,count($students));

        return [
            'student_id' => $students -> find($ran_student) -> id,
            'course_id' => $courses -> find($ran_course) -> id,
        ];
    }
}
