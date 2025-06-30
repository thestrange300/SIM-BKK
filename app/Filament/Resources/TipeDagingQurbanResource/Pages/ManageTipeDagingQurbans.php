<?php

namespace App\Filament\Resources\TipeDagingQurbanResource\Pages;

use App\Filament\Resources\TipeDagingQurbanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTipeDagingQurbans extends ManageRecords
{
    protected static string $resource = TipeDagingQurbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
