<?php

namespace App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource\Pages;

use App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJabatanFungsionals extends ListRecords
{
    protected static string $resource = JabatanFungsionalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Jabatan Fungsional')
                ->icon('heroicon-o-plus')
                ->modalHeading('Tambah Jabatan Fungsional Baru'),
        ];
    }
}
