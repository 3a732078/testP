<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $user_id_base = User::first()->id;

        return [
            'user_id' => count(User::all() + $user_id_base - 1 ),
            'department' => random_int(1,4),
        ];
        // 總人數 500 老師約 500/31 = 16名

    }
}
