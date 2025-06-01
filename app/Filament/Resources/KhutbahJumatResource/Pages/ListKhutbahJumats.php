<?php

namespace App\Filament\Resources\KhutbahJumatResource\Pages;

use App\Filament\Resources\KhutbahJumatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKhutbahJumats extends ListRecords
{
    protected static string $resource = KhutbahJumatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
