<?php

namespace Database\Seeders;

use App\Models\Department;
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

        //抓取所有學生資料
        $user_teachers= User::all()->where('type','老師');

        $department_max_id = Department::all()->sortByDesc('id')->first()->id;
        $department_min_id = Department::all()->first()->id;

        foreach ($user_teachers as $teacher){
            $ran_department = random_int( $department_min_id , $department_max_id );

            Teacher::create([
                'user_id' => $teacher -> id,
                'department_id' => $ran_department,
            ]);
        }
    }
}
