<?php

namespace App\Filament\Settings\Jabatan\UnitKerjaResource\Widgets;

use App\Models\Setting\Jabatan\UnitKerja;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UnitKerjaStats extends BaseWidget
{
    protected static ?string $pollingInterval = null; // Nonaktifkan polling

    protected function getStats(): array
    {
        $total = UnitKerja::count();
        $akademik = UnitKerja::where('type', 'Akademik')->count();
        $nonAkademik = UnitKerja::where('type', 'Non-akademik')->count();
        $tanpaTipe = UnitKerja::whereNull('type')->count();

        return [
            Stat::make('Total Unit Kerja', $total)
                ->description('Seluruh data unit kerja')
                ->descriptionIcon('heroicon-o-building-office')
                ->color('primary')
                ->chart($this->getChartData($total)),

            Stat::make('Unit Akademik', $akademik)
                ->description('Fakultas/Program Studi')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('success')
                ->chart($this->getChartData($akademik)),

            Stat::make('Unit Non-Akademik', $nonAkademik)
                ->description('Administrasi/Support')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('warning')
                ->chart($this->getChartData($nonAkademik)),

            Stat::make('Tanpa Tipe', $tanpaTipe)
                ->description('Belum dikategorikan')
                ->descriptionIcon('heroicon-o-question-mark-circle')
                ->color('gray')
                ->chart($this->getChartData($tanpaTipe)),
        ];
    }

    protected function getChartData($value): array
    {
        // Data dummy untuk chart
        return [$value > 0 ? $value : 1];
    }

    // Nonaktifkan polling interval
    public static function canView(): bool
    {
        return true;
    }
}
