<?php

namespace App\Filament\Settings\Jabatan\JabatanFungsionalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJabatanFungsional extends ViewRecord
{
    protected static string $resource = JabatanFungsionalResource::class;

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
