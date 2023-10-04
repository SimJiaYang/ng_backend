<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insertOrIgnore([
            [
                'name' => "admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make("12121212"),
                'type' => "admin",
            ],
            [
                'name' => "user",
                'email' => "user@gmail.com",
                'password' => Hash::make("12121212"),
                'type' => "user",
            ],
        ]);
        User::factory()->count(50)->create();
    }
}