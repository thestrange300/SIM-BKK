<?php

namespace App\Filament\Resources\DataHewanResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\DataHewan;
use App\Models\DistDagingQurban;

class DataHewanStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Statistik Data Hewan Qurban';

    protected ?string $description = 'Statistik terkait data hewan qurban yang terdaftar di sistem.';

    protected function getStats(): array
    {
        $jumlahHewan = DataHewan::count();
        $jumlahKg = DataHewan::sum('berat');
        $totalDistribusi = DistDagingQurban::count();

        return [
            Stat::make('Jumlah Hewan Terdata', $jumlahHewan . ' Ekor')
                ->description('Total hewan qurban yang terdata')
                ->color('success')
                ->icon('heroicon-o-document-text'),

            Stat::make('Jumlah Berat Terdata', number_format($jumlahKg, 2, ',', '.') . ' kg')
                ->description('Total berat hewan qurban yang terdata')
                ->color('info')
                ->icon('heroicon-o-scale'), // Tambahkan ikon

            Stat::make('Total Jumlah Distribusi', $totalDistribusi . ' Distribusi')
                ->description('Total distribusi daging yang telah dilakukan')
                ->color('primary')
                ->icon('heroicon-o-gift'), 
        ];
    }
}
