<?php

namespace App\Filament\Resources\PenZakatFitrahResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PenZakatFitrah; // Assuming this model exists
use App\Models\DistZakatFitrah; // Assuming this model exists

class ZakatFitrahStatsOverview extends BaseWidget
{

    protected ?string $heading = 'Statistik Zakat Fitrah';

    protected ?string $description = 'Statistik terkait penerimaan dan distribusi zakat fitrah yang terdaftar di sistem.';
    protected function getStats(): array
    {
        $totalReceivedUang = PenZakatFitrah::sum('jumlah_uang');
        $totalReceivedMakanan = PenZakatFitrah::sum('jumlah_makanan_pokok'); // Assuming 'jumlah_makanan_pokok' is in kg or similar unit

        $totalDistributedUang = DistZakatFitrah::sum('jumlah_uang');
        $totalDistributedMakanan = DistZakatFitrah::sum('jumlah_makanan_pokok');

        $remainingUang = $totalReceivedUang - $totalDistributedUang;
        $remainingMakanan = $totalReceivedMakanan - $totalDistributedMakanan;

        return [
            Stat::make('Total Penerimaan Zakat Fitrah', 'Rp ' . number_format($totalReceivedUang, 0, ',', '.'))
                ->description($totalReceivedMakanan . ' kg') // Assuming kg unit for food
                ->color('success')
                ->icon('heroicon-o-wallet'),
            Stat::make('Total Distribusi Zakat Fitrah', 'Rp ' . number_format($totalDistributedUang, 0, ',', '.'))
                ->description($totalDistributedMakanan . ' kg') // Assuming kg unit for food
                ->color('warning')
                ->icon('heroicon-o-gift'),
            Stat::make('Sisa Zakat Fitrah', 'Rp ' . number_format($remainingUang, 0, ',', '.'))
                ->description($remainingMakanan . ' kg') // Assuming kg unit for food
                ->color($remainingUang > 0 || $remainingMakanan > 0 ? 'danger' : 'success') // Color based on remaining amount
                ->icon('heroicon-o-archive-box'),
        ];
    }
}
