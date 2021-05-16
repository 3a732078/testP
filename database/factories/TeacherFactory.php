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
        $user_id = User::where('type','老師') -> first() -> id;
        $department_id = Department::find(8) -> id ;

        return [
            'user_id' => $user_id,
            'department_id' => $department_id,
        ];
    }
}
