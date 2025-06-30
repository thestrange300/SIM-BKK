<?php

namespace Database\Seeders;

use App\Models\TipePeminjaman;
use Illuminate\Database\Seeder;

class TipePeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'nama' => 'Pengajian Rutin',
                'deskripsi' => 'Peminjaman ruang untuk kegiatan pengajian mingguan atau bulanan.'
            ],
            [
                'nama' => 'Kajian Umum',
                'deskripsi' => 'Kegiatan kajian terbuka untuk umum yang biasanya menghadirkan ustadz atau narasumber khusus.'
            ],
            [
                'nama' => 'Kegiatan Remaja Masjid',
                'deskripsi' => 'Peminjaman oleh remaja masjid untuk rapat, pelatihan, atau acara internal.'
            ],
            [
                'nama' => 'Pernikahan / Akad Nikah',
                'deskripsi' => 'Peminjaman area dalam masjid untuk acara akad nikah.'
            ],
            [
                'nama' => 'Pelatihan / Workshop',
                'deskripsi' => 'Penggunaan ruangan untuk pelatihan, seminar, atau workshop bertema umum maupun keagamaan.'
            ],
            [
                'nama' => 'Rapat Warga / RT / RW',
                'deskripsi' => 'Peminjaman untuk rapat skala lingkungan seperti RT atau RW.'
            ],
            [
                'nama' => 'Kegiatan Sosial',
                'deskripsi' => 'Penggunaan tempat untuk kegiatan seperti donor darah, pembagian sembako, dan lain-lain.'
            ],
            [
                'nama' => 'Majelis Taklim',
                'deskripsi' => 'Kegiatan rutin kelompok taklim ibu-ibu atau bapak-bapak.'
            ],
            [
                'nama' => 'Buka Puasa Bersama',
                'deskripsi' => 'Peminjaman tempat masjid untuk kegiatan buka puasa bersama saat Ramadan.'
            ],
            [
                'nama' => 'Khitanan / Aqiqah',
                'deskripsi' => 'Penggunaan area masjid untuk syukuran khitan atau aqiqah.'
            ],
            [
                'nama' => 'Tadarus / Khataman',
                'deskripsi' => 'Kegiatan membaca Al-Qur’an bersama atau khataman Al-Qur’an, terutama saat Ramadan.'
            ],
            [
                'nama' => 'Pemakaman / Doa Arwah',
                'deskripsi' => 'Peminjaman untuk kegiatan tahlilan, doa arwah, atau pelepasan jenazah.'
            ],
            [
                'nama' => 'Kegiatan Pendidikan',
                'deskripsi' => 'Ruang digunakan untuk TPQ, madrasah, atau bimbingan belajar anak-anak.'
            ],
            [
                'nama' => 'Kegiatan Organisasi Kemasyarakatan',
                'deskripsi' => 'Rapat atau kegiatan dari lembaga masyarakat seperti Karang Taruna atau PKK.'
            ]
        ];

        foreach ($types as $type) {
            TipePeminjaman::create($type);
        }
    }
}
