<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipe_inventaris')->insert([
            [
                'nama' => 'Perlengkapan Ibadah',
                'deskripsi' => 'Barang yang digunakan langsung dalam kegiatan ibadah seperti sholat dan ngaji.'
            ],
            [
                'nama' => 'Peralatan Elektronik',
                'deskripsi' => 'Perangkat elektronik untuk operasional masjid seperti sound system, AC, atau proyektor.'
            ],
            [
                'nama' => 'Perabotan Masjid',
                'deskripsi' => 'Perabot fisik seperti meja, kursi, lemari, atau rak sepatu.'
            ],
            [
                'nama' => 'Karpet dan Alas',
                'deskripsi' => 'Karpet, sajadah besar, dan tikar yang digunakan sebagai alas sholat.'
            ],
            [
                'nama' => 'Penerangan dan Kelistrikan',
                'deskripsi' => 'Lampu, kabel, panel listrik, atau alat kelistrikan lain.'
            ],
            [
                'nama' => 'Buku dan Kitab',
                'deskripsi' => 'Al-Qur’an, kitab kuning, buku-buku agama, dan bahan bacaan lainnya.'
            ],
            [
                'nama' => 'Peralatan Kebersihan',
                'deskripsi' => 'Alat kebersihan seperti sapu, pel, ember, tempat sampah, dan lainnya.'
            ],
            [
                'nama' => 'Inventaris Kantor',
                'deskripsi' => 'Barang kebutuhan administrasi seperti komputer, printer, ATK, dan meja kerja.'
            ],
            [
                'nama' => 'Dapur dan Konsumsi',
                'deskripsi' => 'Peralatan dapur seperti kompor, termos, piring, gelas, dan alat masak untuk kegiatan masjid.'
            ],
            [
                'nama' => 'Inventaris Lapangan',
                'deskripsi' => 'Barang yang digunakan di halaman atau area luar seperti tenda, kipas lapangan, atau kursi plastik.'
            ],
            [
                'nama' => 'Kendaraan Operasional',
                'deskripsi' => 'Sepeda motor, mobil, atau gerobak yang digunakan untuk kegiatan operasional masjid.'
            ],
            [
                'nama' => 'Perlengkapan Kegiatan Sosial',
                'deskripsi' => 'Barang yang digunakan untuk kegiatan sosial seperti baksos, qurban, atau santunan.'
            ],
            [
                'nama' => 'Peralatan Multimedia',
                'deskripsi' => 'Perangkat penunjang multimedia seperti kamera, speaker bluetooth, mikrofon wireless, dll.'
            ],
            [
                'nama' => 'Dekorasi dan Estetika',
                'deskripsi' => 'Hiasan dinding, jam digital, kaligrafi, dan elemen dekoratif lainnya.'
            ]
        ]);
    }
}
