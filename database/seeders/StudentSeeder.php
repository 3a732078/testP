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
        $user_students = User::all()->where('type','學生');

        $classroom = [
            ['四資','四流','四工','四冷'],
            ['一','二','三'],
            ['甲','乙'],
        ];

        foreach ($user_students as $student){
            $ran_department = random_int(1,4);
            $ran_grade = random_int(1,3);
            $ran_classroom = random_int(1,2);

            Student::create([
                'user_id' => $student -> id,
                'department_id' => $ran_department,
                c
            ]);
        }

    }
}
