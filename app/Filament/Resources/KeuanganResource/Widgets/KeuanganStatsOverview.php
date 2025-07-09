<?php

namespace App\Filament\Resources\KeuanganResource\Widgets;

use App\Models\Keuangan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class KeuanganStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Statistik Keuangan';

    protected ?string $description = 'Statistik terkait pemasukan dan pengeluaran keuangan yang terdaftar di sistem.';
    protected function getStats(): array
    {

        $totalPemasukan = Keuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        $formatIDR = fn($value) => 'Rp ' . number_format($value, 0, ',', '.');

        return [
            Stat::make('Saldo Akhir', $formatIDR($saldoAkhir))
                ->description('Saldo akhir saat ini')
                ->color($saldoAkhir >= 0 ? 'success' : 'danger')
                ->icon('heroicon-o-wallet'), // Tambahkan ikon

            Stat::make('Total Pemasukan', $formatIDR($totalPemasukan))
                ->description('Total pemasukan selama ini')
                ->color('success')
                ->icon('heroicon-o-arrow-trending-up'), // Tambahkan ikon

            Stat::make('Total Pengeluaran', $formatIDR($totalPengeluaran))
                ->description('Total pengeluaran selama ini')
                ->color('danger')
                ->icon('heroicon-o-arrow-trending-down'), // Tambahkan ikon
        ];
    }
}
