<?php

namespace App\Filament\Resources\Setting\Periode\PeriodResource\Pages;

use App\Filament\Resources\Setting\Periode\PeriodResource;
use App\Filament\Resources\Setting\Periode\PeriodResource\Widgets\PeriodStatsWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPeriods extends ListRecords
{
    protected static string $resource = PeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Periode')
                ->icon('heroicon-o-plus-circle'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PeriodStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            // Widget tambahan jika diperlukan
        ];
    }
}
