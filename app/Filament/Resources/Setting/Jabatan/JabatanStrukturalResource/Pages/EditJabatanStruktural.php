<?php

namespace App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJabatanStruktural extends EditRecord
{
    protected static string $resource = JabatanStrukturalResource::class;

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
        return 'Jabatan Struktural berhasil diperbarui!';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
