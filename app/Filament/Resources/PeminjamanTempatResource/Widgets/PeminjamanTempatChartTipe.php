<?php

namespace App\Filament\Resources\PeminjamanTempatResource\Widgets;

use Filament\Widgets\ChartWidget;

class PeminjamanTempatChartTipe extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Peminjaman Berdasarkan Tipe';
    protected static ?string $maxHeight = '300px';
    protected function getData(): array
    {
        // Get counts per tipe_peminjaman_id
        $counts = \App\Models\PeminjamanTempat::selectRaw('tipe_peminjaman_id, COUNT(*) as count')
            ->groupBy('tipe_peminjaman_id')
            ->pluck('count', 'tipe_peminjaman_id');

        $tipePeminjaman = \App\Models\TipePeminjaman::pluck('nama', 'id');

        // Sort by count descending
        $sorted = $counts->sortDesc();

        // Show top 5, group the rest as "Lainnya"
        $topN = 5;
        $topIds = $sorted->keys()->take($topN);
        $otherCount = $sorted->slice($topN)->sum();

        $labels = [];
        $data = [];
        $backgroundColor = [];

        // Color palette (5 + 1 for "Lainnya")
        $palette = [
            '#166534', // green-800
            '#15803d', // green-700
            '#16a34a', // green-600
            '#22c55e', // green-500
            '#ffe082', // yellow
            '#bdbdbd', // gray for "Lainnya"
        ];

        foreach ($topIds as $i => $id) {
            $labels[] = $tipePeminjaman[$id] ?? 'Tipe Tidak Diketahui';
            $data[] = $counts[$id];
            $backgroundColor[] = $palette[$i];
        }
        if ($otherCount > 0) {
            $labels[] = 'Lainnya';
            $data[] = $otherCount;
            $backgroundColor[] = $palette[5];
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Peminjaman',
                    'data' => $data,
                    'backgroundColor' => $backgroundColor,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
