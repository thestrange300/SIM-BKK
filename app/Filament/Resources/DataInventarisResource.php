<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DataInventaris;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DataInventarisResource\Pages;
use App\Filament\Resources\DataInventarisResource\RelationManagers;

class DataInventarisResource extends Resource
{
    protected static ?string $model = DataInventaris::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Manajemen Masjid';
    protected static ?string $navigationLabel = 'Data Inventaris';
    protected static ?string $slug = 'data-inventaris';
    protected static ?string $modelLabel = 'Data Inventaris';
    protected static ?string $pluralModelLabel = 'Data Inventaris'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_barang')
                    ->label('Kode Barang')
                    ->required()
                    ->maxLength(50)
                    ->placeholder('Otomatis: INV-YYMM-XXX')
                    ->disabled() // User cannot edit
                    ->dehydrated() // Value is still submitted
                    ->live()
                    ->afterStateHydrated(function ($component, $state, $record, $set) {
                        if ($record) {
                            return;
                        }
                        $year = date('y');
                        $month = date('m');
                        $last = \App\Models\DataInventaris::whereYear('created_at', date('Y'))
                            ->whereMonth('created_at', date('m'))
                            ->orderByDesc('kode_barang')
                            ->first();
                        if ($last && preg_match('/INV-\d{4}-(\d{3})/', $last->kode_barang, $matches)) {
                            $urutan = str_pad(((int)$matches[1]) + 1, 3, '0', STR_PAD_LEFT);
                        } else {
                            $urutan = '001';
                        }
                        $set('kode_barang', "INV-{$year}{$month}-{$urutan}");
                    })
                    ->afterStateUpdated(function ($operation, $set, $get) {
                        if ($operation !== 'create') {
                            return;
                        }
                        $tanggal = now();
                        $year = date('y', strtotime($tanggal));
                        $month = date('m', strtotime($tanggal));
                        $last = \App\Models\DataInventaris::whereYear('created_at', date('Y', strtotime($tanggal)))
                            ->whereMonth('created_at', date('m', strtotime($tanggal)))
                            ->orderByDesc('kode_barang')
                            ->first();
                        if ($last && preg_match('/INV-\d{4}-(\d{3})/', $last->kode_barang, $matches)) {
                            $urutan = str_pad(((int)$matches[1]) + 1, 3, '0', STR_PAD_LEFT);
                        } else {
                            $urutan = '001';
                        }
                        $set('kode_barang', "INV-{$year}{$month}-{$urutan}");
                    }),
                TextInput::make('nama_barang')
                    ->label('Nama Barang')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama barang'),
                TextInput::make('serial_number')
                    ->label('Serial Number')
                    ->nullable()
                    ->maxLength(100)
                    ->placeholder('Masukkan serial number (jika ada)'),
                TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->placeholder('Masukkan jumlah barang'),
                Select::make('tipe_inventaris_id')
                    ->label('Tipe Inventaris')
                    ->required()
                    ->relationship('tipeInventaris', 'nama')
                    ->searchable()
                    ->placeholder('Pilih tipe inventaris')
                    ->preload(),
                TextInput::make('lokasi')   
                    ->label('Lokasi')
                    ->nullable()
                    ->maxLength(255)
                    ->placeholder('Masukkan lokasi barang'),
                Select::make('kondisi')
                    ->label('Kondisi')
                    ->options([
                        'Baik' => 'Baik',
                        'Rusak Ringan' => 'Rusak Ringan',
                        'Rusak Berat' => 'Rusak Berat',
                    ])
                    ->placeholder('Pilih kondisi barang'),
                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->nullable()
                    ->maxLength(500)
                    ->placeholder('Masukkan keterangan tambahan (jika ada)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')
                    ->label('Kode Barang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_barang')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('serial_number')
                    ->label('Serial Number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipeInventaris.nama')
                    ->label('Tipe Inventaris')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kondisi')
                    ->label('Kondisi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListDataInventaris::route('/'),
            'create' => Pages\CreateDataInventaris::route('/create'),
            'edit' => Pages\EditDataInventaris::route('/{record}/edit'),
        ];
    }
}
