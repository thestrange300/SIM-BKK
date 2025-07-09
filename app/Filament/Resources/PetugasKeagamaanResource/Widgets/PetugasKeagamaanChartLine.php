<?php

namespace App\Filament\Resources\PetugasKeagamaanResource\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class PetugasKeagamaanChartLine extends ChartWidget
{
    protected static ?string $heading = 'Grafik Perkembangan Petugas Keagamaan';

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        // Get the last 12 months (including current month)
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');
            // Untuk SQLite, gunakan whereRaw dengan strftime
            $count = \App\Models\PetugasKeagamaan::whereRaw("strftime('%Y', created_at) = ? AND strftime('%m', created_at) = ?", [
                $month->format('Y'),
                $month->format('m'),
            ])->count();
            $data[] = $count;
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Petugas Baru',
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
