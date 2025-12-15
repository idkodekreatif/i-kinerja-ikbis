<?php

namespace App\Filament\Resources\Setting\Indikator\KomponenPoinResource\Pages;

use App\Filament\Resources\Setting\Indikator\KomponenPoinResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKomponenPoin extends CreateRecord
{
    protected static string $resource = KomponenPoinResource::class;

    // Opsional: Custom redirect setelah create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Opsional: Custom message setelah create
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Komponen poin berhasil ditambahkan';
    }
}
