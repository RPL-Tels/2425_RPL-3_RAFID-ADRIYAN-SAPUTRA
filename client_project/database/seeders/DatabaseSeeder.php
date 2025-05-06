<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123'),
            'company' => 'Company',
            'addres' => 'Indonesia, Jawa Barat',
            'number' => '08' . fake()->numberBetween(1000000000, 9999999999),
            'user_id' => 'A-' . strtoupper(str::random('4')),
            'role' => 'admin',
            'profile_photo' => '',
        ]);
    }
}
