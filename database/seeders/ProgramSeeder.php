<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'nama_program' => 'Tahfidz Al-Qur\'an (Juz 30 & 29)',
                'deskripsi'    => 'Program unggulan hafalan Al-Qur\'an dengan target minimal siswa hafal Juz 30 (Juz \'Amma) sebelum lulus, menggunakan metode bacaan yang tartil dan mutqin.',
            ],
            [
                'nama_program' => 'Bina Pribadi Islami (BPI)',
                'deskripsi'    => 'Program mentoring pembentukan karakter siswa yang qurani, mandiri, dan berakhlak mulia melalui pendampingan kelompok kecil bersama guru.',
            ],
            [
                'nama_program' => 'Pembiasaan Ibadah Yaumiyah',
                'deskripsi'    => 'Kegiatan rutin untuk menanamkan kedisiplinan ibadah, meliputi Shalat Dhuha bersama, Shalat Dzuhur berjamaah, dzikir, serta penerapan adab harian Islami.',
            ],
            [
                'nama_program' => 'Munaqosyah dan Khotmil Qur\'an',
                'deskripsi'    => 'Ujian terbuka hafalan Al-Qur\'an siswa sebagai bentuk evaluasi kualitas bacaan dan apresiasi prestasi hafalan di hadapan para penguji serta orang tua murid.',
            ],
            [
                'nama_program' => 'Outing Class & Field Trip Edukatif',
                'deskripsi'    => 'Kegiatan belajar di luar kelas yang mengintegrasikan teori tematik dengan praktik di lapangan untuk memberikan pengalaman belajar yang nyata dan menyenangkan.',
            ],
        ];

        foreach ($programs as $data) {
            Program::updateOrCreate(
                ['nama_program' => $data['nama_program']],
                [
                    'slug'      => Str::slug($data['nama_program']),
                    'deskripsi' => $data['deskripsi'],
                ]
            );
        }
    }
}