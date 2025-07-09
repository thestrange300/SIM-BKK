<?php

namespace App\Filament\Resources\KeuanganResource\Widgets;

use App\Models\Keuangan;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class KeuanganChartLine extends ChartWidget
{
    protected static ?string $heading = 'Pemasukan & Pengeluaran 12 Bulan Terakhir';
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        $pemasukanData = [];
        $pengeluaranData = [];

        // Get the last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthLabel = $month->format('M Y'); // e.g., Jan 2023

            // Calculate total pemasukan for the month
            $totalPemasukan = Keuangan::where('jenis', 'pemasukan')
                ->whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('jumlah');

            // Calculate total pengeluaran for the month
            $totalPengeluaran = Keuangan::where('jenis', 'pengeluaran')
                ->whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->sum('jumlah');

            $labels[] = $monthLabel;
            $pemasukanData[] = $totalPemasukan;
            $pengeluaranData[] = $totalPengeluaran;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $pemasukanData,
                    'borderColor' => '#10b981', // success color
                    'backgroundColor' => '#10b981', // success color
                    'fill' => false,
                    'tension' => 0.1,
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $pengeluaranData,
                    'borderColor' => '#ef4444', // danger color
                    'backgroundColor' => '#ef4444', // danger color
                    'fill' => false,
                    'tension' => 0.1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getColumnSpan(): int|string|array
    {
        return 2;
    }

}
