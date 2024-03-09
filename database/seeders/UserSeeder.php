<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
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
                'id' => (string) Str::uuid(),
                'name' => "sadmin",
                'email' => "sadmin@gmail.com",
                'password' => Hash::make("12121212"),
                'type' => "sadmin",
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => "admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make("12121212"),
                'type' => "admin",
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => "user",
                'email' => "user@gmail.com",
                'password' => Hash::make("12121212"),
                'type' => "user",
            ],
            [
                'id' => (string) Str::uuid(),
                'name' => "user1",
                'email' => "user1@gmail.com",
                'password' => Hash::make("12121212"),
                'type' => "user",
            ],
        ]);
        User::factory()->count(5)->create();
    }
}
