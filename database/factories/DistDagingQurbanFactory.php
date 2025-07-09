<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DistDagingQurban>
 */
class DistDagingQurbanFactory extends Factory
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
            'nama_penerima' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'tipe_daging_qurban' => json_encode(array_slice([1, 2, 3, 4, 5], 0, random_int(1, 5))),
            'jumlah' => $this->faker->numberBetween(1, 100),
            'keterangan' => $this->faker->paragraph(),
            'created_at' => Carbon::now()->subYears(random_int(0, 10)),
        ];
    }
}
