<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Make existing test user a regular user
        User::where('email', 'test@example.com')
            ->update(['role' => 'user']);
    }
}