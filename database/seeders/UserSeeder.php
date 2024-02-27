<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'b2m-super-admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'super-admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'b2m-admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // UserFactory
        // User::factory()->count(3)->create();

    }
}
