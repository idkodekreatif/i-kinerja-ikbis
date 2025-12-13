<?php

namespace App\Filament\Settings\Jabatan\UnitKerjaResource\Pages;

use App\Filament\Resources\Setting\Jabatan\UnitKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUnitKerja extends ViewRecord
{
    protected static string $resource = UnitKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit')
                ->icon('heroicon-o-pencil'),
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->color('danger')
                ->icon('heroicon-o-trash'),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // Widget detail bisa ditambahkan di sini
        ];
    }
}
