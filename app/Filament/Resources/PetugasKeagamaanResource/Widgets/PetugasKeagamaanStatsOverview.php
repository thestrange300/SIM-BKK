<?php

namespace App\Filament\Resources\PetugasKeagamaanResource\Widgets;

use App\Models\PetugasKeagamaan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class PetugasKeagamaanStatsOverview extends BaseWidget
{

    protected ?string $heading = 'Statistik Petugas Keagamaan';

    protected ?string $description = 'Statistik terkait petugas keagamaan yang terdaftar di sistem.';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Petugas Keagamaan', PetugasKeagamaan::count())
                ->description('Jumlah total petugas keagamaan yang terdaftar')
                ->color('primary'),
            Stat::make('Jumlah Kategori Petugas', PetugasKeagamaan::distinct('kategori')->count())
                ->description('Jumlah kategori petugas keagamaan yang berbeda')
                ->color('success'),
            Stat::make('Petugas Baru Bulan Ini', PetugasKeagamaan::whereMonth('created_at', now()->month)->count())
                ->description('Jumlah petugas keagamaan yang ditambahkan bulan ini')
                ->color('info'),
            // Stat::make('Kategori Petugas Terpopuler', implode(', ', PetugasKeagamaan::select('kategori')
            //     ->groupBy('kategori')
            //     ->orderByRaw('COUNT(*) DESC')
            //     ->limit(1)
            //     ->pluck('kategori')->first()))
            //     ->description('Kategori petugas keagamaan yang paling banyak terdaftar')
            //     ->color('warning'),
        ];
    }
}
