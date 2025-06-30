<?php

namespace App\Filament\Resources\DataInventarisResource\Pages;

use App\Filament\Resources\DataInventarisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataInventaris extends ListRecords
{
    protected static string $resource = DataInventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
