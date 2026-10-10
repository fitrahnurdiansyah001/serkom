<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prestasi;
use Illuminate\Support\Str;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $prestasis = [
            [
                'nama_prestasi' => 'Juara 1 Lomba MHQ (Musabaqah Hifdzil Quran) Pentas PAI',
                'tingkat'       => 'Kabupaten',
                'juara'         => 'Juara 1',
                'tahun'         => '2026',
                'deskripsi'     => 'Prestasi gemilang diraih oleh ananda dari kelas 5 pada ajang Pekan Keterampilan dan Seni Pendidikan Agama Islam (Pentas PAI) Tingkat Kabupaten Tasikmalaya.',
                'foto'          => null,
            ],
            [
                'nama_prestasi' => 'Olimpiade Sains Nasional (OSN) SD Bidang Matematika',
                'tingkat'       => 'Kecamatan',
                'juara'         => 'Juara 2',
                'tahun'         => '2025',
                'deskripsi'     => 'Diraih oleh siswa kelas 6 setelah melewati persaingan yang ketat antar SD/MI se-Kecamatan Mangunreja.',
                'foto'          => null,
            ],
            [
                'nama_prestasi' => 'Kejuaraan Pencak Silat O2SN SD',
                'tingkat'       => 'Kabupaten',
                'juara'         => 'Juara 3',
                'tahun'         => '2025',
                'deskripsi'     => 'Mendali perunggu berhasil diraih oleh delegasi ekstrakurikuler Pencak Silat pada ajang Olimpiade Olahraga Siswa Nasional (O2SN) tingkat SD.',
                'foto'          => null,
            ],
            [
                'nama_prestasi' => 'Lomba Ketangkasan Baris Berbaris (LKBB) Pramuka Penggalang',
                'tingkat'       => 'Provinsi',
                'juara'         => 'Harapan 1',
                'tahun'         => '2024',
                'deskripsi'     => 'Prestasi dari regu putra Pramuka SIT SDIT Al-Hikmah pada ajang perkemahan dan lomba ketangkasan antar gugus depan.',
                'foto'          => null,
            ]
        ];

        foreach ($prestasis as $data) {
            Prestasi::create([
                'nama_prestasi' => $data['nama_prestasi'],
                'slug'          => Str::slug($data['nama_prestasi']),
                'tingkat'       => $data['tingkat'],
                'juara'         => $data['juara'],
                'tahun'         => $data['tahun'],
                'deskripsi'     => $data['deskripsi'],
                'foto'          => $data['foto'],
            ]);
        }
    }
}
