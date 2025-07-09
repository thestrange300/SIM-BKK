<?php

namespace App\Filament\Resources\DataHewanResource\Widgets;

use App\Models\DistDagingQurban;
use Filament\Widgets\ChartWidget;
use App\Models\TipeDagingQurban;


class DataHewanChart extends ChartWidget
{
    protected static ?string $heading = 'Distribusi Berdasarkan Tipe Daging';
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Ambil semua tipe daging qurban
        $tipeList = \App\Models\TipeDagingQurban::all()->keyBy('id');
        $labels = [];
        $data = [];

        // Siapkan array untuk menghitung jumlah distribusi per tipe
        $countPerTipe = [];
        foreach ($tipeList as $tipe) {
            $labels[] = $tipe->nama;
            $countPerTipe[$tipe->id] = 0;
        }

        // Ambil semua distribusi
        $distribusi = \App\Models\DistDagingQurban::all();

        foreach ($distribusi as $dist) {
            $tipeArr = $dist->tipe_daging_qurban ?? [];
            if (!is_array($tipeArr)) {
                $tipeArr = json_decode($tipeArr, true) ?: [];
            }
            foreach ($tipeArr as $tipeId) {
                // Jika id valid, tambahkan hitungan
                if (isset($countPerTipe[$tipeId])) {
                    $countPerTipe[$tipeId]++;
                }
            }
        }

        // Susun data sesuai urutan label
        foreach ($tipeList as $tipe) {
            $data[] = $countPerTipe[$tipe->id];
        }

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => [
                        '#166534', // green-800
                        '#15803d', // green-700
                        '#16a34a', // green-600
                        '#22c55e', // green-500
                        '#4ade80', // green-400
                        '#86efac', // green-300
                        '#d9f991', // lime-200
                        '#facc15', // yellow-500
                    ],
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
