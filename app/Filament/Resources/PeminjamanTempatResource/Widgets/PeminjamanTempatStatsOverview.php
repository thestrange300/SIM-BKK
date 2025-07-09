<?php

namespace App\Filament\Resources\PeminjamanTempatResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PeminjamanTempatStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Statistik Peminjaman Tempat';

    protected ?string $description = 'Statistik terkait peminjaman tempat yang terdaftar di sistem.';
    protected function getStats(): array
    {
        return [
            Stat::make('Total Peminjaman Tempat', \App\Models\PeminjamanTempat::count())
                ->description('Jumlah total peminjaman tempat yang terdaftar')
                ->color('primary'),
            Stat::make('Peminjaman Bulan Ini', \App\Models\PeminjamanTempat::whereMonth('created_at', now()->month)->count())
                ->description('Jumlah peminjaman tempat yang dilakukan bulan ini')
                ->color('info'),
            Stat::make(
                'Tipe Peminjaman Terpopuler',
                function () {
                    $topTipeId = \App\Models\PeminjamanTempat::select('tipe_peminjaman_id')
                        ->groupBy('tipe_peminjaman_id')
                        ->orderByRaw('COUNT(*) DESC')
                        ->limit(1)
                        ->pluck('tipe_peminjaman_id')
                        ->first();

                    if (!$topTipeId) {
                        return '-';
                    }

                    return optional(\App\Models\TipePeminjaman::find($topTipeId))->nama ?? '-';
                }
            )
            ->description('Tipe peminjaman tempat yang paling banyak dilakukan')
            ->color('warning'),
        ];
    }
}
