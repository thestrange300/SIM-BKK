<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KajianResource\Pages;
use App\Filament\Resources\KajianResource\RelationManagers;
use App\Models\Kajian;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KajianResource extends Resource
{
    protected static ?string $model = Kajian::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Acara';
    protected static ?string $navigationLabel = 'Kajian dan Majelis Ilmu';
    protected static ?string $slug = 'kajian';
    protected static ?string $modelLabel = 'Kajian';
    protected static ?string $pluralModelLabel = 'Kajian';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('tema')
                    ->label('Tema Kajian')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('tanggal')
                    ->label('Tanggal Kajian')
                    ->required(),
                TimePicker::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->required()
                    ->hoursStep(1)
                    ->minutesStep(1)
                    ->seconds(false),
                TimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->nullable()
                    ->hoursStep(1)
                    ->minutesStep(1)
                    ->seconds(false),
                TextArea::make('catatan')
                    ->label('Catatan')
                    ->nullable()
                    ->maxLength(500),
                Select::make('penceramah_id')
                    ->label('Penceramah')
                    ->relationship('penceramah', 'nama', fn ($query) => $query->penceramah())
                    ->required()
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal Kajian')
                    ->date()
                    ->sortable(),
                TextColumn::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->time()
                    ->sortable(),                    
                TextColumn::make('tema')
                    ->label('Tema Kajian')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('penceramah.nama')
                    ->label('Penceramah')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListKajians::route('/'),
            'create' => Pages\CreateKajian::route('/create'),
            'edit' => Pages\EditKajian::route('/{record}/edit'),
        ];
    }
}
