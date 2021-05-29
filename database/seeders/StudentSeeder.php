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
        $students = User::where('type','學生')->get();

        foreach ($students as $student){
            $department_id = random_int(0,4);
            Student::create([
                'user_id' => $student -> id,
                'department_id' => $department_id,
                'classroom' => "四資三乙"
            ]);
        }    }
}
