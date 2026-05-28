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
            'name' => 'Pak Tani Desa Parungserab',
            'email' => 'mitra@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'mitra',
            'phone' => '08123456789',
            'address' => 'Desa Parungserab'
        ]);
        User::create([
            'name' => 'Diska Pembeli',
            'email' => 'diska@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'pembeli',
            'phone' => '08998877665',
            'address' => 'Jl. Raya No. 1'
        ]);
    }
}