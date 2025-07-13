<?php

namespace App\Filament\Resources\PengelolaWebsiteResource\Pages;

use App\Filament\Resources\PengelolaWebsiteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengelolaWebsite extends EditRecord
{
    protected static string $resource = PengelolaWebsiteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
