<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enum\UserRole;

class AdminStudentSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin User',
                'password' => Hash::make('qweqwe'),
                'role' => UserRole::ADMIN->value,
            ],
            [
                'email' => 'student@gmail.com',
                'name' => 'Student User',
                'password' => Hash::make('qweqwe'),
                'role' => UserRole::STUDENT->value,
            ],
             [
                'email' => 'mathew@gmail.com',
                'name' => 'Mathew User',
                'password' => Hash::make('qweqwe'),
                'role' => UserRole::STUDENT->value,
            ],
        ];

        User::upsert($users, ['email'], ['name', 'password', 'role']);
    }
}
