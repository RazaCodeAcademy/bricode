<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use facades
use Illuminate\Support\Facades\Hash;

// use models
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'User',
            'last_name' => 'Admin',
            'mobile_number' => '+923037900571',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin@321!'),
            'status' => 1,
        ]);
    }
}
