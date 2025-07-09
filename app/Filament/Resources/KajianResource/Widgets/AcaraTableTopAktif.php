<?php

namespace App\Filament\Resources\KajianResource\Widgets;

use App\Models\PetugasKeagamaan;
use Illuminate\Support\Facades\DB;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class AcaraTableTopAktif extends BaseWidget
{

    protected static ?string $heading = 'Petugas Keagamaan Aktif Saat Ini';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                PetugasKeagamaan::query()
                    ->select('petugas_keagamaan.*')
                    ->selectRaw(
                        '(
                            (SELECT COUNT(*) FROM kajian WHERE kajian.penceramah_id = petugas_keagamaan.id)
                            + (SELECT COUNT(*) FROM khutbah_jumat WHERE khutbah_jumat.imam_id = petugas_keagamaan.id)
                            + (SELECT COUNT(*) FROM khutbah_jumat WHERE khutbah_jumat.khotib_id = petugas_keagamaan.id)
                        ) as kegiatan_count'
                    )
                    ->orderByDesc('kegiatan_count')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable(),
                TextColumn::make('kegiatan_count')
                    ->label('Jumlah Kegiatan')
                    ->sortable(),
            ]);
    }
}
