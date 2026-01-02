<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointAResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointAResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPointAS extends ListRecords
{
    protected static string $resource = PointAResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
