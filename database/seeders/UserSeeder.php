<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('dsadsadsa'),
            'role_id' => 1, // admin role
        ]);

        // Create Sample Users
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'phone' => '081234567891',
            'password' => Hash::make('dsadsadsa'),
            'role_id' => 2, // user role
        ]);
    }
}