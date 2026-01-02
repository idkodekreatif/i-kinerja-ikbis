<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointDResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointDResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPointDS extends ListRecords
{
    protected static string $resource = PointDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
