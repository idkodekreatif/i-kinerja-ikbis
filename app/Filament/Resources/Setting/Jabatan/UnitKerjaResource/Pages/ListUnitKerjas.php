<?php

namespace App\Filament\Resources\Setting\Jabatan\UnitKerjaResource\Pages;

use App\Filament\Resources\Setting\Jabatan\UnitKerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Settings\Jabatan\UnitKerjaResource\Widgets\UnitKerjaStats;

class ListUnitKerjas extends ListRecords
{
    protected static string $resource = UnitKerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Unit Kerja')
                ->icon('heroicon-o-plus')
                ->modalHeading('Tambah Unit Kerja Baru'),
        ];
    }

    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         UnitKerjaStats::class,
    //     ];
    // }
}
