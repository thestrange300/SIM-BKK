<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Keuangan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TipePemasukan;
use App\Models\TipePengeluaran;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use App\Filament\Resources\KeuanganResource\Pages;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KeuanganResource\RelationManagers;
use App\Filament\Resources\KeuanganResource\Pages\EditKeuangan;
use App\Filament\Resources\KeuanganResource\Pages\ListKeuangans;
use App\Filament\Resources\KeuanganResource\Pages\CreateKeuangan;

class KeuanganResource extends Resource
{
    protected static ?string $model = Keuangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Manajemen Keuangan';
    protected static ?string $navigationLabel = 'Kelola Keuangan';
    protected static ?string $slug = 'keuangan';
    protected static ?string $modelLabel = 'Keuangan';
    protected static ?string $pluralModelLabel = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            DatePicker::make('tanggal')
                ->required()
                ->default(Date::now()),
            TextInput::make('deskripsi')
            ->required()
            ->maxLength(255)
            ->placeholder('Masukkan deskripsi atau keterangan transaksi'),
            TextInput::make('jumlah')
                ->numeric()
                ->required()
                ->placeholder('Masukkan jumlah uang'),
            Select::make('jenis')
                ->options([
                    'pemasukan' => 'Pemasukan',
                    'pengeluaran' => 'Pengeluaran',
                ])
                ->required()
                ->live(),

            // Conditional Select Fields
            Select::make('tipe_id')
                ->label('Tipe Pemasukan')
                ->options(fn () => TipePemasukan::pluck('nama', 'id'))
                ->visible(fn ($get) => $get('jenis') === 'pemasukan')
                ->required(),

            Select::make('tipe_id')
                ->label('Tipe Pengeluaran')
                ->options(fn () => TipePengeluaran::pluck('nama', 'id'))
                ->visible(fn ($get) => $get('jenis') === 'pengeluaran')
                ->required(),

            Hidden::make('user_id')
                ->default(fn () => Auth::user()->id),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                TextColumn::make('deskripsi')
                ->searchable(),
                TextColumn::make('jumlah')->money('IDR'),
                TextColumn::make('user.name')->label('Dinput Oleh'),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->options([
                        'pemasukan' => 'Pemasukan',
                        'pengeluaran' => 'Pengeluaran',
                    ]),
                TrashedFilter::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeuangans::route('/'),
            'create' => Pages\CreateKeuangan::route('/create'),
            'edit' => Pages\EditKeuangan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
