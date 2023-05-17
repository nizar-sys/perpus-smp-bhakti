<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'username' => 'petugas',
                'name' => 'Petugas',
                'email' => 'petugas@mail.com',
                'password' => Hash::make('password'),
                'role' => 'petugas',
            ],
            [
                'username' => 'pengunjung',
                'name' => 'Pengunjung',
                'email' => 'pengunjung@mail.com',
                'password' => Hash::make('password'),
                'role' => 'pengunjung',
            ],
        ];

        User::insert($users);
    }
}
