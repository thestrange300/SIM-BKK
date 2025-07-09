<?php

namespace App\Filament\Resources\PenZakatFitrahResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PenZakatFitrah; // Import the model

class ZakatFitrahChartBarUang extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penerimaan Zakat Fitrah per Tahun';

    protected function getData(): array
    {
        // Fetch all relevant data
        $data = PenZakatFitrah::select('tanggal_penerimaan', 'jumlah_uang') // Select only necessary columns
            ->get();

        // Group by year and sum using Collections
        $aggregatedData = $data->groupBy(function ($item) {
                return $item->tanggal_penerimaan->format('Y'); // Group by year
            })
            ->map(function ($yearGroup) {
                return [
                    'year' => $yearGroup->first()->tanggal_penerimaan->format('Y'),
                    'total_uang' => $yearGroup->sum('jumlah_uang'), // Keep only total_uang
                ];
            })
            ->sortBy('year') // Sort by year
            ->values(); // Reset keys

        // Prepare data for the chart
        $labels = $aggregatedData->pluck('year')->toArray();
        $totalUang = $aggregatedData->pluck('total_uang')->toArray(); // Keep only total_uang

        return [
            'datasets' => [
                [
                    'label' => 'Total Uang (Rp)',
                    'data' => $totalUang,
                    'backgroundColor' => '#FF6384', // Example color
                    'borderColor' => '#FFB1C1', // Example color
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}