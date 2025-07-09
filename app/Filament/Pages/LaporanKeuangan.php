<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Resources\KeuanganResource\Widgets\KeuanganTable;
use App\Filament\Resources\KeuanganResource\Widgets\KeuanganChartLine;
use App\Filament\Resources\KeuanganResource\Widgets\KeuanganStatsOverview;
use App\Filament\Resources\KeuanganResource\Widgets\KeuanganChartPiePemasukan;
use App\Filament\Resources\KeuanganResource\Widgets\KeuanganChartPiePengeluaran;

class LaporanKeuangan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Laporan Keuangan';
    protected static ?string $modelLabel = 'Laporan Keuangan';
    protected static ?string $pluralModelLabel = 'Laporan Keuangan';
    protected static string $view = 'filament.pages.laporan-keuangan';
    protected static ?string $slug = 'laporan-keuangan';

    public function getHeaderWidgets(): array
    {
        return [
            KeuanganStatsOverview::class,
            KeuanganChartLine::class,
            KeuanganChartPiePemasukan::class,
            KeuanganChartPiePengeluaran::class,
            KeuanganTable::class
        ];
    }
}
