<x-filament-panels::page>
    {{-- Form Pilih Periode --}}
    <x-filament::section>
        <form wire:submit.prevent="loadRaportData">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                <div class="md:col-span-10">
                    {{ $this->form }}
                </div>
                <div class="md:col-span-2">
                    <x-filament::button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full"
                        :loading="$isLoading">
                        <span wire:loading.remove>Lihat Raport</span>
                        <span wire:loading>Memuat...</span>
                    </x-filament::button>
                </div>
            </div>
        </form>
    </x-filament::section>

    {{-- Tabel Raport --}}
    @if(!empty($resultArray))
        <x-filament::section>
            <div class="space-y-6">
                {{-- Tabel Ringkasan --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Jabatan Fungsional
                                </th>
                                <td class="px-6 py-4">
                                    {{ $jabfungName }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Nilai Total UNSUR UTAMA
                                </th>
                                <td class="px-6 py-4">
                                    {{ $resultArray['total_Ntu'] }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Nilai Total Unsur Non-Tri Dharma
                                </th>
                                <td class="px-6 py-4">
                                    {{ $resultArray['total_Ntd'] }}
                                </td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Nilai Kinerja Dosen
                                </th>
                                <td class="px-6 py-4">
                                    {{ $resultArray['total_Nkd'] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Tabel Detail --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Poin Penilaian</th>
                                <th scope="col" class="px-6 py-3">Komponen</th>
                                <th scope="col" class="px-6 py-3">Nilai Total</th>
                                <th scope="col" class="px-6 py-3">Standar</th>
                                <th scope="col" class="px-6 py-3">Persentase Capaian</th>
                                <th scope="col" class="px-6 py-3">Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">A.</td>
                                <td class="px-6 py-4">PENDIDIKAN DAN PENGAJARAN</td>
                                <td class="px-6 py-4">{{ $resultArray['a'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['standar_a'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['NtAFinalSum'] }}%</td>
                                <td class="px-6 py-4">{{ $resultArray['outputHasilPDP'] }}</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">B.</td>
                                <td class="px-6 py-4">PENELITIAN DAN KARYA ILMIAH</td>
                                <td class="px-6 py-4">{{ $resultArray['b'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['standar_b'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['NTiFinalSum'] }}%</td>
                                <td class="px-6 py-4">{{ $resultArray['OutputHasilPki'] }}</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">C.</td>
                                <td class="px-6 py-4">PENGABDIAN KEPADA MASYARAKAT</td>
                                <td class="px-6 py-4">{{ $resultArray['c'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['standar_c'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['NTiFinalSumPkm'] }}%</td>
                                <td class="px-6 py-4">{{ $resultArray['OutputHasilPkm'] }}</td>
                            </tr>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">D dan E</td>
                                <td class="px-6 py-4">UNSUR PENUNJANG, PENGABDIAN INSTITUSI, DAN PENGEMBANGAN DIRI</td>
                                <td class="px-6 py-4">{{ $resultArray['total_Ntd'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['standar_d'] }}</td>
                                <td class="px-6 py-4">{{ $resultArray['SUMUnsurPenungjang'] }}%</td>
                                <td class="px-6 py-4">{{ $resultArray['OutputHasilUnsurPenunjang'] }}</td>
                            </tr>
                            <tr class="font-bold bg-gray-50 dark:bg-gray-700">
                                <td class="px-6 py-4" colspan="2">NILAI KINERJA TOTAL</td>
                                <td class="px-6 py-4" colspan="4">{{ $resultArray['SumNkt'] }}</td>
                            </tr>
                            <tr class="font-bold bg-gray-50 dark:bg-gray-700">
                                <td class="px-6 py-4" colspan="2">STANDAR KINERJA TOTAL</td>
                                <td class="px-6 py-4" colspan="4">{{ $resultArray['sum_Skt'] }}</td>
                            </tr>
                            <tr class="font-bold bg-gray-50 dark:bg-gray-700">
                                <td class="px-6 py-4" colspan="2">PREDIKAT</td>
                                <td class="px-6 py-4" colspan="4">{{ $resultArray['predikat'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </x-filament::section>
    @else
        <x-filament::section>
            <div class="text-center py-12">
                <x-heroicon-o-document-text class="mx-auto h-12 w-12 text-gray-400" />
                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                    Belum ada data raport
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Pilih periode dan klik "Lihat Raport" untuk melihat data.
                </p>
            </div>
        </x-filament::section>
    @endif
</x-filament-panels::page>
