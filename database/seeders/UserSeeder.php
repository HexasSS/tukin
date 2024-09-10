<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert superadmin user
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'daus@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'sat_juru_bayar_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'WINGDIK 100/ADISUCIPTO',
            'email' => 'adisucipto@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'sat_juru_bayar_id' => '255000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Optionally, you can add more users or admin juru bayar here
    }
}
