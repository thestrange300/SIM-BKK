<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;
use App\Models\DistDagingQurban;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DistDagingQurbanResource\Pages;
use App\Filament\Resources\DistDagingQurbanResource\RelationManagers;

class DistDagingQurbanResource extends Resource
{
    protected static ?string $model = DistDagingQurban::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Manajemen Qurban';
    protected static ?string $navigationLabel = 'Distribusi Daging Qurban';
    protected static ?string $slug = 'dist-daging-qurban';
    protected static ?string $modelLabel = 'Distribusi Daging Qurban';
    protected static ?string $pluralModelLabel = 'Distribusi Daging Qurban';   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal_penerimaan')
                    ->label('Tanggal Distribusi')
                    ->required()
                    ->default(Date::now()),
                TextInput::make('nama_penerima')
                    ->label('Nama Penerima')
                    ->required()
                    ->maxLength(255),
                TextInput::make('alamat')
                    ->maxLength(500)
                    ->label('Alamat Penerima'),
                Select::make('tipe_daging_qurban')
                    ->label('Tipe Daging Qurban')
                    ->options(\App\Models\TipeDagingQurban::pluck('nama', 'id'))
                    ->required()
                    ->searchable()
                    ->preload()
                    ->multiple(),
                TextInput::make('jumlah')
                    ->label('Jumlah (kg)')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(1000)
                    ->default(0),
                TextArea::make('keterangan')
                    ->label('Keterangan')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal_penerimaan')
                    ->label('Tanggal Distribusi')
                    ->date()
                    ->sortable(),
                TextColumn::make('nama_penerima')
                    ->label('Nama Penerima')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('alamat')
                    ->label('Alamat Penerima')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('tipe_daging_qurban')
                    ->label('Tipe Daging')
                    ->badge()
                    ->separator(',')
                    ->formatStateUsing(fn ($state) => collect($state)
                        ->map(fn ($id) => \App\Models\TipeDagingQurban::find($id)?->nama ?? '')
                        ->filter()
                        ->join(', '))
                    ->searchable(),
                TextColumn::make('jumlah')
                    ->label('Jumlah (kg)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(30)
                    ->searchable(),
            ])
            ->defaultSort('tanggal_penerimaan', 'desc')
            ->filters([
                Filter::make('tipe_daging_qurban_filter')
                    ->form([
                        Forms\Components\Select::make('selected_type_id')
                            ->label('Tipe Daging Qurban')
                            ->options(\App\Models\TipeDagingQurban::pluck('nama', 'id'))
                            ->nullable() // Allow clearing the filter
                            ->searchable()
                            ->preload(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        // Use whereJsonContains to filter by ID in the JSON array
                        return $query
                            ->when(
                                $data['selected_type_id'],
                                fn (Builder $query, $typeId): Builder => $query->whereJsonContains('tipe_daging_qurban', $typeId),
                            );
                    }),
                Filter::make('tanggal_penerimaan')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_penerimaan', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_penerimaan', '<=', $date),
                            );
                    })
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
            'index' => Pages\ListDistDagingQurbans::route('/'),
            'create' => Pages\CreateDistDagingQurban::route('/create'),
            'edit' => Pages\EditDistDagingQurban::route('/{record}/edit'),
        ];
    }
}
