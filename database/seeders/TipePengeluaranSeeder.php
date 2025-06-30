<?php

namespace Database\Seeders;

use App\Models\TipePengeluaran;
use Illuminate\Database\Seeder;

class TipePengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'nama' => 'Honor Imam dan Khatib',
                'deskripsi' => 'Pembayaran honor untuk imam, khatib, dan penceramah.'
            ],
            [
                'nama' => 'Operasional Harian Masjid',
                'deskripsi' => 'Pengeluaran rutin seperti listrik, air, internet, dan kebersihan.'
            ],
            [
                'nama' => 'Renovasi dan Perawatan',
                'deskripsi' => 'Biaya perbaikan bangunan, pengecatan, dan perawatan fasilitas.'
            ],
            [
                'nama' => 'Konsumsi Kegiatan',
                'deskripsi' => 'Biaya konsumsi untuk kegiatan seperti pengajian, buka puasa bersama, dll.'
            ],
            [
                'nama' => 'Santunan Anak Yatim',
                'deskripsi' => 'Dana yang diberikan kepada anak yatim dalam kegiatan sosial masjid.'
            ],
            [
                'nama' => 'Santunan Dhuafa',
                'deskripsi' => 'Bantuan untuk fakir miskin dan kaum dhuafa.'
            ],
            [
                'nama' => 'Biaya Pendidikan',
                'deskripsi' => 'Pengeluaran untuk kegiatan pendidikan seperti TPQ, madrasah, atau beasiswa.'
            ],
            [
                'nama' => 'Pengeluaran Qurban',
                'deskripsi' => 'Pengadaan hewan qurban, konsumsi panitia, dan distribusi daging.'
            ],
            [
                'nama' => 'Pengeluaran Zakat',
                'deskripsi' => 'Distribusi zakat fitrah atau zakat mal kepada mustahik.'
            ],
            [
                'nama' => 'Honor Marbot dan Petugas Kebersihan',
                'deskripsi' => 'Pembayaran untuk penjaga masjid dan kebersihan.'
            ],
            [
                'nama' => 'Pengadaan Inventaris',
                'deskripsi' => 'Pembelian barang seperti kipas, karpet, pengeras suara, atau alat ibadah.'
            ],
            [
                'nama' => 'Transportasi dan Logistik',
                'deskripsi' => 'Biaya transportasi kegiatan, distribusi bantuan, atau logistik acara.'
            ],
            [
                'nama' => 'Cetak dan ATK',
                'deskripsi' => 'Biaya alat tulis, fotokopi, cetak banner, dan sejenisnya.'
            ],
            [
                'nama' => 'Pengeluaran Tak Terduga',
                'deskripsi' => 'Pengeluaran mendesak yang tidak direncanakan sebelumnya.'
            ]
        ];

        foreach ($types as $type) {
            TipePengeluaran::create($type);
        }
    }
}
