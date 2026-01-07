<?php

namespace App\Filament\Resources\Penilaian\Iktisar\SdmResource\Pages;

use App\Filament\Resources\Penilaian\Iktisar\SdmResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSdms extends ListRecords
{
    protected static string $resource = SdmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
