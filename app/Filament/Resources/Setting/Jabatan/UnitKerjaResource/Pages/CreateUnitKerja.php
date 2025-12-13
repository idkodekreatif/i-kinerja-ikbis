<?php

namespace App\Filament\Resources\Setting\Jabatan\UnitKerjaResource\Pages;

use App\Filament\Resources\Setting\Jabatan\UnitKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUnitKerja extends CreateRecord
{
    protected static string $resource = UnitKerjaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Unit Kerja berhasil ditambahkan!';
    }

    protected function getCreatedNotificationDescription(): ?string
    {
        return 'Data unit kerja ' . $this->record->name . ' telah disimpan ke sistem.';
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan')
                ->icon('heroicon-o-check'),

            $this->getCancelFormAction()
                ->label('Batal')
                ->color('gray'),
        ];
    }
}
