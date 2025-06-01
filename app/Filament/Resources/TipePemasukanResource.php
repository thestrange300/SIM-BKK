<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TipePemasukan;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TipePemasukanResource\Pages;
use App\Filament\Resources\TipePemasukanResource\RelationManagers;

class TipePemasukanResource extends Resource
{
    protected static ?string $model = TipePemasukan::class;
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Manajemen Keuangan';
    protected static ?string $navigationParentItem = 'Kelola Keuangan';
    protected static ?string $navigationLabel = 'Tipe Pemasukan';
    protected static ?string $slug = 'tipe-pemasukan';
    protected static ?string $modelLabel = 'Tipe Pemasukan';
    protected static ?string $pluralModelLabel = 'Tipe Pemasukan';


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
            'index' => Pages\ManageTipePemasukans::route('/'),
        ];
    }
}
