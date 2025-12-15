<?php

namespace App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJabatanFungsional extends EditRecord
{
    protected static string $resource = JabatanFungsionalResource::class;

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
        return 'Jabatan Fungsional berhasil diperbarui!';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
