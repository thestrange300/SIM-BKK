<?php

namespace App\Filament\Resources\KeuanganResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Keuangan;
use App\Models\TipePengeluaran;

class KeuanganChartPiePengeluaran extends ChartWidget
{
    protected static ?string $heading = 'Top 5 Tipe Pengeluaran';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        $tipePengeluaranList = TipePengeluaran::with(['keuangan' => function ($query) {
            $query->where('jenis', 'pengeluaran');
        }])->get();

        // Calculate total pengeluaran per tipe and sort descending
        $sorted = $tipePengeluaranList->map(function ($tipe) {
            return [
                'nama' => $tipe->nama,
                'jumlah' => $tipe->keuangan->sum('jumlah'),
            ];
        })->sortByDesc('jumlah')->take(5);

        foreach ($sorted as $tipe) {
            $labels[] = $tipe['nama'];
            $data[] = $tipe['jumlah'];
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah',
                    'data' => $data,
                    'backgroundColor' => [
                        '#991b1b', // red-800
                        '#b91c1c', // red-700
                        '#dc2626', // red-600
                        '#ef4444', // red-500
                        '#f87171', // red-400
                    ],
                ]
            ]
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
