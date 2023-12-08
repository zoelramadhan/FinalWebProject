<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create ([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password'=> bcrypt('123'),
            'role' => 1,
        ]);
    }
}
