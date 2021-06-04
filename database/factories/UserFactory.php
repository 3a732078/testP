<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){

        $users = User::all();
        if (count($users) == 0 ){

            return[
                'account' => 'admin' ,
                'name' => $this->faker->name,
                'password' => Hash::make('1234'),
                'email' => $this->faker->unique()->safeEmail,
                'remember_token' => Str::random(10),
                'type' => "管理者",
            ];

        }else{

            //一個老師大約30個學生
            $ran_type = random_int(1,31);

            $users_max_id = User::all()->sortByDesc('id')->first() -> id;
            $ran_year = random_int(106,110);
            $ran_department = random_int(1,4);

            if ($ran_type == 1 ){
                return[
                    'account' => 'T'.$ran_year.'0'.$ran_department.$users_max_id ,
                    'name' => $this->faker->name,
                    'password' => Hash::make('1234'),
                    'email' => $this->faker->unique()->safeEmail,
                    'remember_token' => Str::random(10),
                    'type' => "老師",
                ];
            }else{
                return [
                    'account' => 'S'.$ran_year.'0'.$ran_department.$users_max_id ,
                    'name' => $this->faker->name,
                    'password' => Hash::make('1234'),
                    'email' => $this->faker->unique()->safeEmail,
                    'remember_token' => Str::random(10),
                    'type' => "學生",
                ];
            }

        }
    }
}
