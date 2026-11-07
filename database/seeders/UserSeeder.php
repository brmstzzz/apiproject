<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'         => 'Admin Store',
            'email'        => 'admin@foodstore.com',
            'password'     => Hash::make('password123'),
            'address'      => 'Jl. Jendral Sudirman No. 10',
            'house_number' => 'A-01',
            'phone_number' => '081234567890',
            'city'         => 'Jakarta',
            'roles'        => 'ADMIN',
        ]);

        User::create([
            'name'         => 'John Doe',
            'email'        => 'user@foodstore.com',
            'password'     => Hash::make('password123'),
            'address'      => 'Jl. Mawar Merah No. 45',
            'house_number' => 'B-12',
            'phone_number' => '089876543210',
            'city'         => 'Bandung',
            'roles'        => 'USER',
        ]);
    }
}