<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\ImpersonateNotification;

class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            ImpersonateNotification::class,
        ];
    }


    // Optional: Tambahkan ini untuk custom heading saat impersonate
    public function getHeading(): string
    {
        if (auth()->check() && auth()->user()->isImpersonated()) {
            $info = auth()->user()->getImpersonateInfo();
            return 'Dashboard (Impersonate: ' . ($info['target_user_name'] ?? 'User') . ')';
        }

        return parent::getHeading();
    }
}
