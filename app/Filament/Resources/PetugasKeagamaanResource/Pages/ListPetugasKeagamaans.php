<?php

namespace App\Filament\Resources\PetugasKeagamaanResource\Pages;

use App\Filament\Resources\PetugasKeagamaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPetugasKeagamaans extends ListRecords
{
    protected static string $resource = PetugasKeagamaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
