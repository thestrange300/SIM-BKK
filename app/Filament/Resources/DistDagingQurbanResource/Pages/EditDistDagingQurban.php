<?php

namespace App\Filament\Resources\DistDagingQurbanResource\Pages;

use App\Filament\Resources\DistDagingQurbanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistDagingQurban extends EditRecord
{
    protected static string $resource = DistDagingQurbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
