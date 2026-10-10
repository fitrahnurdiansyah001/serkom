<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Illuminate\Support\Str;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $galeris = [
            [
                'judul'      => 'Upacara Hari Senin & Penyerahan Piala Tahfidz',
                'keterangan' => 'Dokumentasi kegiatan upacara rutin hari Senin sekaligus penyerahan piala kejuaraan lomba tahfidz tingkat kecamatan kepada para siswa berprestasi.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => now()->subDays(5)->toDateString(),
            ],
            [
                'judul'      => 'Munaqosyah dan Khotmil Quran Juz 30',
                'keterangan' => 'Momen haru dan khidmat saat siswa-siswi SDIT Al-Hikmah Mangunreja mengikuti ujian publik hafalan Al-Quran di hadapan para penguji dan orang tua.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => now()->subDays(12)->toDateString(),
            ],
            [
                'judul'      => 'Perkemahan Jumat Sabtu (Perjusa) Pramuka SIT',
                'keterangan' => 'Kegiatan kepanduan Perjusa untuk melatih kemandirian, kedisiplinan, keberanian, dan kekompakan siswa di alam terbuka.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => now()->subDays(20)->toDateString(),
            ],
            [
                'judul'      => 'Peringatan Maulid Nabi dan Santunan Yatim',
                'keterangan' => 'Kemeriahan acara peringatan Maulid Nabi Muhammad SAW yang diisi dengan kegiatan tausiyah, penampilan nasyid siswa, dan berbagi dengan anak yatim.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => now()->subDays(35)->toDateString(),
            ],
            [
                'judul'      => 'Outing Class dan Kunjungan Edukasi',
                'keterangan' => 'Pembelajaran di luar kelas (outing class) untuk mengenalkan siswa pada lingkungan, sains, dan alam sekitar secara langsung agar belajar lebih menyenangkan.',
                'file'       => null,
                'kategori'   => 'Foto',
                'tanggal'    => now()->subDays(45)->toDateString(),
            ],
        ];

        foreach ($galeris as $data) {
            Galeri::create([
                'judul'      => $data['judul'],
                'slug'       => Str::slug($data['judul']), 
                'keterangan' => $data['keterangan'],
                'file'       => $data['file'],
                'kategori'   => $data['kategori'],
                'tanggal'    => $data['tanggal'],
            ]);
        }
    }
}
