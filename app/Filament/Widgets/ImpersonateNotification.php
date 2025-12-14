<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Facades\Filament;


class ImpersonateNotification extends Widget
{
    protected static string $view = 'filament.widgets.impersonate-notification';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = -100; // Pastikan selalu di atas

    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->isImpersonated();
    }

    public function stopImpersonate()
    {
        Filament::auth()->user()->stopImpersonating(); // kalau pakai package spatie/laravel-impersonate
        session()->flash('success', 'Berhasil keluar dari impersonate mode.');

        // redirect atau refresh
        return redirect()->route('filament.kpi-control-center.pages.dashboard');
    }
}
