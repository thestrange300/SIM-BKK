<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Dflydev\DotAccessData\Data;
use App\Filament\Resources\DataHewanResource\Widgets\DataHewanChart;
use App\Filament\Resources\DataHewanResource\Widgets\DataHewanChartLine;
use App\Filament\Resources\DataHewanResource\Widgets\DataHewanStatsOverview;

class LaporanQurban extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Laporan Qurban';
    protected static ?string $modelLabel = 'Laporan Qurban';
    protected static ?string $pluralModelLabel = 'Laporan Qurban';
    protected static string $view = 'filament.pages.laporan-qurban';
    protected static ?string $slug = 'laporan-qurban';

    public function getHeaderWidgets(): array
    {
        return [
            DataHewanStatsOverview::class,
            DataHewanChart::class,
            DataHewanChartLine::class,
        ];
    }
}
