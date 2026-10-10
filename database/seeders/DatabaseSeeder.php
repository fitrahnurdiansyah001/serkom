<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Seeder
        User::create([
            'name' => 'Fitrah Nurdiansyah',
            'username' => 'Fitrah',
            'email' => 'fitrah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'photo' => null,
        ]);

        User::create([
            'name' => 'BAHLIL',
            'username' => 'bahlil',
            'email' => 'bahlil@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'photo' => null,
        ]);

        User::create([
            'name' => 'GIBRAN',
            'username' => 'GIBRAN',
            'email' => 'gibran@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'photo' => null,
        ]);

        $this->call([
            ProfilSekolahSeeder::class,
            SiswaSeeder::class,
            GuruSeeder::class,
            BeritaSeeder::class,
            EkstrakurikulerSeeder::class,
            GaleriSeeder::class,
            PengumumanSeeder::class,
            PrestasiSeeder::class,
            ProgramSeeder::class,
        ]);
    }
}
