<?php

namespace Database\Seeders;

use App\Models\TipeZakatFitrah;
use Illuminate\Database\Seeder;

class TipeZakatFitrahSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['nama' => 'Uang', 'deskripsi' => 'Alat tukar resmi yang digunakan dalam transaksi ekonomi.'],
            ['nama' => 'Beras', 'deskripsi' => 'Biji-bijian pokok yang menjadi makanan utama di banyak negara, termasuk Indonesia.'],
            ['nama' => 'Tepung', 'deskripsi' => 'Bahan makanan hasil gilingan biji-bijian atau umbi-umbian, biasanya digunakan untuk membuat roti atau kue.'],
            ['nama' => 'Kurma', 'deskripsi' => 'Buah manis yang berasal dari pohon kurma, banyak tumbuh di daerah Timur Tengah.'],
            ['nama' => 'Gandum', 'deskripsi' => 'Tanaman biji-bijian yang banyak digunakan sebagai bahan dasar tepung dan roti.'],
            ['nama' => 'Aqith', 'deskripsi' => 'Keju kering tradisional khas Arab yang terbuat dari susu.'],
        ];
        
        foreach ($types as $type) {
            TipeZakatFitrah::create($type);
        }
    }
}
