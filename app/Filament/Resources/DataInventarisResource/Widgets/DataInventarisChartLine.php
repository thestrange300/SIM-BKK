<?php

namespace App\Filament\Resources\DataInventarisResource\Widgets;

use App\Models\DataInventaris;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class DataInventarisChartLine extends ChartWidget
{
    protected static ?string $heading = 'Grafik Perkembangan Inventaris';
    protected static ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        // Get the last 12 months (including current month)
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');
            $data[] = DataInventaris::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Inventaris',
                    'data' => $data,
                    'borderColor' => '#16a34a',
                    'backgroundColor' => 'rgba(22,163,74,0.2)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
