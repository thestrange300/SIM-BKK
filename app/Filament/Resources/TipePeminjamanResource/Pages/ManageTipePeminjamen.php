<?php

namespace App\Filament\Resources\TipePeminjamanResource\Pages;

use App\Filament\Resources\TipePeminjamanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipePeminjamen extends ManageRecords
{
    protected static string $resource = TipePeminjamanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
