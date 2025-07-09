<?php

namespace App\Filament\Resources\KeuanganResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Keuangan; // Import the Keuangan model
use App\Models\TipePemasukan;

class KeuanganChartPiePemasukan extends ChartWidget
{
    protected static ?string $heading = 'Top 5 Tipe Pemasukan'; // Update heading
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        $tipePemasukanList = TipePemasukan::with(['keuangan' => function ($query) {
            $query->where('jenis', 'pemasukan');
        }])->get();

        // Calculate total pemasukan per tipe and sort descending
        $sorted = $tipePemasukanList->map(function ($tipe) {
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
                        '#166534', // green-800
                        '#15803d', // green-700
                        '#16a34a', // green-600
                        '#22c55e', // green-500
                        '#4ade80', // green-400
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

