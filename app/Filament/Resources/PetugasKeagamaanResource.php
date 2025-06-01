<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PetugasKeagamaan;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PetugasKeagamaanResource\Pages;
use App\Filament\Resources\PetugasKeagamaanResource\RelationManagers;
use App\Filament\Resources\PetugasKeagamaanResource\Pages\EditPetugasKeagamaan;
use App\Filament\Resources\PetugasKeagamaanResource\Pages\ListPetugasKeagamaans;
use App\Filament\Resources\PetugasKeagamaanResource\Pages\CreatePetugasKeagamaan;

class PetugasKeagamaanResource extends Resource
{
    protected static ?string $model = PetugasKeagamaan::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Manajemen Masjid';
    protected static ?string $navigationLabel = 'Petugas Keagamaan';
    protected static ?string $slug = 'petugas-keagamaan';
    protected static ?string $modelLabel = 'Petugas Keagamaan';
    protected static ?string $pluralModelLabel = 'Petugas Keagamaan'; 

    public static array $kategoriOptions = [
        'imam' => 'Imam',
        'khotib' => 'Khotib',
        'muadzin' => 'Muadzin', 
        'penceramah' => 'Penceramah'
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kontak')
                    ->tel()
                    ->maxLength(255),                
                Textarea::make('alamat')
                    ->maxLength(65535),
                Textarea::make('keterangan')
                    ->maxLength(65535),
                Select::make('kategori')
                    ->required()
                    ->options(static::$kategoriOptions)
                    ->placeholder('Pilih Kategori')
                    ->searchable()
                    ->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('kategori')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)), 
                TextColumn::make('kontak')
                    ->searchable(),
                TextColumn::make('alamat')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('keterangan')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
            'index' => Pages\ListPetugasKeagamaans::route('/'),
            'create' => Pages\CreatePetugasKeagamaan::route('/create'),
            'edit' => Pages\EditPetugasKeagamaan::route('/{record}/edit'),
        ];
    }
}
