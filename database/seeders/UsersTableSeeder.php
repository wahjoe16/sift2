<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $userRecords = [
            [
                'id' => 1,
                'nik' => 'A190436',
                'nama' => 'Wahyu Hidayat',
                'email' => 'wahjoe16@gmail.com',
                'password' => '$2a$12$//4i16Wnq0Zw/YjinPM3teqgpH9QHTcqFrvUmMEuCQg4JAIExdhym',
                'level' => '1',
                'telepon' => '082240312828',
                'status_superadmin' => '1',
            ]
        ];

        User::insert($userRecords);
    }
}
