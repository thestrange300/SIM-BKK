<?php

namespace App\Filament\Resources\TipeInventarisResource\Pages;

use App\Filament\Resources\TipeInventarisResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipeInventaris extends ManageRecords
{
    protected static string $resource = TipeInventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
