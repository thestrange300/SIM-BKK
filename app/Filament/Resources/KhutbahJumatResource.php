<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\KhutbahJumat;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KhutbahJumatResource\Pages;
use App\Filament\Resources\KhutbahJumatResource\RelationManagers;

class KhutbahJumatResource extends Resource
{
    protected static ?string $model = KhutbahJumat::class;
    protected static ?string $navigationIcon = 'heroicon-o-speaker-wave';
    protected static ?string $navigationGroup = 'Manajemen Acara';
    protected static ?string $navigationLabel = 'Khutbah Jumat';
    protected static ?string $slug = 'khutbah-jumat';
    protected static ?string $modelLabel = 'Khutbah Jumat';
    protected static ?string $pluralModelLabel = 'Khutbah Jumat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal')
                    ->required()
                    ->label('Tanggal Khutbah'),
                TextInput::make(('judul'))
                    ->maxLength(255)
                    ->label('Judul Khutbah')
                    ->nullable(),
                Select::make('imam_id')
                    ->label('Imam')
                    ->relationship('imam', 'nama', fn ($query) => $query->imam())
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('khotib_id')
                    ->label('Khotib')
                    ->relationship('khotib', 'nama', fn ($query) => $query->khotib())
                    ->required()
                    ->searchable()
                    ->preload(),
                Textarea::make('catatan')
                    ->maxLength(65535)
                    ->label('Catatan Khutbah')
                    ->nullable()
                    ->columnSpanFull(),                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal Khutbah')
                    ->date('d M, Y')
                    ->sortable()
                    ->color(fn ($record) => Carbon::parse($record->tanggal)->isFuture() ? 'success' : null)
                    ->weight(fn ($record) => Carbon::parse($record->tanggal)->isFuture() ? 'bold' : null),
                TextColumn::make('khotib.nama')
                    ->label('Khotib')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('imam.nama')
                    ->label('Imam')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('judul')
                    ->label('Judul Khutbah')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('catatan')
                    ->label('Catatan Khutbah')
                    ->sortable()
                    ->searchable()
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
            'index' => Pages\ListKhutbahJumats::route('/'),
            'create' => Pages\CreateKhutbahJumat::route('/create'),
            'edit' => Pages\EditKhutbahJumat::route('/{record}/edit'),
        ];
    }
}
