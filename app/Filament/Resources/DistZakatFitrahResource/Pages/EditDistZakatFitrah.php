<?php

namespace App\Filament\Resources\DistZakatFitrahResource\Pages;

use App\Filament\Resources\DistZakatFitrahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistZakatFitrah extends EditRecord
{
    protected static string $resource = DistZakatFitrahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
