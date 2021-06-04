<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //先建立管理者帳號
        User::factory()->count(1)->create();

        $user_min_id = User::first() ->id;
        Admin::create([
            'user_id' => $user_min_id,
        ]);

        for ($i = 1 ; $i < 501 ; $i ++){
            User::factory()->count(1)->create();
        }

    }
}
