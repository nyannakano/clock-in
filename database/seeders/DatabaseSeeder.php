<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Administrator::factory()->create([
            'name' => 'Admin',
            'user_id' => $user->id,
        ]);
    }
}
