<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipeZakatFitrahResource\Pages;
use App\Filament\Resources\TipeZakatFitrahResource\RelationManagers;
use App\Models\TipeZakatFitrah;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipeZakatFitrahResource extends Resource
{
    protected static ?string $model = TipeZakatFitrah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Acara Khusus';
    protected static ?string $navigationLabel = 'Tipe Zakat Fitrah';
    protected static ?string $slug = 'tipe-zakat-fitrah';
    protected static ?string $modelLabel = 'Tipe Zakat Fitrah';
    protected static ?string $pluralModelLabel = 'Tipe Zakat Fitrah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Tipe Zakat Fitrah')
                    ->required()
                    ->maxLength(255),
                TextInput::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable()
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Tipe Zakat Fitrah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTipeZakatFitrahs::route('/'),
        ];
    }
}
