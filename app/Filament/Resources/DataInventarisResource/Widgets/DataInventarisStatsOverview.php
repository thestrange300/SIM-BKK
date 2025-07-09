<?php

namespace App\Filament\Resources\DataInventarisResource\Widgets;

use App\Models\DataInventaris;
use App\Models\TipeInventaris;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DataInventarisStatsOverview extends BaseWidget
{

    protected ?string $heading = 'Statistik Inventaris';

    protected ?string $description = 'Statistik ini memberikan gambaran umum tentang data inventaris yang telah terdaftar.';
    
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Barang Terdata', DataInventaris::count())
                ->description('Jumlah total barang yang telah terdata')
                ->color('primary'),
            Stat::make('Jumlah Tipe Inventaris', TipeInventaris::count())
                ->description('Jumlah tipe inventaris yang berbeda')
                ->color('success'),
            Stat::make('Barang Rusak Ringan', DataInventaris::where('kondisi', 'Rusak Ringan')->count())
                ->description('Jumlah barang dengan kondisi rusak ringan')
                ->color('warning'),
            Stat::make('Barang Rusak Berat', DataInventaris::where('kondisi', 'Rusak Berat')->count())
                ->description('Jumlah barang dengan kondisi rusak berat')
                ->color('danger'),
        ];
    }
}
