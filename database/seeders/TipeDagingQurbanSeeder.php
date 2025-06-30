<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipeDagingQurban;

class TipeDagingQurbanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Daging Utama',
                'deskripsi' => 'Potongan daging tanpa tulang seperti paha, has luar, dan bagian daging pilihan lainnya.'
            ],
            [
                'nama' => 'Daging Campur',
                'deskripsi' => 'Campuran antara daging dan sedikit tulang, biasa digunakan untuk kuota distribusi umum.'
            ],
            [
                'nama' => 'Tulang',
                'deskripsi' => 'Bagian tulang dengan sisa daging menempel, biasanya untuk keperluan tambahan atau distribusi sekunder.'
            ],
            [
                'nama' => 'Jeroan',
                'deskripsi' => 'Bagian dalam tubuh hewan seperti hati, paru, limpa, usus, dan babat. Biasanya dibagikan terpisah.'
            ],
            [
                'nama' => 'Kepala',
                'deskripsi' => 'Bagian kepala hewan (termasuk lidah dan pipi) yang bisa diberikan secara khusus.'
            ],
            [
                'nama' => 'Kaki',
                'deskripsi' => 'Bagian kaki (biasanya kaki depan dan belakang) yang sering diberikan ke pihak tertentu seperti panitia atau tokoh masyarakat.'
            ],
            [
                'nama' => 'Kulit',
                'deskripsi' => 'Kulit hewan qurban, umumnya disalurkan ke masjid atau dijual untuk dana operasional.'
            ],
        ];

        foreach ($data as $item) {
            TipeDagingQurban::create($item);
        }
    }
}
