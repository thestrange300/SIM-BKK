<?php

namespace App\Filament\Resources\KajianResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AcaraStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Statistik Acara';

    protected ?string $description = 'Statistik terkait kajian dan khutbah jumat yang terdaftar di sistem.';
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kajian Bulan Ini', 
            \App\Models\Kajian::whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->count())
                ->description('Kajian yang berlangsung bulan ini.')
                ->color('success'),
            Stat::make('Jumlah Penceramah Bulan Ini',
            \App\Models\Kajian::whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->distinct('penceramah_id')->count())
                ->description('Total penceramah berbeda selama bulan ini.')
                ->color('primary'),
            Stat::make('Jumlah Petugas Jumat Bulan Ini', 
                \App\Models\KhutbahJumat::whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->distinct('imam_id')
                    ->count() + 
                \App\Models\KhutbahJumat::whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->distinct('khotib_id')
                    ->count() - 
                \App\Models\KhutbahJumat::whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->where('imam_id', '=', 'khotib_id')
                    ->count())
                ->description('Total petugas jumat (imam & khatib) selama bulan ini.')
                ->color('warning'),
            Stat::make('Jumlah Hari Aktif Bulan Ini', 
                \App\Models\KhutbahJumat::whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->distinct('tanggal')
                    ->pluck('tanggal')
                    ->merge(\App\Models\Kajian::whereMonth('tanggal', now()->month)
                        ->whereYear('tanggal', now()->year)
                        ->distinct('tanggal')
                        ->pluck('tanggal'))
                    ->count())
                ->description('Jumlah hari dengan aktivitas keagamaan.')
                ->color('info'),            

        ];
    }
}
