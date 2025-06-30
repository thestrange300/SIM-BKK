<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use App\Models\Kajian;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KajianResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KajianResource\RelationManagers;

class KajianResource extends Resource
{
    protected static ?string $model = Kajian::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
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
                    ->label('Judul Kajian')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan tema atau judul kajian')
                    ->columnSpan(3),
                Select::make('penceramah_id')
                    ->label('Penceramah')
                    ->relationship('penceramah', 'nama', fn ($query) => $query->penceramah())
                    ->required()
                    ->searchable()
                    ->preload()                
                    ->columnSpan(3),
                DatePicker::make('tanggal')
                    ->label('Tanggal Kajian')
                    ->required()
                    ->columnSpan(2),                    
                TimePicker::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->required()
                    ->hoursStep(1)
                    ->minutesStep(1)
                    ->seconds(false)
                    ->columnSpan(2),
                TimePicker::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->nullable()
                    ->hoursStep(1)
                    ->minutesStep(1)
                    ->seconds(false)
                    ->columnSpan(2),
                TextArea::make('catatan')
                    ->label('Catatan Kajian')
                    ->nullable()
                    ->maxLength(500)
                    ->columnSpanFull(),
            ])->columns(6);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal Kajian')
                    ->date('d M, Y')
                    ->sortable()
                    ->color(fn ($record) => Carbon::parse($record->tanggal)->isFuture() ? 'success' : null)
                    ->weight(fn ($record) => Carbon::parse($record->tanggal)->isFuture() ? 'bold' : null),                    
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
            ])->defaultSort('tanggal', 'desc');
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
