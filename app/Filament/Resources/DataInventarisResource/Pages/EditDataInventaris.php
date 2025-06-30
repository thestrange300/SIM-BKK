<?php

namespace App\Filament\Resources\DataInventarisResource\Pages;

use App\Filament\Resources\DataInventarisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataInventaris extends EditRecord
{
    protected static string $resource = DataInventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
