<?php

namespace Database\Factories;

use App\Models\Notice;
use App\Models\Teacher;
use App\Models\Course;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoticeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $courses = Course::all()->sortByDesc('id');
        $ran_course_id = random_int(1,$courses->first()->id);

        return [
            'course_id' => $ran_course_id,
            'title' => $this->faker->name(10),
            'content' => $this->faker->paragraph
        ];
    }
}
