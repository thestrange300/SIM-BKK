<?php

namespace App\Filament\Resources\DataHewanResource\Pages;

use App\Filament\Resources\DataHewanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataHewan extends EditRecord
{
    protected static string $resource = DataHewanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
