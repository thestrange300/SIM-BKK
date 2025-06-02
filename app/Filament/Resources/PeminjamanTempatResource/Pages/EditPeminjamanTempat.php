<?php

namespace App\Filament\Resources\PeminjamanTempatResource\Pages;

use App\Filament\Resources\PeminjamanTempatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPeminjamanTempat extends EditRecord
{
    protected static string $resource = PeminjamanTempatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
