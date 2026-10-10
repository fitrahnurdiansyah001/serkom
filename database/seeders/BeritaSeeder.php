<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $beritas = [
            [
                'judul'   => 'Pembukaan Penerimaan Peserta Didik Baru (PPDB) SDIT Al-Hikmah Mangunreja',
                'tanggal' => now()->subDays(2),
                'status'  => 'Publish',
                'id_user' => 1,
                'isi'     => 'Alhamdulillah, SDIT Al-Hikmah Mangunreja kembali membuka pendaftaran Peserta Didik Baru untuk tahun ajaran mendatang. Kami mengajak Ayah dan Bunda untuk bergabung bersama kami dalam mencetak generasi qurani yang cerdas, mandiri, dan berakhlak mulia. Pendaftaran dapat dilakukan langsung di sekretariat kami di Jl. Kalapasewu. Kuota terbatas, segera daftarkan putra-putri Anda!',
                'gambar'  => null
            ],
            [
                'judul'   => 'Pelaksanaan Uji Publik dan Munaqosyah Tahfidz Al-Quran',
                'tanggal' => now()->subDays(7),
                'status'  => 'Publish',
                'id_user' => 1,
                'isi'     => 'Sebagaimana komitmen sekolah dalam program unggulan hafalan Al-Quran, SDIT Al-Hikmah Mangunreja sukses menyelenggarakan Uji Publik dan Munaqosyah Tahfidz Juz 30. Kegiatan ini disaksikan langsung oleh para orang tua siswa dengan suasana haru dan khidmat. Semoga anak-anak kita menjadi generasi penjaga Al-Quran.',
                'gambar'  => null
            ],
            [
                'judul'   => 'Semarak Peringatan Maulid Nabi Muhammad SAW dan Santunan Yatim',
                'tanggal' => now()->subDays(14),
                'status'  => 'Publish',
                'id_user' => 1,
                'isi'     => 'Keluarga besar SDIT Al-Hikmah Mangunreja mengadakan acara peringatan Maulid Nabi Muhammad SAW yang dirangkaikan dengan kegiatan santunan anak yatim. Acara dimeriahkan dengan penampilan nasyid, pidato cilik, dan dongeng Islami yang penuh dengan pesan moral bagi para siswa.',
                'gambar'  => null
            ],
            [
                'judul'   => 'Siswa SDIT Al-Hikmah Raih Juara Lomba Pentas PAI Tingkat Kecamatan',
                'tanggal' => now()->subDays(30),
                'status'  => 'Publish',
                'id_user' => 1,
                'isi'     => 'Prestasi membanggakan kembali ditorehkan oleh siswa-siswi SDIT Al-Hikmah Mangunreja. Delegasi sekolah berhasil meraih Juara 1 dalam cabang lomba Cerdas Cermat dan Tahfidz pada ajang Pekan Keterampilan dan Seni Pendidikan Agama Islam (Pentas PAI) tingkat Kecamatan Mangunreja. Semoga prestasi ini menjadi motivasi bagi siswa lainnya.',
                'gambar'  => null
            ],
        ];

        foreach ($beritas as $data) {
            Berita::create([
                'judul'   => $data['judul'],
                'slug'    => Str::slug($data['judul']),
                'tanggal' => $data['tanggal'],
                'status'  => $data['status'],
                'id_user' => $data['id_user'],
                'isi'     => $data['isi'],
                'gambar'  => $data['gambar'],
            ]);
        }
    }
}
