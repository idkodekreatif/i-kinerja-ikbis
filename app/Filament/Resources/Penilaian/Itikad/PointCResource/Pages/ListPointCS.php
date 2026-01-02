<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointCResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointCResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPointCS extends ListRecords
{
    protected static string $resource = PointCResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
