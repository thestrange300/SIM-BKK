<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\TipePengeluaran;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TipePengeluaranResource\Pages;
use App\Filament\Resources\TipePengeluaranResource\RelationManagers;

class TipePengeluaranResource extends Resource
{
    protected static ?string $model = TipePengeluaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Manajemen Keuangan';
    protected static ?string $navigationParentItem = 'Kelola Keuangan';
    protected static ?string $navigationLabel = 'Tipe Pengeluaran';
    protected static ?string $slug = 'tipe-pengeluaran';
    protected static ?string $modelLabel = 'Tipe Pengeluaran';
    protected static ?string $pluralModelLabel = 'Tipe Pengeluaran';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
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
            'index' => Pages\ManageTipePengeluarans::route('/'),
        ];
    }
}
