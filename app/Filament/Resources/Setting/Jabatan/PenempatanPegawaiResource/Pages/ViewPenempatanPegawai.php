<?php

namespace App\Filament\Settings\Jabatan\PenempatanPegawaiResource\Pages;

use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPenempatanPegawai extends ViewRecord
{
    protected static string $resource = PenempatanPegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit Penempatan')
                ->icon('heroicon-o-pencil'),
            Actions\DeleteAction::make()
                ->label('Hapus')
                ->color('danger')
                ->icon('heroicon-o-trash'),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // Widget untuk detail jabatan
        ];
    }
}
