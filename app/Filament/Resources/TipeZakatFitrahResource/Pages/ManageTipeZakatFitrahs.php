<?php

namespace App\Filament\Resources\TipeZakatFitrahResource\Pages;

use App\Filament\Resources\TipeZakatFitrahResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipeZakatFitrahs extends ManageRecords
{
    protected static string $resource = TipeZakatFitrahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
