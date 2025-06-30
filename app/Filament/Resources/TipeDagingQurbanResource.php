<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipeDagingQurbanResource\Pages;
use App\Filament\Resources\TipeDagingQurbanResource\RelationManagers;
use App\Models\TipeDagingQurban;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipeDagingQurbanResource extends Resource
{
    protected static ?string $model = TipeDagingQurban::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Kurban';
    protected static ?string $navigationLabel = 'Tipe Daging Qurban';
    protected static ?string $navigationParentItem = 'Distribusi Daging Qurban';
    protected static ?string $slug = 'tipe-daging-qurban';
    protected static ?string $modelLabel = 'Tipe Daging Qurban';
    protected static ?string $pluralModelLabel = 'Tipe Daging Qurban';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->label('Nama Tipe Daging')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('deskripsi')
                    ->label('Deskripsi')
                    ->maxLength(500)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nama')
                    ->label('Nama Tipe Daging')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ManageTipeDagingQurbans::route('/'),
        ];
    }
}
