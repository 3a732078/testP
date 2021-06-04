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
        $courses_min_id = Course::first()->id;
        $courses_max_id = Course::all()->sortByDesc('id') -> first() -> id;
        $ran_course_id = random_int($courses_min_id,$courses_max_id);

        return [
            'course_id' => $ran_course_id,
            'title' => $this->faker->text(20),
            'content' => $this->faker->paragraph
        ];
    }
}
