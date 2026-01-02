<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointBResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointBResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPointBS extends ListRecords
{
    protected static string $resource = PointBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
