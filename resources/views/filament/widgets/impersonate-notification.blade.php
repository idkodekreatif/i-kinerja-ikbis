<x-filament-widgets::widget>
    <x-filament::section>
  @if(auth()->check() && auth()->user()->isImpersonated())
    @php
        $info = auth()->user()->getImpersonateInfo();
    @endphp

    <div class="fi-ta rounded-xl bg-yellow-50 dark:bg-gray-900 p-4 mb-4 border border-yellow-200 dark:border-gray-700 shadow-lg">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-semibold text-yellow-900 dark:text-yellow-100">
                        ⚠️ Anda Sedang Login Sebagai <span class="font-bold">{{ $info['target_user_name'] ?? auth()->user()->name }}</span>
                    </div>
                    <div class="mt-1 text-xs text-yellow-700 dark:text-yellow-300">
                        <div class="flex flex-wrap gap-x-4 gap-y-1">
                            <span>👤 Asli: <span class="font-medium">{{ $info['original_user_name'] ?? 'Admin' }}</span></span>
                            <span>⏰ Mulai: <span class="font-medium">{{ isset($info['started_at']) ? \Carbon\Carbon::parse($info['started_at'])->format('d/m/Y H:i:s') : 'Baru saja' }}</span></span>
                            <span>🆔 User ID: <span class="font-medium">{{ auth()->id() }}</span></span>
                        </div>
                        <div class="mt-2 text-yellow-600 dark:text-yellow-400">
                            <strong>Perhatian:</strong> Semua aktivitas akan dicatat atas nama user ini.
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0 ml-4">
                <form method="POST" action="{{ route('impersonate.stop') }}">
                    @csrf
                    @method('POST')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors duration-200">
                        <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                        </svg>
                        Keluar Impersonate
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Auto-refresh halaman setiap 30 detik untuk memastikan widget selalu update --}}
    <script>
        // Auto refresh halaman setiap 30 detik
        setTimeout(function() {
            window.location.reload();
        }, 30000);
    </script>
@endif


    </x-filament::section>
</x-filament-widgets::widget>
