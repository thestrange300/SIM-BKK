<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\TipePemasukan;
use App\Models\TipePengeluaran;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keuangan>
 */
class KeuanganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenis = $this->faker->randomElement(['pemasukan', 'pengeluaran']);

        if ($jenis === 'pemasukan') {
            $tipeId = TipePemasukan::inRandomOrder()->value('id') ?? 1;
        } else {
            $tipeId = TipePengeluaran::inRandomOrder()->value('id') ?? 1;
        }

        return [
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'deskripsi' => $this->faker->sentence(),
            'jumlah' => $this->faker->randomFloat(2, 10000, 1000000),
            'jenis' => $jenis,
            'tipe_id' => $tipeId,
            'user_id' => User::inRandomOrder()->value('id') ?? 1,
        ];
    }
}
