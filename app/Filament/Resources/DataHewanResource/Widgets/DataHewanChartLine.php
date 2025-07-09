<?php

namespace App\Filament\Resources\DataHewanResource\Widgets;

use App\Models\DistDagingQurban;
use Filament\Widgets\ChartWidget;

class DataHewanChartLine extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Distribusi Per Tahun';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = DistDagingQurban::select('created_at', 'berat', 'jumlah_penerima')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->year;
            })
            ->map(function ($yearGroup) {
                return [
                    'year' => $yearGroup->first()->created_at->year,
                    'total_distribusi' => $yearGroup->count(),
                ];
            })
            ->sortBy('year')
            ->values();

        return [
            'labels' => $data->pluck('year')->toArray(),
            'datasets' => [
                [
                    'label' => 'Jumlah Distribusi',
                    'data' => $data->pluck('total_distribusi')->toArray(),
                    'borderColor' => '#10b981', // success color
                    'backgroundColor' => '#10b981', // success color
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
}
