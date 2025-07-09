<?php

namespace App\Filament\Resources\DataInventarisResource\Widgets;

use App\Models\DataInventaris;
use App\Models\TipeInventaris;
use Filament\Widgets\ChartWidget;

class DataInventarisChartTipe extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Barang berdasarkan Tipe Inventaris';
    protected static ?string $maxHeight = '300px';

protected function getData(): array
{
    // Get type counts
    $counts = DataInventaris::selectRaw('tipe_inventaris_id, COUNT(*) as count')
        ->groupBy('tipe_inventaris_id')
        ->pluck('count', 'tipe_inventaris_id');

    $tipeInventaris = TipeInventaris::pluck('nama', 'id');

    // Sort by count descending
    $sorted = $counts->sortDesc();

    // Show top 5, group the rest as "Lainnya"
    $topN = 5;
    $topIds = $sorted->keys()->take($topN);
    $otherCount = $sorted->slice($topN)->sum();

    $labels = [];
    $data = [];
    $backgroundColor = [];

    // Green to yellow palette (5 steps + 1 for "Lainnya")
    $palette = [
        '#166534', // green-800
        '#15803d', // green-700
        '#16a34a', // green-600
        '#22c55e', // green-500
        '#ffe082', // yellow
        '#bdbdbd', // gray for "Lainnya"
    ];

    foreach ($topIds as $i => $id) {
        $labels[] = $tipeInventaris[$id] ?? 'Tipe Tidak Diketahui';
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
                'label' => 'Jumlah Barang',
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
