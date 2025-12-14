<?php

namespace App\Filament\Resources\Setting\UserManajemen\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();
        $trashedUsers = User::onlyTrashed()->count();

        return [
            Stat::make('Total User', $totalUsers)
                ->description('Jumlah semua user')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('primary'),

            Stat::make('User Aktif', $activeUsers)
                ->description($this->getPercentage($activeUsers, $totalUsers) . '% dari total')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('User Nonaktif', $inactiveUsers)
                ->description($this->getPercentage($inactiveUsers, $totalUsers) . '% dari total')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('User Terhapus', $trashedUsers)
                ->description($this->getPercentage($trashedUsers, $totalUsers) . '% dari total')
                ->descriptionIcon('heroicon-o-trash')
                ->color('warning')
                ->url($this->getTrashedUsersUrl()),
        ];
    }

    private function getPercentage($value, $total): float
    {
        if ($total === 0) {
            return 0;
        }

        return round(($value / $total) * 100, 1);
    }

    private function getTrashedUsersUrl(): string
    {
        // Generate URL manual untuk tab "User Terhapus"
        $resource = '\App\Filament\Resources\Setting\UserManajemen\UserResource';

        if (class_exists($resource) && method_exists($resource, 'getUrl')) {
            return $resource::getUrl('index', [
                'activeTab' => 'trashed', // Parameter untuk tab
            ]);
        }

        return '#';
    }
}
