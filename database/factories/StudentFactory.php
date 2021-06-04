<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $classroom = [
            ['四資','四流','四工','四冷'],
            ['一','二','三'],
            ['甲','乙']
        ];

        $ran_department = random_int(1,4);
        $ran_grade = random_int(1,3);
        $ran_classroom = random_int(1,2);
        $user_id_base = User::first()->id;

        return [
            'user_id' => count(User::all()) + $user_id_base - 1 ,
            'department' => random_int(1,4),
            'classroom' =>
                $classroom[0][$ran_department - 1].
                $classroom[1][$ran_grade - 1].
                $classroom[2][$ran_classroom - 1 ],

        ];
        //學生約484人
    }
}
