<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //抓取所有老師資料
        $teachers = User::where('type','老師')->get();



        foreach ($teachers as $teacher){
            $department_id = random_int(0,4);
            Teacher::create([
                'user_id' => $teacher -> id,
                'department_id' => $department_id,
            ]);
        }
    }
}
