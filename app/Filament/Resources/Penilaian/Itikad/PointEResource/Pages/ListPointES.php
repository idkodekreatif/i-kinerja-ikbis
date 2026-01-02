<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointEResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointEResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPointES extends ListRecords
{
    protected static string $resource = PointEResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
