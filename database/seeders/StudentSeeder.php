<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //抓取所有學生資料
        $users_student = User::where('type','學生')->get();

        $classroom = [
            ['四資','四流','四工','四冷'],
            ['一','二','三']
        ];

        foreach ($users_student as $user_student){
            $ran_department = random_int(1,4);
            $ran_grade = random_int(0,2);
            $ran_courses = random_int(0,4);
            Student::create([
                'user_id' => $user_student -> id,
                'department_id' => $ran_department,
                'classroom' => $classroom[0][$ran_department - 1].$classroom[1][$ran_grade]."甲",
            ]);
        }    }
}
