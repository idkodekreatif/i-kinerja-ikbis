<x-filament-widgets::widget>
    @php
         $user = \Filament\Facades\Filament::auth()->user();
    @endphp

    @if($user && $user->isImpersonated())
        @php
            $info = $user->getImpersonateInfo();
            $originalUser = $info['original_user_name'] ?? 'Admin';
            $targetUser   = $info['target_user_name'] ?? $user->name;
        @endphp

        <x-filament::section>
            <div class="flex items-center justify-between rounded-xl border border-yellow-300 bg-yellow-50 p-4">

                <div>
                    <p class="text-sm font-semibold text-yellow-800">
                        IMPERSONATE MODE
                    </p>
                    <p class="text-sm text-yellow-900">
                        Login sebagai <strong>{{ $targetUser }}</strong>
                        <span class="text-xs">(Asli: {{ $originalUser }})</span>
                    </p>
                </div>

                {{-- INI YANG BENAR --}}
                <x-filament::button
                    color="danger"
                    icon="heroicon-o-arrow-left-on-rectangle"
                    wire:click="stopImpersonate"
                    wire:confirm="Keluar dari mode impersonate?"
                >
                    Exit Impersonate
                </x-filament::button>

            </div>
        </x-filament::section>
    @endif
</x-filament-widgets::widget>
