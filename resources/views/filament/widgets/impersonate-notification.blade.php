<x-filament-widgets::widget>
    <x-filament::section>
  @php
    $info = auth()->user()->getImpersonateInfo();
@endphp

<div class="rounded-xl bg-yellow-100 border border-yellow-300 p-4 flex justify-between items-center">
    <div>
        <strong>IMPERSONATING USER</strong><br>
        Login sebagai user ID: {{ $info['target_user_id'] }}
    </div>

    <form method="POST" action="{{ route('impersonate.stop') }}">
        @csrf
        <x-filament::button color="danger" size="sm">
            Keluar Impersonate
        </x-filament::button>
    </form>
</div>


    </x-filament::section>
</x-filament-widgets::widget>
