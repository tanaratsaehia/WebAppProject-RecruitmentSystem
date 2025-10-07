<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin01',
            'email' => 'admin01@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'hr',
        ]);

        User::create([
            'name' => 'admin02',
            'email' => 'admin02@gmail.com',
            'password' => Hash::make('1234'),
            'role' => 'hr',
        ]);

        User::create([
            'name' => 'user01',
            'email' => 'user01@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'user02',
            'email' => 'user02@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'user03',
            'email' => 'user03@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'user04',
            'email' => 'user04@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'user05',
            'email' => 'user05@gmail.com',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'name' => 'user06',
            'email' => 'user06@gmail.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
