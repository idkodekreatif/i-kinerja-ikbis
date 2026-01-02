@php
    $id = $getId();
    $statePath = $getStatePath();
    $items = $getItems();
    $descriptions = $getDescriptions();
    $title = $getTitle();
    $totalScoreField = $getTotalScoreField();
    $percentageField = $getPercentageField();
@endphp

<div x-data="assessmentTable()"
     x-init="init(@js($items), '{{ $statePath }}', '{{ $totalScoreField }}', '{{ $percentageField }}')"
     wire:ignore
     {{ $attributes->merge($getExtraAttributes())->class(['fi-fo-assessment-table']) }}>

    <div class="overflow-x-auto border border-gray-200 rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th rowspan="2" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-gray-200 w-12">No</th>
                    <th rowspan="2" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-left border border-gray-200">Komponen Kompetensi</th>
                    <th colspan="5" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-gray-200">Skor</th>
                    <th rowspan="2" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-left border border-gray-200">Bukti Pendukung</th>
                    <th rowspan="2" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-gray-200 bg-yellow-100">Skor</th>
                    <th rowspan="2" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-gray-200">Skor/Skor maks</th>
                    <th rowspan="2" class="px-4 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-gray-200">Skor x Bobot Sub Item</th>
                </tr>
                <tr>
                    @for ($i = 1; $i <= 5; $i++)
                        <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase tracking-wider text-center border border-gray-200 w-16">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                {{-- Judul Section --}}
                <tr class="bg-gray-50">
                    <td colspan="11" class="px-4 py-2 font-bold text-gray-700 border border-gray-200">
                        {{ $title }}
                    </td>
                </tr>

                {{-- Deskripsi Penilaian --}}
                <tr>
                    <td colspan="2" class="px-4 py-3 text-sm font-medium text-gray-900 border border-gray-200 align-top">Deskripsi penilaian:</td>
                    @foreach ($descriptions as $score => $description)
                        <td class="px-4 py-3 text-xs text-gray-700 border border-gray-200 align-top" style="min-width: 150px;">{{ $description }}</td>
                    @endforeach
                    <td rowspan="2" class="px-4 py-3 border border-gray-200 align-top" style="min-width: 200px;">
                        <div class="space-y-2">
                            @foreach ($items as $index => $item)
                                @if ($item['has_file'])
                                    <div class="mb-4 last:mb-0">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            {{ $item['file_label'] ?? 'Upload File' }}
                                            @if ($item['file_required'] ?? false)
                                                <span class="text-red-500">*</span>
                                            @endif
                                        </label>
                                        <input type="file"
                                               name="{{ $statePath }}[{{ $index }}][file]"
                                               x-model="items[{{ $index }}].file"
                                               @change="updateFile({{ $index }}, $event)"
                                               class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                               {{ $item['file_required'] ?? false ? 'required' : '' }}>
                                        <p class="text-xs text-gray-500 mt-1">{{ $item['file_helper'] ?? '' }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </td>
                    <td rowspan="2" class="px-4 py-3 bg-yellow-50 border border-gray-200 align-top">
                        <div class="space-y-4">
                            @foreach ($items as $index => $item)
                                <input type="number"
                                       x-model="items[{{ $index }}].score"
                                       readonly
                                       class="block w-full text-center bg-transparent border-none focus:ring-0 text-gray-900">
                            @endforeach
                        </div>
                    </td>
                    <td rowspan="2" class="px-4 py-3 border border-gray-200 align-top">
                        <div class="space-y-4">
                            @foreach ($items as $index => $item)
                                <input type="text"
                                       x-model="items[{{ $index }}].score_over_max"
                                       readonly
                                       class="block w-full text-center bg-transparent border-none focus:ring-0 text-gray-900">
                            @endforeach
                        </div>
                    </td>
                    <td rowspan="2" class="px-4 py-3 border border-gray-200 align-top">
                        <div class="space-y-4">
                            @foreach ($items as $index => $item)
                                <input type="number"
                                       x-model="items[{{ $index }}].weighted_score"
                                       readonly
                                       class="block w-full text-center bg-transparent border-none focus:ring-0 text-gray-900">
                            @endforeach
                        </div>
                    </td>
                </tr>

                {{-- Baris Input --}}
                @foreach ($items as $index => $item)
                    <tr>
                        <td class="px-4 py-3 text-sm font-medium text-gray-900 border border-gray-200">
                            {{ $item['code'] }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700 border border-gray-200">
                            {{ $item['description'] }}
                        </td>

                        {{-- Radio buttons untuk skor 1-5 --}}
                        @for ($i = 1; $i <= 5; $i++)
                            <td class="px-4 py-3 border border-gray-200 text-center">
                                <input type="radio"
                                       name="{{ $statePath }}[{{ $index }}][score_radio]"
                                       value="{{ $i }}"
                                       x-model="items[{{ $index }}].score"
                                       @change="updateScore({{ $index }}, {{ $i }})"
                                       class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300">
                            </td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Hidden inputs untuk menyimpan data --}}
    <template x-for="(item, index) in items" :key="index">
        <div>
            <input type="hidden" :name="statePath + '[' + index + '][code]'" :value="item.code">
            <input type="hidden" :name="statePath + '[' + index + '][description]'" :value="item.description">
            <input type="hidden" :name="statePath + '[' + index + '][score]'" :value="item.score">
            <input type="hidden" :name="statePath + '[' + index + '][max_score]'" :value="item.max_score">
            <input type="hidden" :name="statePath + '[' + index + '][weighted_score]'" :value="item.weighted_score">
            <input type="hidden" :name="statePath + '[' + index + '][score_over_max]'" :value="item.score_over_max">
            <input type="hidden" :name="statePath + '[' + index + '][file_name]'" :value="item.file_name">
        </div>
    </template>

    <script>
        function assessmentTable() {
            return {
                items: [],
                statePath: '',
                totalScoreField: '',
                percentageField: '',

                init(initialItems, path, totalField, percentageField) {
                    this.items = initialItems;
                    this.statePath = path;
                    this.totalScoreField = totalField;
                    this.percentageField = percentageField;

                    // Inisialisasi nilai default
                    this.items.forEach((item, index) => {
                        if (!item.score) item.score = 0;
                        if (!item.max_score) item.max_score = 5;
                        if (!item.weight) item.weight = 1.0;
                        if (!item.weighted_score) item.weighted_score = 0;
                        if (!item.score_over_max) item.score_over_max = '0/5';
                        this.calculateItem(index);
                    });

                    this.calculateTotal();
                },

                updateScore(index, score) {
                    this.items[index].score = score;
                    this.calculateItem(index);
                    this.calculateTotal();
                    this.updateFormData();
                },

                updateFile(index, event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.items[index].file_name = file.name;
                    }
                    this.updateFormData();
                },

                calculateItem(index) {
                    const item = this.items[index];
                    const weight = parseFloat(item.weight) || 1.0;
                    const maxScore = parseInt(item.max_score) || 5;

                    item.weighted_score = (item.score * weight).toFixed(2);
                    item.score_over_max = item.score + '/' + maxScore;
                },

                calculateTotal() {
                    let total = 0;
                    this.items.forEach(item => {
                        total += parseFloat(item.weighted_score) || 0;
                    });

                    const percentage = (total / 5) * 100;

                    // Dispatch event untuk update form
                    this.$dispatch('assessment-table-updated', {
                        total: total,
                        percentage: percentage
                    });
                },

                updateFormData() {
                    // Update form data menggunakan Filament API
                    const data = {};
                    data[this.statePath] = this.items;

                    // Gunakan dispatch untuk update Livewire
                    this.$dispatch('assessment-table::updateScore', {
                        items: this.items,
                        total: this.calculateSum(),
                        percentage: (this.calculateSum() / 5) * 100
                    });
                },

                calculateSum() {
                    let sum = 0;
                    this.items.forEach(item => {
                        sum += parseFloat(item.weighted_score) || 0;
                    });
                    return sum;
                }
            }
        }

        // Event listener untuk update form
        document.addEventListener('assessment-table-updated', function(event) {
            // Event ini akan ditangkap oleh Livewire component
            Livewire.dispatch('assessmentTableUpdated', {
                total: event.detail.total,
                percentage: event.detail.percentage
            });
        });
    </script>
</div>
