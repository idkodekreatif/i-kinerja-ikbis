<?php

namespace App\Filament\Resources\Setting\Periode\PeriodResource\Widgets;

use App\Models\Setting\Period;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PeriodStatsWidget extends BaseWidget
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
        $pastPeriods = Period::where('end_date', '<', now())->count();

        return [
            Stat::make('Total Periode', $totalPeriods)
                ->description('Semua periode yang tersedia')
                ->icon('heroicon-o-calendar')
                ->color('primary')
                ->extraAttributes(['class' => 'text-primary-600']),

            Stat::make('Periode Aktif', $activePeriods)
                ->description('Periode yang dapat digunakan')
                ->icon('heroicon-o-check-circle')
                ->color($activePeriods > 0 ? 'success' : 'gray')
                ->descriptionIcon($activePeriods > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-minus')
                ->extraAttributes(['class' => 'text-success-600']),

            Stat::make('Sedang Berjalan', $currentPeriods)
                ->description('Periode aktif saat ini')
                ->icon('heroicon-o-play-circle')
                ->color($currentPeriods > 0 ? 'warning' : 'gray')
                ->descriptionIcon($currentPeriods > 0 ? 'heroicon-m-play' : 'heroicon-m-pause')
                ->extraAttributes(['class' => 'text-warning-600']),

            Stat::make('Akan Datang', $upcomingPeriods)
                ->description('Periode yang belum dimulai')
                ->icon('heroicon-o-clock')
                ->color('info')
                ->extraAttributes(['class' => 'text-info-600']),

            Stat::make('Sudah Lewat', $pastPeriods)
                ->description('Periode yang sudah selesai')
                ->icon('heroicon-o-calendar-days')
                ->color('gray')
                ->extraAttributes(['class' => 'text-gray-600']),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
