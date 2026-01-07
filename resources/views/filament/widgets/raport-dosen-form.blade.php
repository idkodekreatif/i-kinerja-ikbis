<div>
    <form wire:submit.prevent="$parent.loadRaportData" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="period_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    Pilih Periode:
                </label>
                <select wire:model.live="$parent.period_id" id="period_id"
                    class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @foreach($periods as $period)
                        <option value="{{ $period->id }}">{{ $period->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="w-full px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    Lihat Raport
                </button>
            </div>
            @if(!empty($this->parent->resultArray))
                <div class="flex items-end">
                    <a href="{{ $this->parent->getPdfDownloadUrl() }}"
                       target="_blank"
                       class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 text-center">
                        Cetak PDF
                    </a>
                </div>
            @endif
        </div>
    </form>
</div>
