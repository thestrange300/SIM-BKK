<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenZakatFitrahResource\Pages;
use App\Filament\Resources\PenZakatFitrahResource\RelationManagers;
use App\Models\PenZakatFitrah;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;

class PenZakatFitrahResource extends Resource
{
    protected static ?string $model = PenZakatFitrah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Acara Khusus';
    protected static ?string $navigationLabel = 'Penerimaan Zakat Fitrah';
    protected static ?string $slug = 'pen-zakat-fitrah';
    protected static ?string $modelLabel = 'Penerimaan Zakat Fitrah';
    protected static ?string $pluralModelLabel = 'Penerimaan Zakat Fitrah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal_penerimaan')
                    ->label('Tanggal Penerimaan')
                    ->default(Date::now())
                    ->required(),
                TextInput::make('nama_muzakki')
                    ->label('Nama Muzakki')
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
                    ->label('Tanggal Penerimaan')
                    ->sortable()
                    ->date(),
                TextColumn::make('nama_muzakki')
                    ->label('Nama Muzakki')
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
                    ->state(function (PenZakatFitrah $record): string {
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
            'index' => Pages\ListPenZakatFitrahs::route('/'),
            'create' => Pages\CreatePenZakatFitrah::route('/create'),
            'edit' => Pages\EditPenZakatFitrah::route('/{record}/edit'),
        ];
    }
}
