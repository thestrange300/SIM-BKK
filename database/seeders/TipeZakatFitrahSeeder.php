<?php

namespace Database\Seeders;

use App\Models\TipeZakatFitrah;
use Illuminate\Database\Seeder;

class TipeZakatFitrahSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['Uang', 'Beras', 'Tepung', 'Kurma', 'Gandum', 'Aqith'];
        
        foreach ($types as $type) {
            TipeZakatFitrah::create([
                'nama' => $type,
            ]);
        }
    }
}
