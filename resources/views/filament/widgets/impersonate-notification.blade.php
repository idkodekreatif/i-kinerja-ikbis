<x-filament-widgets::widget>
    <x-filament::section>
        @if($this->shouldShow())
<div class="bg-yellow-100 border border-yellow-300 p-4 rounded-xl">
    <strong>IMPERSONATING USER</strong>
    <form method="POST" action="{{ route('impersonate.stop') }}">
        @csrf
        <button class="ml-4 text-red-600 font-bold">
            Kembali ke Admin
        </button>
    </form>
</div>
@endif

    </x-filament::section>
</x-filament-widgets::widget>
