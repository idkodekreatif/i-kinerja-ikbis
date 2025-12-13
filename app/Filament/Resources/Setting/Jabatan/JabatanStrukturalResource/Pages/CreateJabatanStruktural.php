<?php

namespace App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJabatanStruktural extends CreateRecord
{
    protected static string $resource = JabatanStrukturalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Jabatan Struktural berhasil ditambahkan!';
    }

    protected function getCreatedNotificationDescription(): ?string
    {
        return 'Data jabatan ' . $this->record->name . ' telah disimpan ke sistem.';
    }
}
