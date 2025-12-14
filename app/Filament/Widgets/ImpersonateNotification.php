<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ImpersonateNotification extends Widget
{
    protected static string $view = 'filament.widgets.impersonate-notification';

    protected int|string|array $columnSpan = 'full';

    // Method ini akan dipanggil otomatis oleh Filament
    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->isImpersonated();
    }
}
