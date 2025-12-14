<?php

namespace App\Filament\Resources\Setting\Indikator\KomponenPoinResource\Pages;

use App\Filament\Resources\Setting\Indikator\KomponenPoinResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKomponenPoins extends ListRecords
{
    protected static string $resource = KomponenPoinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Komponen Baru')
                ->icon('heroicon-o-plus'),

            // Opsional: Tombol import jika butuh upload data
            // Actions\ImportAction::make()
            //     ->label('Import Data')
            //     ->icon('heroicon-o-arrow-up-tray'),
        ];
    }

    // Opsional: Tambah view table yang lebih informatif
    protected function getTableContentGrid(): ?array
    {
        return [
            'md' => 2,
            'xl' => 3,
        ];
    }
}
