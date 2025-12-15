<?php

namespace App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJabatanFungsional extends CreateRecord
{
    protected static string $resource = JabatanFungsionalResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Jabatan Fungsional berhasil ditambahkan!';
    }

    protected function getCreatedNotificationDescription(): ?string
    {
        return 'Data jabatan ' . $this->record->name . ' telah disimpan ke sistem.';
    }
}
