<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\DataHewan;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DataHewanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DataHewanResource\RelationManagers;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class DataHewanResource extends Resource
{
    protected static ?string $model = DataHewan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Manajemen Kurban';
    protected static ?string $navigationLabel = 'Data Hewan Qurban';
    protected static ?string $slug = 'data-hewan-qurban';
    protected static ?string $modelLabel = 'Data Hewan Qurban';
    protected static ?string $pluralModelLabel = 'Data Hewan Qurban';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('id_hewan')
                    ->label('ID Hewan')
                    ->required()
                    ->disabled()      // user cannot edit
                    ->dehydrated()    // value is still submitted
                    ->maxLength(255)
                    ->placeholder('ID otomatis')
                    ->live(), 

                Select::make('jenis_hewan')
                    ->label('Jenis Hewan')
                    ->live()
                    ->options([
                        'Kambing' => 'Kambing',
                        'Sapi' => 'Sapi',
                        'Domba' => 'Domba',
                        'Kerbau' => 'Kerbau',
                        'Lainnya' => 'Lainnya'
                    ])
                    ->required()
                    ->afterStateUpdated(function($operation, $set, $get) {

                        if ($operation !== 'create') {
                            return; // Skip if not creating a new record
                        }

                        // Get year (last 2 digits)
                        $year = date('y');
                        // Get jenis_hewan from form state
                        $jenis = $get('jenis_hewan') ?? 'Sapi';
                        // Map jenis_hewan to code
                        $jenisMap = [
                            'Sapi' => 'S',
                            'Kambing' => 'K',
                            'Domba' => 'D',
                            'Kerbau' => 'B',
                            'Lainnya' => 'L',
                        ];
                        $jenisCode = $jenisMap[$jenis] ?? 'X';

                        // Ambil id_hewan terakhir untuk tahun & jenis ini
                        $last = \App\Models\DataHewan::whereYear('tanggal', date('Y'))
                            ->where('jenis_hewan', $jenis)
                            ->orderByDesc('id_hewan')
                            ->first();

                        if ($last && preg_match('/Q\d{2}-[A-Z]-(\d{3})/', $last->id_hewan, $matches)) {
                            $urutan = str_pad(((int)$matches[1]) + 1, 3, '0', STR_PAD_LEFT);
                        } else {
                            $urutan = '001';
                        }
                        $set('id_hewan', "Q{$year}-{$jenisCode}-{$urutan}");
                    }),

                TextInput::make('berat')
                    ->label('Berat (kg)')
                    ->numeric()
                    ->required(),

                DatePicker::make('tanggal')
                    ->label('Tanggal Hewan Diterima')
                    ->required()
                    ->default(now()),

                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->maxLength(65535)
                    ->placeholder('Masukkan deskripsi atau informasi tambahan tentang hewan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_hewan')
                    ->label('ID Hewan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenis_hewan')
                    ->label('Jenis Hewan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('berat')
                    ->label('Berat (kg)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal Diterima')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50),
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
            'index' => Pages\ListDataHewans::route('/'),
            'create' => Pages\CreateDataHewan::route('/create'),
            'edit' => Pages\EditDataHewan::route('/{record}/edit'),
        ];
    }
}
