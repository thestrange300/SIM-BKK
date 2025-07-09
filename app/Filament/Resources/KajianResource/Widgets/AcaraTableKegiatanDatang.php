<?php

namespace App\Filament\Resources\KajianResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Kajian;
use App\Models\KhutbahJumat;
use Illuminate\Support\Facades\DB;

class AcaraTableKegiatanDatang extends BaseWidget
{
    protected static ?string $heading = 'Daftar Kegiatan Terbaru / Akan Datang';

    /**
     * Override to return a unique key for each record.
     */
    public function getTableRecordKey($record): string
    {
        return $record->record_key;
    }

    public function table(Table $table): Table
    {
        $today = now()->toDateString();

        // Query for Kajian events
        $kajianQuery = Kajian::query()
            ->where('tanggal', '>=', $today)
            ->select([
                'tanggal',
                DB::raw("'Kajian' as jenis"),
                'tema as judul',
                'penceramah.nama as nama',
                DB::raw("CONCAT('kajian-', kajian.id) as record_key"),
            ])
            ->join('petugas_keagamaan as penceramah', 'kajian.penceramah_id', '=', 'penceramah.id');

        // Query for Khutbah Jumat events
        $khutbahQuery = KhutbahJumat::query()
            ->where('tanggal', '>=', $today)
            ->select([
                'tanggal',
                DB::raw("'Khutbah Jumat' as jenis"),
                'judul',
                DB::raw("CONCAT(imam.nama, ' / ', khotib.nama) as nama"),
                DB::raw("CONCAT('khutbah-', khutbah_jumat.id) as record_key"),
            ])
            ->join('petugas_keagamaan as imam', 'khutbah_jumat.imam_id', '=', 'imam.id')
            ->join('petugas_keagamaan as khotib', 'khutbah_jumat.khotib_id', '=', 'khotib.id');

        // Combine both queries
        $unionQuery = $kajianQuery->unionAll($khutbahQuery);

        return $table
            ->query($unionQuery)
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis Kegiatan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Tema/Judul')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Penceramah/Khotib'),
            ])
            ->defaultSort('tanggal', 'asc')
            ->emptyStateIcon('heroicon-o-calendar')
            ->emptyStateHeading('Tidak ada kegiatan yang akan datang')
            ->paginated(false);
    }

    public function getColumnSpan(): int|string|array
    {
        return 2;
    }
}
