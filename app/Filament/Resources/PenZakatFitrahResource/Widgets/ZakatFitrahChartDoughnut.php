<?php

namespace App\Filament\Resources\PenZakatFitrahResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PenZakatFitrah; // Import the model
use App\Models\TipeZakatFitrah; // Import the TipeZakatFitrah model

class ZakatFitrahChartDoughnut extends ChartWidget
{
    protected static ?string $heading = 'Grafik Komposisi Penerimaan Zakat per Tipe';
        protected static ?string $maxHeight = '275px';

    protected function getData(): array
    {
        // Fetch all records with the related TipeZakatFitrah
        $data = PenZakatFitrah::with('tipeZakatFitrah')->get();

        // Group by tipe_zakat_fitrah_id and count using Collections
        $aggregatedData = $data->groupBy('tipe_zakat_fitrah_id')
            ->map(function ($group) {
                // Get the type name from the first item in the group
                $typeName = $group->first()->tipeZakatFitrah->nama ?? 'Unknown Type';
                return [
                    'type_name' => $typeName,
                    'count' => $group->count(), // Count items in the group
                ];
            })
            ->values(); // Reset keys

        // Prepare data for the chart
        $labels = $aggregatedData->pluck('type_name')->toArray();
        $counts = $aggregatedData->pluck('count')->toArray();

        // Use the specified colors for the segments
        $colors = [
            '#166534', // green-800
            '#15803d', // green-700
            '#16a34a', // green-600
            '#22c55e', // green-500
            '#4ade80', // green-400
            '#86efac', // green-300 - Added color
            // Add more colors here if you expect more than 6 types
        ];


        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penerimaan',
                    'data' => $counts,
                    'backgroundColor' => $colors, // Use the specified colors
                    'borderColor' => '#ffffff',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

}
