<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TipeInventaris;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TipeInventarisResource\Pages;
use App\Filament\Resources\TipeInventarisResource\RelationManagers;

class TipeInventarisResource extends Resource
{
    protected static ?string $model = TipeInventaris::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Masjid';
    protected static ?string $navigationLabel = 'Tipe Inventaris';
    protected static ?string $slug = 'tipe-inventaris';
    protected static ?string $modelLabel = 'Tipe Inventaris';
    protected static ?string $pluralModelLabel = 'Tipe Inventaris'; 
    protected static ?string $navigationParentItem = 'Data Inventaris';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Tipe Inventaris')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama tipe inventaris'),
                TextInput::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable()
                    ->maxLength(500)
                    ->placeholder('Masukkan deskripsi tipe inventaris'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama Tipe Inventaris')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->searchable()
                    ->sortable()
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
            'index' => Pages\ManageTipeInventaris::route('/'),
        ];
    }
}
