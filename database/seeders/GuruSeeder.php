<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use Illuminate\Support\Str;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $gurus = [
            [
                'nama_guru'      => 'Ahmad Fauzi, M.Pd.I',
                'jabatan'        => 'Kepala Sekolah',
                'nip'            => '198005122005011002', // NIP/NIY (Nomor Induk Yayasan) dummy
                'mata_pelajaran' => 'Manajemen Pendidikan & PAI',
                'foto'           => null
            ],
            [
                'nama_guru'      => 'Siti Aisyah, S.Pd.',
                'jabatan'        => 'Wali Kelas 1',
                'nip'            => '199203152018012003',
                'mata_pelajaran' => 'Tematik (Guru Kelas)',
                'foto'           => null
            ],
            [
                'nama_guru'      => 'Ust. Ridwanulloh, Al-Hafidz',
                'jabatan'        => 'Koordinator Tahfidz',
                'nip'            => '199507222019031001',
                'mata_pelajaran' => 'Tahfidz & Tahsin Al-Quran',
                'foto'           => null
            ],
            [
                'nama_guru'      => 'Rina Fitriani, S.Pd.',
                'jabatan'        => 'Wali Kelas 6',
                'nip'            => '198811022014022005',
                'mata_pelajaran' => 'Tematik (Guru Kelas)',
                'foto'           => null
            ],
            [
                'nama_guru'      => 'Hendra Saputra, S.Pd.',
                'jabatan'        => 'Guru Mata Pelajaran',
                'nip'            => '199008172015041004',
                'mata_pelajaran' => 'Pendidikan Jasmani Olahraga dan Kesehatan (PJOK)',
                'foto'           => null
            ],
            [
                'nama_guru'      => 'Nida Amalia, S.Pd.I',
                'jabatan'        => 'Guru Mata Pelajaran',
                'nip'            => '199412052020012006',
                'mata_pelajaran' => 'Bahasa Arab & PAI',
                'foto'           => null
            ],
        ];

        foreach ($gurus as $data) {
            Guru::create([
                'nama_guru'      => $data['nama_guru'],
                'slug'           => Str::slug($data['nama_guru']),
                'jabatan'        => $data['jabatan'],
                'nip'            => $data['nip'],
                'mata_pelajaran' => $data['mata_pelajaran'],
                'foto'           => $data['foto'],
            ]);
        }
    }
}
