<?php

namespace App\Filament\Resources\KeuanganResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\TipePemasukan;
use App\Models\TipePengeluaran;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class KeuanganTable extends BaseWidget
{
    protected static ?string $heading = 'Daftar 5 Transaksi dengan Jumlah Terbesar'; // Update heading
    protected static ?string $maxHeight = '400px';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\Keuangan::query()->orderByDesc('jumlah')->limit(5)
            )
            ->paginated(false)
            ->columns([
                TextColumn::make('tanggal')->date('d M Y'),
                TextColumn::make('jenis')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pemasukan' => 'Pemasukan',
                        'pengeluaran' => 'Pengeluaran',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pemasukan' => 'success',
                        'pengeluaran' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('tipe.nama')
                    ->label('Tipe')
                    ->formatStateUsing(function ($record) {
                        if ($record->jenis === 'pemasukan') {
                            return TipePemasukan::find($record->tipe_id)?->nama;
                        } else {
                            return TipePengeluaran::find($record->tipe_id)?->nama;
                        }
                    }),
                TextColumn::make('deskripsi'),
                TextColumn::make('jumlah')->money('IDR'),
            ]);
    }

    public function getColumnSpan(): int|string|array
    {
        return 2;
    }
}
