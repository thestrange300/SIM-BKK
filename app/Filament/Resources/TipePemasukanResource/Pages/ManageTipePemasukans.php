<?php

namespace App\Filament\Resources\TipePemasukanResource\Pages;

use App\Filament\Resources\TipePemasukanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipePemasukans extends ManageRecords
{
    protected static string $resource = TipePemasukanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
