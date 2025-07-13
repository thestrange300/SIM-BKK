<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PengelolaWebsiteResource\Pages;
use App\Filament\Resources\PengelolaWebsiteResource\RelationManagers;

class PengelolaWebsiteResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Manajemen Masjid';
    protected static ?string $navigationLabel = 'Pengelola Website';
    protected static ?string $slug = 'pengelola-website';
    protected static ?string $modelLabel = 'Pengelola Website';
    protected static ?string $pluralModelLabel = 'Pengelola Website';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Pengelola')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email Pengelola')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->visible(fn ($livewire) => $livewire instanceof Pages\CreatePengelolaWebsite || $livewire instanceof Pages\EditPengelolaWebsite),
                TextInput::make('password_confirmation')
                    ->label('Konfirmasi Password')
                    ->password()
                    ->required()
                    ->same('password')
                    ->maxLength(255)
                    ->visible(fn ($livewire) => $livewire instanceof Pages\CreatePengelolaWebsite || $livewire instanceof Pages\EditPengelolaWebsite),
                Select::make('role')
                    ->label('Peran')
                    ->options([
                        'superadmin' => 'Super Admin',
                        'admin_acara' => 'Admin Acara',
                        'admin_keuangan' => 'Admin Keuangan',
                        'admin_masjid' => 'Admin Masjid',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengelola')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email Pengelola')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Peran')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Peran')
                    ->options([
                        'superadmin' => 'Super Admin',
                        'admin_acara' => 'Admin Acara',
                        'admin_keuangan' => 'Admin Keuangan',
                        'admin_masjid' => 'Admin Masjid',
                    ])
                    ->multiple(),
                Filter::make('name')
                    ->label('Nama Pengelola')
                    ->form([
                        TextInput::make('name')
                            ->label('Cari Nama Pengelola')
                            ->placeholder('Masukkan nama pengelola'),
                    ])
                    ->query(fn (Builder $query, array $data) => $query->where('name', 'like', '%' . $data['name'] . '%')),
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
            'index' => Pages\ListPengelolaWebsites::route('/'),
            'create' => Pages\CreatePengelolaWebsite::route('/create'),
            'edit' => Pages\EditPengelolaWebsite::route('/{record}/edit'),
        ];
    }
}
