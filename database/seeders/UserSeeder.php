<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'staff', 'doctor', 'patient'];

        foreach ($roles as $role) {
            for ($i = 1; $i <= 2; $i++) {
                DB::table('users')->insert([
                    'name' => ucfirst($role) . $i,
                    'fullname' => ucfirst($role) . ' User ' . $i,
                    'email' => $role . $i . '@clinic.com',
                    'phone' => '01234567' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'password' => Hash::make('password'),
                    'role' => $role,
                    'status' => 'A',
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
