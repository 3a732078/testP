<?php

namespace Database\Factories;

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
    public function definition()
    {
        $ran = random_int(0,1);
        if ($ran == 0){
            $type = '學生';
        }else{
            $type = '老師';
        }
        return [
            'account' => $this->faker->text(10),
            'name' => $this->faker->name,
            'password' => Hash::make('1234'),
            'email' => $this->faker->unique()->safeEmail,
            'remember_token' => Str::random(10),
            'type' => $type,
        ];
    }
}
