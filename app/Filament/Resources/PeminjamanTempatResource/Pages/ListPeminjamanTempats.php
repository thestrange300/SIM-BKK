<?php

namespace App\Filament\Resources\PeminjamanTempatResource\Pages;

use App\Filament\Resources\PeminjamanTempatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeminjamanTempats extends ListRecords
{
    protected static string $resource = PeminjamanTempatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
