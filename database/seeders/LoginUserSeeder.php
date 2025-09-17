<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoginUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'admin@gmail.com',
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ],
            [
                'email' => 'mathew@gmail.com',
                'name' => 'mathew123',
                'password' => Hash::make('qweqweqwe'),
            ],

            [
                'email' => 'Jose@gmail.com',
                'name' => 'Jose123',
                'password' => Hash::make('qweqweqwe'),
            ],



        ];

        User::upsert($users, ['email'], ['name', 'password']);
    }
}
