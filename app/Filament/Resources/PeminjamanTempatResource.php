<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Ramsey\Uuid\Type\Time;
use App\Models\PeminjamanTempat;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PeminjamanTempatResource\Pages;
use App\Filament\Resources\PeminjamanTempatResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class PeminjamanTempatResource extends Resource
{
    protected static ?string $model = PeminjamanTempat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Acara';
    protected static ?string $navigationLabel = 'Peminjaman Tempat';
    protected static ?string $slug = 'peminjaman-tempat';
    protected static ?string $modelLabel = 'Peminjaman Tempat';
    protected static ?string $pluralModelLabel = 'Peminjaman Tempat';    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->required()
                    ->maxLength(255),
                TextInput::make('kontak')
                    ->label('Kontak')
                    ->nullable()
                    ->tel()
                    ->maxLength(255),
                DatePicker::make('tanggal')
                    ->label('Tanggal Peminjaman')
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
                Select::make('tipe_peminjaman_id')
                    ->label('Tipe Peminjaman')
                    ->relationship('tipePeminjaman', 'nama')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextArea::make('keterangan')
                    ->label('Keterangan')
                    ->nullable()
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal Peminjaman')
                    ->date('d M, Y')
                    ->sortable(),
                TextColumn::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->time()
                    ->sortable(),
                TextColumn::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->time()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tipePeminjaman.nama')
                    ->label('Tipe Peminjaman')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
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
            'index' => Pages\ListPeminjamanTempats::route('/'),
            'create' => Pages\CreatePeminjamanTempat::route('/create'),
            'edit' => Pages\EditPeminjamanTempat::route('/{record}/edit'),
        ];
    }
}
