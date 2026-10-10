<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengumuman;
use Illuminate\Support\Str;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        $pengumumans = [
            [
                'judul'   => 'Jadwal Penilaian/Sumatif Tengah Semester (PTS/STS)',
                'isi'     => 'Pelaksanaan Penilaian Tengah Semester akan dimulai pada pekan depan. Seluruh siswa diwajibkan mempersiapkan diri dengan baik. Kepada Ayah/Bunda, mohon bantuannya untuk mendampingi murajaah hafalan Al-Quran ananda di rumah.',
                'tanggal' => now()->toDateString(),
                'status'  => 'Publish',
                'foto'    => null,
                'id_user' => 1,
            ],
            [
                'judul'   => 'Informasi Libur Awal Ramadhan & Jadwal Pesantren Kilat',
                'isi'     => 'Menyambut bulan suci Ramadhan, Kegiatan Belajar Mengajar (KBM) reguler diliburkan selama 3 hari pertama. Setelah itu, siswa akan masuk kembali dengan jadwal khusus untuk kegiatan Sanlat (Pesantren Kilat) Ramadhan.',
                'tanggal' => now()->subDays(4)->toDateString(),
                'status'  => 'Publish',
                'foto'    => null,
                'id_user' => 1,
            ],
            [
                'judul'   => 'Jadwal Pengambilan Seragam dan Buku Paket',
                'isi'     => 'Diberitahukan kepada seluruh orang tua/wali siswa baru SDIT Al-Hikmah, pengambilan seragam sekolah dan buku paket pembelajaran dapat dilakukan di ruang Tata Usaha (TU) mulai hari Senin pukul 08.00 - 14.00 WIB.',
                'tanggal' => now()->subDays(10)->toDateString(),
                'status'  => 'Publish',
                'foto'    => null,
                'id_user' => 1,
            ],
            [
                'judul'   => 'Undangan Sosialisasi Program Tahfidz & Parenting Islami',
                'isi'     => 'Mengharap kehadiran Ayah/Bunda wali murid pada acara Sosialisasi Target Hafalan (Tahfidz) tahun ajaran baru, yang dirangkaikan dengan Seminar Parenting Islami. Acara akan diselenggarakan pada hari Sabtu pagi di lingkungan sekolah.',
                'tanggal' => now()->subDays(15)->toDateString(),
                'status'  => 'Publish',
                'foto'    => null,
                'id_user' => 1,
            ]
        ];

        foreach ($pengumumans as $data) {
            Pengumuman::create([
                'judul'   => $data['judul'],
                'slug'    => Str::slug($data['judul']),
                'isi'     => $data['isi'],
                'tanggal' => $data['tanggal'],
                'status'  => $data['status'],
                'foto'    => $data['foto'],
                'id_user' => $data['id_user'],
            ]);
        }
    }
}
