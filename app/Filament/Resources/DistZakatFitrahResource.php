<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DistZakatFitrah;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DistZakatFitrahResource\Pages;
use App\Filament\Resources\DistZakatFitrahResource\RelationManagers;
use App\Filament\Resources\DistZakatFitrahResource\Pages\EditDistZakatFitrah;
use App\Filament\Resources\DistZakatFitrahResource\Pages\ListDistZakatFitrahs;
use App\Filament\Resources\DistZakatFitrahResource\Pages\CreateDistZakatFitrah;

class DistZakatFitrahResource extends Resource
{
    protected static ?string $model = DistZakatFitrah::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Manajemen Zakat';
    protected static ?string $navigationLabel = 'Distribusi Zakat Fitrah';
    protected static ?string $slug = 'dist-zakat-fitrah';
    protected static ?string $modelLabel = 'Distribusi Zakat Fitrah';
    protected static ?string $pluralModelLabel = 'Distribusi Zakat Fitrah';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal_penerimaan')
                    ->label('Tanggal Penerimaan')
                    ->default(Date::now())
                    ->required(),
                TextInput::make('nama_mustahik')
                    ->label('Nama Mustahik')
                    ->required()
                    ->maxLength(255),
                TextInput::make('alamat')
                    ->label('Alamat')
                    ->nullable()
                    ->maxLength(255),
                Select::make('tipe_zakat_fitrah_id')
                    ->label('Tipe Zakat Fitrah')
                    ->relationship('tipeZakatFitrah', 'nama')
                    ->required()
                    ->live()
                    ->disabled(fn ($context) => $context === 'edit'),
                TextInput::make('jumlah_makanan_pokok')
                    ->label('Jumlah Makanan Pokok (kg)')
                    ->numeric()
                    ->required()
                    ->hidden(fn (callable $get): bool => $get('tipe_zakat_fitrah_id') == 1),
                TextInput::make('jumlah_uang')
                    ->label('Jumlah Uang (Rp)')
                    ->numeric()
                    ->required()
                    ->hidden(fn (callable $get): bool => $get('tipe_zakat_fitrah_id') != 1),
                TextInput::make('keterangan')
                    ->label('Keterangan')
                    ->nullable()
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_penerimaan')
                    ->label('Tanggal Terima')
                    ->sortable()
                    ->date(),
                TextColumn::make('nama_mustahik')
                    ->label('Nama Mustahik')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alamat')
                    ->label('Alamat')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('tipeZakatFitrah.nama')
                    ->label('Tipe Zakat Fitrah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('terjumlah')
                    ->label('Terjumlah')
                    ->state(function (DistZakatFitrah $record): string {
                        if ($record->tipe_zakat_fitrah_id === 1) {
                            return 'Rp ' . number_format($record->jumlah_uang ?? 0, 2, ',', '.') . '';
                        }
                        return ($record->jumlah_makanan_pokok ?? 0) . ' Kg';
                    }),
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDistZakatFitrahs::route('/'),
            'create' => Pages\CreateDistZakatFitrah::route('/create'),
            'edit' => Pages\EditDistZakatFitrah::route('/{record}/edit'),
        ];
    }
}
