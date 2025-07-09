<?php

namespace App\Filament\Resources\PenZakatFitrahResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\PenZakatFitrah; // Import the model

class ZakatFitrahChartBarMakanan extends ChartWidget
{
    protected static ?string $heading = 'Grafik Penerimaan Zakat Fitrah Makanan Pokok per Tahun'; // Updated heading

    protected function getData(): array
    {
        // Fetch all relevant data
        $data = PenZakatFitrah::select('tanggal_penerimaan', 'jumlah_makanan_pokok') // Select only necessary columns
            ->get();

        // Group by year and sum using Collections
        $aggregatedData = $data->groupBy(function ($item) {
                return $item->tanggal_penerimaan->format('Y'); // Group by year
            })
            ->map(function ($yearGroup) {
                return [
                    'year' => $yearGroup->first()->tanggal_penerimaan->format('Y'),
                    'total_makanan' => $yearGroup->sum('jumlah_makanan_pokok'), // Sum total_makanan
                ];
            })
            ->sortBy('year') // Sort by year
            ->values(); // Reset keys

        // Prepare data for the chart
        $labels = $aggregatedData->pluck('year')->toArray();
        $totalMakanan = $aggregatedData->pluck('total_makanan')->toArray(); // Keep only total_makanan

        return [
            'datasets' => [
                [
                    'label' => 'Total Makanan Pokok (kg)', // Updated label
                    'data' => $totalMakanan,
                    'backgroundColor' => '#36A2EB', // Example color (can be different from money)
                    'borderColor' => '#9BD0F5', // Example color
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
