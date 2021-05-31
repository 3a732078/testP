<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Teacher;
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
        //尚未使用call

        $teachers = Teacher::all();

        $courses = ['統計學','會計學','管理數學','經濟學','微積分','資料庫'];
        $classroom = [
            ['四資','四流','四工','四冷'],
            ['一','二','三'],
            ['甲','乙'],
        ];

        $ran_courses = random_int(0,7);
        $ran_teachers = random_int(0,10);
        $ran_grade = random_int(1,3);
        $ran_department = random_int(1,4);//在$classroom使用時-1
        $ran_class = random_int(0,1);

        return [
            'teacher_id' => $teachers->fist()->id,
            'department_id' => $ran_department,
            'name' => $courses[$ran_courses],
            'grade' => $ran_grade,
            'classroom' => $classroom[0][$ran_department - 1].$classroom[1][$ran_grade - 1].$classroom[2][$ran_class] ,
            'year' => random_int(95,110),
            'semeester' => random_int(1,2) ,
        ];
    }
}
