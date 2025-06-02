<?php

namespace App\Filament\Resources\PenZakatFitrahResource\Pages;

use App\Filament\Resources\PenZakatFitrahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenZakatFitrah extends EditRecord
{
    protected static string $resource = PenZakatFitrahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
