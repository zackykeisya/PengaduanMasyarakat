<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'email' => 'headStaff@gmail.com',
            'role' => 'headstaff',
            'password' => Hash::make('head123'), // Password yang sudah di-hash
        ]);
        
        User::create([
            'email' => 'staff@gmail.com',
            'role' => 'staff',
            'password' => Hash::make('staff123'), // Password yang sudah di-hash
        ]);

        User::create([
            'email' => 'guest@gmail.com',
            'role' => 'guest',
            'password' => 'guest123',
        ]);
    }
}
