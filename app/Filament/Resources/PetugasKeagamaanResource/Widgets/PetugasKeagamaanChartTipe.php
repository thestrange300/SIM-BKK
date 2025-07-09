<?php

namespace App\Filament\Resources\PetugasKeagamaanResource\Widgets;

use Filament\Widgets\ChartWidget;

class PetugasKeagamaanChartTipe extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Petugas per Kategori';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Kategori dan label
        $kategoriOptions = [
            'imam' => 'Imam',
            'khotib' => 'Khotib',
            'muadzin' => 'Muadzin',
            'penceramah' => 'Penceramah',
        ];

        // Hitung jumlah petugas per kategori (karena kategori berupa array/json, gunakan whereJsonContains)
        $counts = [];
        foreach ($kategoriOptions as $key => $label) {
            $counts[] = \App\Models\PetugasKeagamaan::whereJsonContains('kategori', $key)->count();
        }

        // Palet warna hijau
        $colors = [
            '#166534', // green-800
            '#15803d', // green-700
            '#16a34a', // green-600
            '#22c55e', // green-500
        ];

        return [
            'labels' => array_values($kategoriOptions),
            'datasets' => [
                [
                    'label' => 'Jumlah Petugas',
                    'data' => $counts,
                    'backgroundColor' => $colors,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    // protected function getOptions(): array
    // {
    //     return [
    //         'plugins' => [
    //             'legend' => [
    //                 'display' => false,
    //             ],
    //         ],
    //     ];
    // }    
}
