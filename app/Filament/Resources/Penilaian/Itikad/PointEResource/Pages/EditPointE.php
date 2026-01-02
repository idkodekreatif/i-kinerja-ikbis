<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointEResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointEResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPointE extends EditRecord
{
    protected static string $resource = PointEResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
