<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Dflydev\DotAccessData\Data;
use App\Models\PeminjamanTempat;
use App\Models\PetugasKeagamaan;
use App\Filament\Resources\DataInventarisResource\Widgets\DataInventarisChartLine;
use App\Filament\Resources\DataInventarisResource\Widgets\DataInventarisChartTipe;
use App\Filament\Resources\DataInventarisResource\Widgets\DataInventarisStatsOverview;
use App\Filament\Resources\PeminjamanTempatResource\Widgets\PeminjamanTempatChartLine;
use App\Filament\Resources\PeminjamanTempatResource\Widgets\PeminjamanTempatChartTipe;
use App\Filament\Resources\PetugasKeagamaanResource\Widgets\PetugasKeagamaanChartLine;
use App\Filament\Resources\PetugasKeagamaanResource\Widgets\PetugasKeagamaanChartTipe;
use App\Filament\Resources\PeminjamanTempatResource\Widgets\PeminjamanTempatStatsOverview;
use App\Filament\Resources\PetugasKeagamaanResource\Widgets\PetugasKeagamaanStatsOverview;
use App\Filament\Traits\AuthorizesFilamentPages;

class LaporanMasjid extends Page
{
    use AuthorizesFilamentPages;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Manajemen Masjid';
    protected static ?string $navigationLabel = 'Laporan Masjid';
    protected static ?string $modelLabel = 'Laporan Masjid';
    protected static ?string $pluralModelLabel = 'Laporan Masjid';
    protected static ?string $slug = 'laporan-masjid';

    protected static string $view = 'filament.pages.laporan-masjid';

    public function getHeaderWidgets(): array
    {
        return [
            DataInventarisStatsOverview::class,
            DataInventarisChartTipe::class,
            DataInventarisChartLine::class,
            PetugasKeagamaanStatsOverview::class,
            PetugasKeagamaanChartTipe::class,
            PetugasKeagamaanChartLine::class,
            PeminjamanTempatStatsOverview::class,
            PeminjamanTempatChartTipe::class,
            PeminjamanTempatChartLine::class,
        ];
    }
    
}
