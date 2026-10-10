<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ekstrakurikuler;
use Illuminate\Support\Str;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        $ekskuls = [
            [
                'nama_ekskul' => 'Pramuka SIT',
                'pembina'     => 'Kak Ahmad, S.Pd.',
                'jadwal'      => 'Jumat, 13:30 - 15:00 WIB',
                'deskripsi'   => 'Ekstrakurikuler wajib untuk membentuk karakter disiplin, mandiri, ketangkasan, dan cinta tanah air berlandaskan nilai-nilai keislaman.',
                'foto'        => null
            ],
            [
                'nama_ekskul' => 'Klub Tahfidz & Tilawah',
                'pembina'     => 'Ust. Ridwan, Al-Hafidz',
                'jadwal'      => 'Selasa & Kamis, 14:00 - 15:30 WIB',
                'deskripsi'   => 'Program pendalaman hafalan dan perbaikan bacaan Al-Quran untuk mempersiapkan siswa mengikuti munaqosyah serta lomba MTQ.',
                'foto'        => null
            ],
            [
                'nama_ekskul' => 'Panahan (Archery)',
                'pembina'     => 'Coach Hendra',
                'jadwal'      => 'Sabtu, 08:00 - 10:00 WIB',
                'deskripsi'   => 'Ekstrakurikuler olahraga sunnah Rasulullah untuk melatih kefokusan, ketenangan, kesabaran, dan ketepatan sasaran siswa.',
                'foto'        => null
            ],
            [
                'nama_ekskul' => 'Pencak Silat',
                'pembina'     => 'Kang Rian',
                'jadwal'      => 'Rabu, 14:00 - 15:30 WIB',
                'deskripsi'   => 'Melatih ketahanan fisik, mental, dan keahlian beladiri siswa sekaligus melestarikan budaya asli bangsa Indonesia.',
                'foto'        => null
            ],
            [
                'nama_ekskul' => 'Futsal',
                'pembina'     => 'Pak Budi, S.Pd.',
                'jadwal'      => 'Senin, 14:00 - 15:30 WIB',
                'deskripsi'   => 'Wadah untuk menyalurkan bakat dan minat olahraga siswa guna menjaga kebugaran tubuh serta melatih kerja sama tim.',
                'foto'        => null
            ]
        ];



        foreach ($ekskuls as $data) {
            Ekstrakurikuler::create([
                'nama_ekskul' => $data['nama_ekskul'],
                'slug'       => Str::slug($data['nama_ekskul']), 
                'pembina'     => $data['pembina'],
                'jadwal'      => $data['jadwal'],
                'deskripsi'   => $data['deskripsi'],
                'foto'        => $data['foto'],
            ]);
        }
    }
}
