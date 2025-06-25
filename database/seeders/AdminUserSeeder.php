<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@perpustakaan.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'role' => 'admin',
            'email_verified_at' => now(), // Opsional: langsung verifikasi email
        ]);
    }
}