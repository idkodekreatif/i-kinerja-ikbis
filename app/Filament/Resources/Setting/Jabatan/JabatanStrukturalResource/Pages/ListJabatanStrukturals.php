<?php

namespace App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJabatanStrukturals extends ListRecords
{
    protected static string $resource = JabatanStrukturalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Jabatan Struktural')
                ->icon('heroicon-o-plus')
                ->modalHeading('Tambah Jabatan Struktural Baru'),
        ];
    }
}
