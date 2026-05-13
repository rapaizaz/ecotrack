<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin EcoTrack',
            'email' => 'admin@ecotrack.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Eco User',
            'email' => 'user@ecotrack.test',
            'password' => Hash::make('password'),
            'role' => 'user',
            'address' => 'Jl. Hijau No. 123',
            'phone' => '08123456789',
        ]);
    }
}
