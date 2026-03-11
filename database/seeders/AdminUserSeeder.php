<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@xioarena.com',
            'password' => Hash::make('as'),
            'role' => 'superadmin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Moderator 1',
            'email' => 'mod1@xioarena.com',
            'password' => Hash::make('as'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        User::create([
            'name' => 'Moderator 2',
            'email' => 'mod2@xioarena.com',
            'password' => Hash::make('as'),
            'role' => 'admin',
            'status' => 'active',
        ]);
    }
}
