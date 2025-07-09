<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DistZakatFitrah>
 */
class DistZakatFitrahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal_penerimaan' => $this->faker->date(),
            'nama_mustahik' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'tipe_zakat_fitrah_id' => $this->faker->numberBetween(1, 5), // Assuming you have 5 types
            ...(
                $this->faker->boolean()
                ? ['jumlah_makanan_pokok' => $this->faker->numberBetween(1, 100), 'jumlah_uang' => null]
                : ['jumlah_makanan_pokok' => null, 'jumlah_uang' => $this->faker->randomFloat(2, 0, 1000)]
            ),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
