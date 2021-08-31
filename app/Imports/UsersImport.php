<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        $status = '使用';
        return new User([
            'account' => $row[1],
            'name' => $row[2],
            'password' => Hash::make($row[3]),
            'type' => $row[4],
            'status' => $row[5],
        ]);
    }
}
