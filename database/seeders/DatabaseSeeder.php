<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'superadmin',
            'email' => 'admin@localhost',
            'password' => bcrypt('superadmin'),
        ]);

        $this->call([
            TipeZakatFitrahSeeder::class,
            TipeDagingQurbanSeeder::class,
            TipePemasukanSeeder::class,
            TipePengeluaranSeeder::class,
            TipePeminjamanSeeder::class, // add this line
        ]);
    }
}
