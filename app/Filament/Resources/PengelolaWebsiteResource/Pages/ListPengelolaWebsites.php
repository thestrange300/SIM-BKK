<?php

namespace App\Filament\Resources\PengelolaWebsiteResource\Pages;

use App\Filament\Resources\PengelolaWebsiteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengelolaWebsites extends ListRecords
{
    protected static string $resource = PengelolaWebsiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
