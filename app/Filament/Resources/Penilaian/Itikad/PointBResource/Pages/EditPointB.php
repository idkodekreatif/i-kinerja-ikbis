<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointBResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointBResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPointB extends EditRecord
{
    protected static string $resource = PointBResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
