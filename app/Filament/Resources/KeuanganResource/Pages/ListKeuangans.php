<?php

namespace App\Filament\Resources\KeuanganResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Asmit\ResizedColumn\HasResizableColumn;
use App\Filament\Resources\KeuanganResource;

class ListKeuangans extends ListRecords
{
    use HasResizableColumn;
    protected static string $resource = KeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
