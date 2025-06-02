<?php

namespace App\Filament\Resources\PenZakatFitrahResource\Pages;

use App\Filament\Resources\PenZakatFitrahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenZakatFitrahs extends ListRecords
{
    protected static string $resource = PenZakatFitrahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
