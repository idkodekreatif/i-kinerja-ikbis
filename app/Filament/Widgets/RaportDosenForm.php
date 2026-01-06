<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\Penilaian\RaportDosen;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Actions\Action;
use Filament\Widgets\Widget;

class RaportDosenForm extends Widget
{
    protected static string $view = 'filament.widgets.raport-dosen-form';

    protected int|string|array $columnSpan = 'full';

    public function getViewData(): array
    {
        $page = app(RaportDosen::class);
        return [
            'periods' => $page->periods,
            'period_id' => $page->period_id,
            'user_id' => $page->user_id,
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData());
    }
}
