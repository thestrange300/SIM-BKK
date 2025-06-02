<?php

namespace App\Filament\Resources\DistZakatFitrahResource\Pages;

use App\Filament\Resources\DistZakatFitrahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistZakatFitrahs extends ListRecords
{
    protected static string $resource = DistZakatFitrahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
