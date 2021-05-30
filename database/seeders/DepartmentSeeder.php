<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ["資訊管理系","流通管理系","工業工程系","冷凍工程系"];
        foreach ($names as $name){
            Department::create([
                'name' => $name,
            ]);
        }
    }
}
