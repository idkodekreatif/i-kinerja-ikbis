<?php

namespace App\Filament\Settings\Jabatan\JabatanStrukturalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJabatanStruktural extends ViewRecord
{
    protected static string $resource = JabatanStrukturalResource::class;

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
}
