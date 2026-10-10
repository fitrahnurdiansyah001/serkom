<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilSekolah;

class ProfilSekolahSeeder extends Seeder
{
    public function run(): void
    {
        ProfilSekolah::updateOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => 'SDIT Al-Hikmah Mangunreja',
                'kepala_sekolah' => 'Kepala Sekolah SDIT',
                'npsn' => '70005917',
                'tahun_berdiri' => 2018,
                'alamat' => 'Jl. Kalapasewu RT 001 RW 003, Desa Mangunreja, Kec. Mangunreja, Kab. Tasikmalaya, Jawa Barat',
                'telepon' => '-', 
                'email' => 'sditalhikmahmgrj@gmail.com',
                'visi' => 'Terwujudnya peserta didik yang qurani, berakhlak mulia, cerdas, dan mandiri.',
                'misi' => "1. Menanamkan aqidah yang lurus dan akhlakul karimah melalui pembiasaan ibadah.\n2. Menyelenggarakan pembelajaran aktif, kreatif, dan menyenangkan yang memadukan kurikulum nasional dan nilai-nilai Islam.\n3. Mengembangkan potensi minat dan bakat siswa agar mandiri dan berprestasi.",
                'sejarah' => 'SDIT Al-Hikmah Mangunreja berada di bawah naungan Yayasan Al-Istiqomah Mangunreja. Sekolah ini didirikan sebagai bentuk komitmen dalam menyediakan layanan pendidikan dasar yang mengintegrasikan ilmu pengetahuan umum dengan penanaman nilai-nilai agama Islam sejak dini di lingkungan Kabupaten Tasikmalaya.',
                'fasilitas' => 'Ruang Kelas, Perpustakaan, Lapangan, Ruang Guru, Sanitasi (Toilet), dan Daya Listrik.',
                'logo' => null, 
                'foto' => null, 
            ]
        );
    }
}