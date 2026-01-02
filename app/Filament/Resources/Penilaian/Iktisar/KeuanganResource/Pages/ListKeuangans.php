<?php

namespace App\Filament\Resources\Penilaian\Iktisar\KeuanganResource\Pages;

use App\Filament\Resources\Penilaian\Iktisar\KeuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKeuangans extends ListRecords
{
    protected static string $resource = KeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
