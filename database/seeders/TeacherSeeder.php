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
        $users_teacher = User::where('type','老師')->get();



        foreach ($users_teacher as $user_teacher){
            $department_id = random_int(1,4);
            Teacher::create([
                'user_id' => $user_teacher -> id,
                'department_id' => $department_id,
            ]);
        }
    }
}
