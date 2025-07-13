<?php

namespace App\Filament\Pages;

use App\Filament\Resources\PenZakatFitrahResource\Widgets\ZakatFitrahChartBarMakanan;
use App\Filament\Resources\PenZakatFitrahResource\Widgets\ZakatFitrahChartBarUang;
use App\Filament\Resources\PenZakatFitrahResource\Widgets\ZakatFitrahChartDoughnut;
use App\Filament\Resources\PenZakatFitrahResource\Widgets\ZakatFitrahStats;
use App\Filament\Resources\PenZakatFitrahResource\Widgets\ZakatFitrahStatsOverview;
use App\Filament\Resources\PenZakatFitrahResource\Widgets\ZakatFitrahTable;
use App\Filament\Traits\AuthorizesFilamentPages;
use Filament\Pages\Page;

class LaporanZakatFitrah extends Page
{
    use AuthorizesFilamentPages;

    protected static string $view = 'filament.pages.laporan-zakat-fitrah';

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Manajemen Zakat';
    protected static ?string $navigationLabel = 'Laporan Zakat Fitrah';
    protected static ?string $modelLabel = 'Laporan Zakat Fitrah';
    protected static ?string $pluralModelLabel = 'Laporan Zakat Fitrah';

    public function getHeaderWidgets(): array
    {
        return [
            ZakatFitrahStatsOverview::class,
            ZakatFitrahChartBarUang::class,
            ZakatFitrahChartBarMakanan::class,
            ZakatFitrahChartDoughnut::class,
            ZakatFitrahStats::class
        ];
    }
}
