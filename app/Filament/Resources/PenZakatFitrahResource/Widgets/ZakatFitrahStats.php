<?php

namespace App\Filament\Resources\PenZakatFitrahResource\Widgets;

use App\Models\PenZakatFitrah;
use App\Models\DistZakatFitrah;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ZakatFitrahStats extends BaseWidget
{
    
    protected function getStats(): array
    {
        $currentYear = now()->year;
        
        // Calculate all the values using Eloquent
        $totalPenerimaan = PenZakatFitrah::whereYear('tanggal_penerimaan', $currentYear)->count();
        $totalDistribusi = DistZakatFitrah::whereYear('tanggal_penerimaan', $currentYear)->count();
        
        $totalUangPenerimaan = PenZakatFitrah::whereYear('tanggal_penerimaan', $currentYear)->sum('jumlah_uang') ?? 0;
        $totalUangDistribusi = DistZakatFitrah::whereYear('tanggal_penerimaan', $currentYear)->sum('jumlah_uang') ?? 0;
        $totalUang = $totalUangPenerimaan + $totalUangDistribusi;
        
        $totalMakananPenerimaan = PenZakatFitrah::whereYear('tanggal_penerimaan', $currentYear)->sum('jumlah_makanan_pokok') ?? 0;
        $totalMakananDistribusi = DistZakatFitrah::whereYear('tanggal_penerimaan', $currentYear)->sum('jumlah_makanan_pokok') ?? 0;
        $totalMakananPokok = $totalMakananPenerimaan + $totalMakananDistribusi;

        return [
            Stat::make('Total Penerimaan Tahun Ini', $totalPenerimaan . ' transaksi')
                ->description('Jumlah transaksi penerimaan zakat fitrah')
                ->descriptionIcon('heroicon-o-arrow-trending-up', IconPosition::Before)
                ->color('success'),
            
            Stat::make('Total Distribusi Tahun Ini', $totalDistribusi . ' transaksi')
                ->description('Jumlah transaksi distribusi zakat fitrah')
                ->descriptionIcon('heroicon-o-arrow-trending-down', IconPosition::Before)
                ->color('warning'),
            
            Stat::make('Total Uang Tahun Ini ', 'Rp '. number_format($totalUang, 0, ',', '.'))
                ->description('Total uang penerimaan dan distribusi')
                ->descriptionIcon('heroicon-o-banknotes', IconPosition::Before)
                ->color('primary'),
            
            Stat::make('Total Makanan Pokok Tahun Ini ', number_format($totalMakananPokok, 2, ',', '.') . ' kg')
                ->description('Total makanan pokok penerimaan dan distribusi')
                ->descriptionIcon('heroicon-o-shopping-bag', IconPosition::Before)
                ->color('info'),
        ];
    }
    public function getColumnSpan(): int|string|array
    {
        return 1;
    }

    protected function getColumns(): int
    {
        return 2;
    }
}