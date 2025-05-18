<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@rewear.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1',
            'birth_date' => '1990-01-01',
            'profile_picture' => null,
            'email_verified_at' => now(),
            'remember_token' => null
        ]);

        // Create regular user
        User::create([
            'name' => 'User',
            'email' => 'user@rewear.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '089876543210',
            'address' => 'Jl. User No. 1',
            'birth_date' => '1992-05-15',
            'profile_picture' => null,
            'email_verified_at' => now(),
            'remember_token' => null
        ]);

        // Create additional test users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '081234567891',
            'address' => 'Jl. John Doe No. 1',
            'birth_date' => '1995-03-20',
            'profile_picture' => null,
            'email_verified_at' => now(),
            'remember_token' => null
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '081234567892',
            'address' => 'Jl. Jane Smith No. 1',
            'birth_date' => '1993-07-10',
            'profile_picture' => null,
            'email_verified_at' => now(),
            'remember_token' => null
        ]);
    }
} 