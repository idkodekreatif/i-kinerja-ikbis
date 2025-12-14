<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ImpersonateNotification extends Widget
{
    protected static string $view = 'filament.widgets.impersonate-notification';

    protected int|string|array $columnSpan = 'full';

    public function shouldShow(): bool
    {
        return auth()->check() && auth()->user()->isImpersonated();
    }
}
