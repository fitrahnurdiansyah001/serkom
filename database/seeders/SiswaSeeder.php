<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswas = [
            [
                'nisn' => '0081234561',
                'nama_siswa' => 'Ahmad Fauzi',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2024',
            ],
            [
                'nisn' => '0081234562',
                'nama_siswa' => 'Siti Aisyah',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2024',
            ],
            [
                'nisn' => '0081234563',
                'nama_siswa' => 'Rizky Pratama',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2024',
            ],
            [
                'nisn' => '0081234564',
                'nama_siswa' => 'Dewi Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2024',
            ],
            [
                'nisn' => '0081234565',
                'nama_siswa' => 'Muhammad Alwi',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2024',
            ],
            [
                'nisn' => '0081234566',
                'nama_siswa' => 'Nurul Hidayah',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2024',
            ],
            [
                'nisn' => '0081234567',
                'nama_siswa' => 'Dimas Anggara',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2025',
            ],
            [
                'nisn' => '0081234568',
                'nama_siswa' => 'Anisa Rahmawati',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2025',
            ],
            [
                'nisn' => '0081234569',
                'nama_siswa' => 'Fajar Sidik',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2025',
            ],
            [
                'nisn' => '0081234570',
                'nama_siswa' => 'Rina Melati',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2025',
            ],
            [
                'nisn' => '0081234571',
                'nama_siswa' => 'Yoga Pratama',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2025',
            ],
            [
                'nisn' => '0081234572',
                'nama_siswa' => 'Putri Wulandari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2025',
            ],
            [
                'nisn' => '0081234573',
                'nama_siswa' => 'Bayu Segara',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2026',
            ],
            [
                'nisn' => '0081234574',
                'nama_siswa' => 'Zahra Amelia',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2026',
            ],
            [
                'nisn' => '0081234575',
                'nama_siswa' => 'Galih Permana',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2026',
            ],
            [
                'nisn' => '0081234576',
                'nama_siswa' => 'Intan Permatasari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2026',
            ],
            [
                'nisn' => '0081234577',
                'nama_siswa' => 'Reza Pahlevi',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2026',
            ],
            [
                'nisn' => '0081234578',
                'nama_siswa' => 'Sartika Dewi',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2026',
            ],
            [
                'nisn' => '0081234579',
                'nama_siswa' => 'Ilham Ramadhan',
                'jenis_kelamin' => 'Laki-laki',
                'tahun_masuk' => '2026',
            ],
            [
                'nisn' => '0081234580',
                'nama_siswa' => 'Nabila Syakirah',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => '2026',
            ],
        ];

        foreach ($siswas as $data) {
            Siswa::create([
                'nisn'          => $data['nisn'],
                'nama_siswa'    => $data['nama_siswa'],
                'slug'          => Str::slug($data['nama_siswa']),
                'jenis_kelamin' => $data['jenis_kelamin'],
                'tahun_masuk'   => $data['tahun_masuk'],
            ]);
        }
    }
}