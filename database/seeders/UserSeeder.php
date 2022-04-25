<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'phone' => '639072203266',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Personnel',
                'email' => 'personnel@admin.com',
                'phone' => '639558076388',
                'password' => Hash::make('password'),
                'role' => 'personnel',
            ],
        ]);
    }
}
