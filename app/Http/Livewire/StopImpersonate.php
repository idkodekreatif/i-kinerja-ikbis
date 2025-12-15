<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StopImpersonate extends Component
{
    public function stopImpersonating()
    {
        $user = auth()->user();

        if ($user && method_exists($user, 'stopImpersonating')) {
            $user->stopImpersonating();
        }

        return redirect()->route('filament.kpi-control-center.pages.dashboard');
    }

    public function render()
    {
        return view('livewire.stop-impersonate');
    }
}
