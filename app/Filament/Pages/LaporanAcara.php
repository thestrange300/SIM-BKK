<?php

namespace App\Filament\Pages;

use App\Filament\Resources\KajianResource\Widgets\AcaraChart;
use Filament\Pages\Page;
use App\Filament\Resources\KajianResource\Widgets\AcaraStatsOverview;
use App\Filament\Resources\KajianResource\Widgets\AcaraTableTopAktif;
use App\Filament\Resources\KajianResource\Widgets\AcaraTableKegiatanDatang;
use App\Filament\Traits\AuthorizesFilamentPages;

class LaporanAcara extends Page
{
    use AuthorizesFilamentPages;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Manajemen Acara';
    protected static ?string $navigationLabel = 'Laporan Acara';
    protected static ?string $modelLabel = 'Laporan Acara';
    protected static ?string $pluralModelLabel = 'Laporan Acara';
    protected static ?string $slug = 'laporan-acara';

    protected static string $view = 'filament.pages.laporan-acara';

    public function getHeaderWidgets(): array
    {
        return [
            AcaraStatsOverview::class,
            AcaraTableKegiatanDatang::class,
            AcaraTableTopAktif::class,
            AcaraChart::class,
        ];
    }
}
