<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Database\Factories\TeacherFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

    # [ call ]
        $users = User::all();
        if (count($users) == 0 ){
            $this->call(UserSeeder::class);
            $this->call(DepartmentSeeder::class);
            $this->call(TeacherSeeder::class);
            $this->call(StudentSeeder::class);
        }
        $courses = Course::all();
        if (count($courses) == 0 ) {
            $this->call(CourseSeeder::class); // --- 建立課程
        }

        //        ----- relatetion ----

//        $this->call(TeacherSeeder::class);

        //        ----- relatetion ----
    }
}
