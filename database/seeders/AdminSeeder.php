<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $adminExists = User::where('username', 'admin')->exists();

        if (!$adminExists) {
            User::create([
                'id' => 'ADM1',
                'nama' => 'Administrator',
                'username' => 'admin',
                'phone' => '081234567890',
                'email' => 'admin@grandaveline.com',
                'password' => Hash::make('admin123'), // Ganti dengan password yang aman
                'role' => 'admin',
            ]);

            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
