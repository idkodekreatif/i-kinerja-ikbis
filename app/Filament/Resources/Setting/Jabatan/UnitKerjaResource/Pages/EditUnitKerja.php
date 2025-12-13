<?php

namespace App\Filament\Resources\Setting\Jabatan\UnitKerjaResource\Pages;

use App\Filament\Resources\Setting\Jabatan\UnitKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnitKerja extends EditRecord
{
    protected static string $resource = UnitKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->color('gray'),
            Actions\DeleteAction::make()
                ->color('danger'),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Unit Kerja berhasil diperbarui!';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
