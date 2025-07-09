<?php

namespace App\Filament\Resources\KajianResource\Widgets;

use App\Models\Kajian;
use App\Models\KhutbahJumat;
use Filament\Widgets\ChartWidget;

class AcaraChart extends ChartWidget
{
    protected static ?string $heading = 'Perbandingan Kegiatan Kajian dan Khutbah Jumat';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Ambil total jumlah record
        $totalKajian = Kajian::count();
        $totalKhutbah = KhutbahJumat::count();

        return [
            'labels' => [
                'Kajian',
                'Khutbah Jumat',
            ],
            'datasets' => [
                [
                    'label' => 'Jumlah Kegiatan',
                    'data' => [
                        $totalKajian,
                        $totalKhutbah,
                    ],
                    'backgroundColor' => [
                        'rgba(46, 204, 113, 0.6)', // Warna hijau palet untuk Kajian
                        'rgba(34, 139, 34, 0.6)', // Warna hijau palet untuk Khutbah Jumat
                    ],
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
