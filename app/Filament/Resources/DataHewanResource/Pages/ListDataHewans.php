<?php

namespace App\Filament\Resources\DataHewanResource\Pages;

use App\Filament\Resources\DataHewanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataHewans extends ListRecords
{
    protected static string $resource = DataHewanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
