<?php

namespace App\Filament\Resources\PeriodResource\Widgets;

use App\Models\Setting\Period;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PeriodStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPeriods = Period::count();
        $activePeriods = Period::where('is_closed', false)->count();
        $currentPeriods = Period::where('is_closed', false)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->count();

        $upcomingPeriods = Period::where('start_date', '>', now())->count();

        return [
            Stat::make('Total Periode', $totalPeriods)
                ->description('Semua periode yang tersedia')
                ->icon('heroicon-o-calendar')
                ->color('primary'),

            Stat::make('Periode Aktif', $activePeriods)
                ->description('Periode yang dapat digunakan')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),

            Stat::make('Sedang Berjalan', $currentPeriods)
                ->description('Periode aktif saat ini')
                ->icon('heroicon-o-play-circle')
                ->color($currentPeriods > 0 ? 'warning' : 'gray'),

            Stat::make('Akan Datang', $upcomingPeriods)
                ->description('Periode yang belum dimulai')
                ->icon('heroicon-o-clock')
                ->color('info'),
        ];
    }
}
