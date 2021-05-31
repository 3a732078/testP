<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $teachers = User::where('type',"老師")->get();
//        $courses = ['統計學','會計學','管理數學','經濟學','微積分','資料庫'];
//        $ran_courses = random_int(0,7);
//        $ran_teachers = random_int(0,10);
        return [
//            'teacher_id' => 1,
//            'department_id' => random_int(1,4),
//            'name' => $this->faker->name(4),
//            'grade' => 2,
//            'classroom' => "四資三乙",
//            'year' => random_int(95,110),
//            'semeester' => 1 ,
        ];
    }
}
