<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'TARANTULA',
            'email' => 'test1233@example.com',
        ]);
        User::factory()->create([
            'name' => 'BAHLIL',
            'email' => 'test23@example.com',
        ]);
        User::factory()->create([
            'name' => 'GIBRAN',
            'email' => 'test24@example.com',
        ]);
        User::factory()->create([
            'name' => 'GROUND',
            'email' => 'test25@example.com',
        ]);
    }
}
