<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Livewire\Attributes\On;

class ImpersonateNotification extends Widget
{
    protected static string $view = 'filament.widgets.impersonate-notification';

    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->isImpersonated();
    }
}
