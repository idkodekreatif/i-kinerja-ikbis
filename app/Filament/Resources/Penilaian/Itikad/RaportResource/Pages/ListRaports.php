<?php

namespace App\Filament\Resources\Penilaian\Itikad\RaportResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\RaportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRaports extends ListRecords
{
    protected static string $resource = RaportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
