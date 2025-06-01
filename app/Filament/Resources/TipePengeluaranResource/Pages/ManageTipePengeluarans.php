<?php

namespace App\Filament\Resources\TipePengeluaranResource\Pages;

use App\Filament\Resources\TipePengeluaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipePengeluarans extends ManageRecords
{
    protected static string $resource = TipePengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
