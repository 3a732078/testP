<?php

namespace Datamin\Factories;

use App\Models\Course;
use App\Models\Department;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Datamin\Eloquent\Factories\Factory;

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
        $teachers = Teacher::all();
        $user_id_min = User::first()->id;
        $teacher_id_min = Teacher::first()->id;
        $department_id_min = Department::first()->id;

        $courses = ['統計學','會計學','管理數學','經濟學','微積分','資料庫'];
        $classroom = [
            ['四資','四流','四工','四冷'],
            ['一','二','三'],
            ['甲','乙'],
        ];

        $ran_courses = random_int(1,6);
        $ran_teachers = random_int(1,count($teachers));
        $ran_grade = random_int(1,3);
        $ran_department = random_int(1,4);
        $ran_classroom = random_int(1,2);

        return [
            'teacher_id' => $ran_teachers + $teacher_id_min - 1 ,
            'department_id' => $ran_department + $department_id_min - 1 ,
            'name' => $courses[$ran_courses - 1 ],
            'grade' => $ran_grade ,
            'classroom' =>
                $classroom[0][$ran_department - 1].
                $classroom[1][$ran_grade - 1].
                $classroom[2][$ran_classroom - 1 ],
            'year' => random_int(106,110),
            'semeester' => random_int(1,2) ,
        ];
        //平均一學期五堂課 16(老師) * 5(年) * 2(學期) * 5(課程) = 800
    }
}
