<?php

namespace App\Filament\Resources\Penilaian\Itikad\PointDResource\Pages;

use App\Filament\Resources\Penilaian\Itikad\PointDResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPointD extends EditRecord
{
    protected static string $resource = PointDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
