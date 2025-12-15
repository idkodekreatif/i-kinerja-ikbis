<?php

namespace App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\Pages;

use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenempatanPegawais extends ListRecords
{
    protected static string $resource = PenempatanPegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Penempatan')
                ->icon('heroicon-o-user-plus'),
        ];
    }
}
