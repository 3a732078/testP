<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Teacher;
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
        // === 建立使用者
        $users = User::all();
        if (count($users) < 10 ){
            $this->call(DepartmentSeeder::class);
            $this->call(UserSeeder::class);
        }
        $teachers =Teacher::all();
        if (count($teachers) == 0 ){
            $this->call(TeacherSeeder::class);
        }

        $students =Student::all();
        if (count($students) == 0 ){
            $this->call(StudentSeeder::class);
        }

        // === 課程
        $courses = Course::all();
        if (count($courses) == 0 ) {
            $this->call(CourseSeeder::class); // --- 建立課程
        }

        // === 建立學生與課程
        $course_students = CourseStudent::all();
        if (count($course_students) == 0 ){
            $this->call(CourseStudentSeeder::class);
        }

        // === 建立課程公告
        $notices = Notice::all();
        if (count($notices) == 0 ) {
            $this->call(NoticeSeeder::class); // --- 公告
        }

        //        ----- relatetion ----

//        $this->call(TeacherSeeder::class);

        //        ----- relatetion ----
    }
}
