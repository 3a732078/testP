<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(CourseSeeder::class); // --- 建立課程

        //        ----- relatetion ----

//        $this->call(TeacherSeeder::class);

        //        ----- relatetion ----
    }
}
