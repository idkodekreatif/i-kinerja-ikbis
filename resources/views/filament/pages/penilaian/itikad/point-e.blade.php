<x-filament-panels::page>
    @livewireStyles
    @push('styles')
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type=number] {
                -moz-appearance: textfield;
            }

            .point-e-table {
                font-size: 0.875rem;
                width: 100%;
                border-collapse: collapse;
                table-layout: auto;
                min-width: 1300px;
            }

            .point-e-table th,
            .point-e-table td {
                vertical-align: middle;
                padding: 0.75rem 0.5rem;
                border: 1px solid #e5e7eb;
                word-wrap: break-word;
            }

            .col-no { width: 40px; }
            .col-komponen { width: 250px; }
            .col-skor-radio { width: 45px; }
            .col-bukti { width: 300px; min-width: 300px; }
            .col-skor-kuning { width: 90px; min-width: 90px; }
            .col-skor-maks { width: 100px; min-width: 100px; }
            .col-skor-bobot { width: 120px; min-width: 120px; }

            .point-e-table .bg-warning {
                background-color: #fef3c7 !important;
            }

            .point-e-table input[type="radio"] {
                margin: 0 auto;
                display: block;
            }

            .point-e-table input[readonly] {
                background-color: #f3f4f6;
                font-weight: bold;
                width: 100%;
                text-align: center;
                border: none;
                padding: 0.5rem 0;
            }

            .point-e-table input[type="number"]:not([readonly]) {
                width: 100%;
                text-align: center;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                padding: 0.4rem;
            }

            .form-label.text-danger {
                color: #dc2626;
                font-weight: 600;
                font-size: 0.8rem;
                margin-bottom: 0.5rem;
                display: block;
                line-height: 1.2;
            }

            .file-upload-container {
                margin-top: 0.5rem;
            }

            .file-upload-container input[type="file"] {
                background: #fff;
                padding: 0.25rem;
                border: 1px solid #d1d5db;
                border-radius: 4px;
                width: 100%;
            }
        </style>
    @endpush

    <div class="space-y-6">
        @if($hasActivePeriod)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            Form Point E - Pengabdian Kepada Institusi & Pengembangan Diri
                        </h2>
                        @php
                            $activePeriod = \App\Models\Setting\Period::active()->first();
                        @endphp
                        @if($activePeriod)
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-md text-sm">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Periode: {{ $activePeriod->name }}
                                ({{ \Carbon\Carbon::parse($activePeriod->start_date)->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($activePeriod->end_date)->format('d/m/Y') }})
                            </div>
                        @else
                            <div class="bg-red-100 text-red-800 px-3 py-1 rounded-md text-sm">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Tidak ada periode aktif!
                            </div>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <form id="pointEForm" wire:submit.prevent="save" enctype="multipart/form-data">
                        <!-- Hidden inputs untuk data yang akan diisi JavaScript -->
                        <input type="hidden" wire:model="data.user_id" id="user_id" value="{{ auth()->id() }}">

                        <!-- Hidden inputs untuk E1_1 sampai E2_4 -->
                        @php
                            $eItems = [
                                'E1_1', 'E1_2', 'E1_3', 'E1_4', 'E1_5', 'E1_6',
                                'E2_1', 'E2_2', 'E2_3', 'E2_4'
                            ];
                        @endphp

                        @foreach($eItems as $item)
                            <input type="hidden" wire:model="data.{{ $item }}" id="{{ $item }}">
                        @endforeach

                        <!-- Hidden inputs untuk file uploads -->
                        @foreach($eItems as $item)
                            <input type="hidden" wire:model="data.file{{ $item }}" id="file{{ $item }}_hidden">
                        @endforeach

                        <!-- Hidden inputs untuk hasil akhir -->
                        <input type="hidden" wire:model="data.SumSkor" id="hidden_SumSkor">
                        <input type="hidden" wire:model="data.NilaiUnsurPengabdian" id="hidden_NilaiUnsurPengabdian">

                        <div class="overflow-x-auto mb-6">
                            <table class="point-e-table">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <td rowspan="2">No</td>
                                        <td rowspan="2">Komponen Kompetensi</td>
                                        <td colspan="5" class="text-center">Skor</td>
                                        <td rowspan="2">Bukti Pendukung</td>
                                        <td rowspan="2" class="bg-warning">Skor</td>
                                        <td rowspan="2">Skor/Skor maks</td>
                                        <td rowspan="2">Skor x Bobot Sub Item</td>
                                    </tr>
                                    <tr class="bg-gray-100 dark:bg-gray-700 text-center">
                                        <td>1</td>
                                        <td>2</td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- E.1 - PENGABDIAN KEPADA INSTITUSI -->
                                    <tr>
                                        <td>E.1</td>
                                        <td colspan="10" class="text-left font-bold">PENGABDIAN KEPADA INSTITUSI</td>
                                    </tr>

                                    <!-- E.1.1 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Dosen tidak pernah menjadi Pejabat Struktural Non Akademik</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Dosen pernah menjadi Pejabat Struktural Non Akademik dalam periode organisasi yang lalu</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Dosen sedang menjabat sebagai Pejabat Struktural non Akademik</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Rektor</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE1_1"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE1_1')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE1_1'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE1_1']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE1_1'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE1_1']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE1_1" id="scorE1_1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE1_1" id="scorMaxE1_1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE1_1" id="scorSubItemE1_1" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.1.1</td>
                                        <td class="text-left">Dosen menjadi Pejabat Struktural Non Akademik</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E1_1" id="E1_1_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E1_1 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.1.2 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Dosen menginisiasi 1 MoU dalam 1 tahun penilaian</td>
                                        <td class="text-xs">Dosen menginisiasi >1 MoU dalam 1 tahun penilaian</td>
                                        <td class="text-xs">Dosen menginisiasi 1 MoA dalam 1 tahun penilaian</td>
                                        <td class="text-xs">Dosen menginisiasi >1 MoA dalam 1 tahun penilaian</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload MoU yang dihasilkan</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE1_2"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE1_2')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE1_2'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE1_2']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE1_2'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE1_2']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE1_2" id="scorE1_2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE1_2" id="scorMaxE1_2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE1_2" id="scorSubItemE1_2" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.1.2</td>
                                        <td class="text-left">Dosen menginisiasi kerjasama dengan lembaga lain dan berkaitan dengan kegiatan akademik (MoU dan atau MoA)</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E1_2" id="E1_2_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E1_2 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.1.3 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">1 kali terlibat dalam Satgas</td>
                                        <td class="text-xs">2 kali terlibat dalam Satgas</td>
                                        <td class="text-xs">>2 kali terlibat dalam Satgas</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Rektor</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE1_3"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE1_3')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE1_3'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE1_3']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE1_3'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE1_3']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE1_3" id="scorE1_3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE1_3" id="scorMaxE1_3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE1_3" id="scorSubItemE1_3" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.1.3</td>
                                        <td class="text-left">Dosen bergabung dalam satuan tugas marketing di tingkat Program Studi maupun Institusi</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E1_3" id="E1_3_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E1_3 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.1.4 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">1 kali terlibat dalam Satgas</td>
                                        <td class="text-xs">2 kali terlibat dalam Satgas</td>
                                        <td class="text-xs">>2 kali terlibat dalam Satgas</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Rektor</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE1_4"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE1_4')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE1_4'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE1_4']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE1_4'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE1_4']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE1_4" id="scorE1_4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE1_4" id="scorMaxE1_4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE1_4" id="scorSubItemE1_4" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.1.4</td>
                                        <td class="text-left">Dosen bergabung dalam satuan tugas non-marketing di tingkat Program Studi maupun Institusi</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E1_4" id="E1_4_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E1_4 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.1.5 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">1 kali terlibat dalam Satgas</td>
                                        <td class="text-xs">2 kali terlibat dalam Satgas</td>
                                        <td class="text-xs">>2 kali terlibat dalam Satgas</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Rektor</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE1_5"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE1_5')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE1_5'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE1_5']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE1_5'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE1_5']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE1_5" id="scorE1_5" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE1_5" id="scorMaxE1_5" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE1_5" id="scorSubItemE1_5" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.1.5</td>
                                        <td class="text-left">Dosen bergabung dalam kepanitiaan di tingkat Program Studi maupun Institusi</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E1_5" id="E1_5_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E1_5 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.1.6 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td colspan="3" class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Sedang menjadi Mentor</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Mentor/Dosen Senior</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE1_6"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE1_6')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE1_6'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE1_6']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE1_6'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE1_6']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE1_6" id="scorE1_6" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE1_6" id="scorMaxE1_6" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE1_6" id="scorSubItemE1_6" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.1.6</td>
                                        <td class="text-left">Dosen berperan serta sebagai mentor</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E1_6" id="E1_6_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E1_6 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.2 - PENGEMBANGAN DIRI -->
                                    <tr>
                                        <td>E.2</td>
                                        <td colspan="10" class="text-left font-bold">PENGEMBANGAN DIRI</td>
                                    </tr>

                                    <!-- E.2.1 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Dosen bergelar S1 dan tidak sedang studi lanjut</td>
                                        <td class="text-xs">Dosen bergelar S1 dan sedang studi lanjut</td>
                                        <td class="text-xs">Dosen bergelar S2</td>
                                        <td class="text-xs">Dosen bergelar S2 dan sedang studi lanjut</td>
                                        <td class="text-xs">Dosen bergelar S3</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Fotokopi ijazah terakhir</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE2_1"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE2_1')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE2_1'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE2_1']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE2_1'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE2_1']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE2_1" id="scorE2_1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE2_1" id="scorMaxE2_1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE2_1" id="scorSubItemE2_1" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.2.1</td>
                                        <td class="text-left">Gelar Akademis yang dimiliki oleh Dosen yang selaras dengan bidang ilmunya</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E2_1" id="E2_1_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E2_1 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.2.2 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sedang membimbing Tesis dan/ atau</td>
                                        <td class="text-xs">Membimbing tesis dan/ atau disertasi sebagai pembimbing pendamping 1 - 4 lulusan</td>
                                        <td class="text-xs">Membimbing tesis dan/ atau disertasi sebagai pembimbing pendamping >4 lulusan</td>
                                        <td class="text-xs">Membimbing tesis dan/ atau disertasi sebagai pembimbing utama 1 - 4 lulusan</td>
                                        <td class="text-xs">Membimbing tesis dan/ atau disertasi sebagai pembimbing utama >4 lulusan</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Pembimbingan</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE2_2"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE2_2')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE2_2'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE2_2']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE2_2'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE2_2']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE2_2" id="scorE2_2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE2_2" id="scorMaxE2_2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE2_2" id="scorSubItemE2_2" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.2.2</td>
                                        <td class="text-left">Dosen membimbing dalam menghasilkan Tesis dan Disertasi bagi mahasiswa strata 2 dan strata 3 (di PT lain)</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E2_2" id="E2_2_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E2_2 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.2.3 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak memiliki sertifikat profesi</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Dosen memiliki 1 sertifikat profesi</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Dosen memiliki lebih dari 1 sertifikat profesi</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Sertifikat Profesi</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE2_3"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE2_3')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE2_3'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE2_3']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE2_3'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE2_3']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE2_3" id="scorE2_3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE2_3" id="scorMaxE2_3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE2_3" id="scorSubItemE2_3" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.2.3</td>
                                        <td class="text-left">Dosen mendapatkan sertifikat profesi berdasarkan bidang keilmuannya</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E2_3" id="E2_3_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E2_3 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- E.2.4 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak pernah mengikuti kursus</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Dosen pernah mengikuti kursus dalam 1 TA yang lalu</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Dosen sedang mengikuti kursus/telah mengikuti kursus dalam Tahun Akademik penilaian</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Kursus/ kegiatan sejenis</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileE2_4"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileE2_4')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileE2_4'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileE2_4']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileE2_4'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileE2_4']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorE2_4" id="scorE2_4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxE2_4" id="scorMaxE2_4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemE2_4" id="scorSubItemE2_4" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>E.2.4</td>
                                        <td class="text-left">Dosen berusaha meningkatkan ilmunya dengan mengikuti kursus yang relevan untuk peningkatan kemampuannya pada proses-proses selaras Tridharma perguruan tinggi</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="E2_4" id="E2_4_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="E2_4 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Summary Section -->
                                    <tr>
                                        <td colspan="5"></td>
                                        <td colspan="5" class="font-bold">Total Skor Unsur Pengabdian kepada Institusi dan Pengembangan Diri</td>
                                        <td>
                                            <input type="number" name="SumSkor"
                                                id="SumSkor" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td colspan="5" class="font-bold">Nilai Total Unsur Pengabdian kpd Institusi dan Pengembangan Diri</td>
                                        <td>
                                            <input type="number" name="NilaiUnsurPengabdian"
                                                id="NilaiUnsurPengabdian" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="handleSubmitPointE()"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <!-- Tampilkan pesan error full page jika tidak ada periode aktif -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                <div class="p-8 text-center">
                    <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-calendar-times text-red-600 text-2xl"></i>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                        Periode Penilaian Tidak Aktif
                    </h3>

                    <p class="text-gray-600 dark:text-gray-300 mb-6 max-w-md mx-auto">
                        Saat ini tidak ada periode penilaian yang aktif.
                        Silakan hubungi administrator untuk informasi lebih lanjut.
                    </p>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 max-w-md mx-auto">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Anda tidak dapat mengisi form penilaian saat ini karena tidak ada periode aktif.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ url()->previous() }}"
                       class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        @endif
    </div>

    @livewireScripts
    @push('scripts')
        <!-- Scripts hanya di-load jika ada periode aktif -->
        @if($hasActivePeriod)
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="{{ asset('js/penilaian/itikad/point-e-calculations.js') }}"></script>

            <script>
                // Ambil data awal dari PHP
                const initialDataE = @json($this->formDataForJS);

                console.log('Initial data Point E loaded:', initialDataE);

                function fillFormPointE() {
                    if (!initialDataE || Object.keys(initialDataE).length === 0) return;

                    console.log('Filling Point E form with data...');

                    // 1. Isi Radio Buttons untuk semua item E
                    const eItems = [
                        'E1_1', 'E1_2', 'E1_3', 'E1_4', 'E1_5', 'E1_6',
                        'E2_1', 'E2_2', 'E2_3', 'E2_4'
                    ];

                    eItems.forEach(item => {
                        const val = initialDataE[item];
                        if (val !== undefined && val !== null) {
                            const radio = document.querySelector(`input[name="${item}"][value="${val}"]`);
                            if (radio) {
                                radio.checked = true;
                                console.log(`Set radio ${item} to ${val}`);
                            }
                        }
                    });

                    // 2. Isi SEMUA input number yang ada di tabel
                    const allNumberFieldsE = [
                        // Skor utama untuk semua item
                        'scorE1_1', 'scorE1_2', 'scorE1_3', 'scorE1_4', 'scorE1_5', 'scorE1_6',
                        'scorE2_1', 'scorE2_2', 'scorE2_3', 'scorE2_4',
                        'scorMaxE1_1', 'scorMaxE1_2', 'scorMaxE1_3', 'scorMaxE1_4', 'scorMaxE1_5', 'scorMaxE1_6',
                        'scorMaxE2_1', 'scorMaxE2_2', 'scorMaxE2_3', 'scorMaxE2_4',
                        'scorSubItemE1_1', 'scorSubItemE1_2', 'scorSubItemE1_3', 'scorSubItemE1_4', 'scorSubItemE1_5', 'scorSubItemE1_6',
                        'scorSubItemE2_1', 'scorSubItemE2_2', 'scorSubItemE2_3', 'scorSubItemE2_4',

                        // Hasil akhir
                        'SumSkor',
                        'NilaiUnsurPengabdian'
                    ];

                    // Isi semua field
                    allNumberFieldsE.forEach(field => {
                        const el = document.getElementById(field);
                        if (el && initialDataE[field] !== undefined && initialDataE[field] !== null) {
                            el.value = initialDataE[field];
                            console.log(`Set ${field} to ${initialDataE[field]}`);
                        }
                    });

                    // 3. Isi hidden inputs untuk Livewire
                    syncDataToLivewirePointE();

                    // 4. Trigger calculation setelah semua data diisi
                    setTimeout(() => {
                        if (typeof sum === 'function') {
                            console.log('Triggering Point E calculation...');
                            sum();
                        }
                    }, 500);
                }

                // Fungsi untuk sync data dari display ke Livewire state untuk Point E
                function syncDataToLivewirePointE() {
                    console.log('Syncing Point E data to Livewire...');

                    const dataToSync = {};

                    // 1. Ambil semua radio buttons yang checked untuk item E
                    const eItems = [
                        'E1_1', 'E1_2', 'E1_3', 'E1_4', 'E1_5', 'E1_6',
                        'E2_1', 'E2_2', 'E2_3', 'E2_4'
                    ];

                    eItems.forEach(item => {
                        const radio = document.querySelector(`input[name="${item}"]:checked`);
                        if (radio) {
                            dataToSync[item] = radio.value;
                        }
                    });

                    // 2. Ambil semua input number di tabel Point E
                    const allInputs = document.querySelectorAll('.point-e-table input[type="number"]');
                    allInputs.forEach(input => {
                        if (input.id && input.id !== '') {
                            // Jika input kosong, set ke 0 (untuk field skor)
                            if (input.value === '' || input.value === null) {
                                if (input.id.startsWith('scor') ||
                                    input.id.startsWith('SumSkor') ||
                                    input.id.startsWith('Nilai')) {
                                    dataToSync[input.id] = 0;
                                    input.value = 0; // Update display juga
                                }
                            } else {
                                dataToSync[input.id] = input.value;
                            }
                        }
                    });

                    // 3. Update Livewire state
                    if (Object.keys(dataToSync).length > 0) {
                        @this.set('data', {
                            ...Object.fromEntries(Object.entries(@this.get('data'))),
                            ...dataToSync
                        }, true);
                    }

                    console.log('Point E data synced to Livewire:', dataToSync);
                }

                // Override fungsi sum() untuk update Livewire state
                const originalSumPointE = window.sum;
                window.sum = function() {
                    // Panggil fungsi asli
                    if (typeof originalSumPointE === 'function') {
                        originalSumPointE();
                    }

                    // Sync ke Livewire setelah perhitungan
                    setTimeout(syncDataToLivewirePointE, 100);
                };

                // Event listener untuk semua input Point E
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('DOM loaded, filling Point E form...');

                    // Isi form dengan data awal
                    fillFormPointE();

                    // Setup event listeners untuk semua input Point E
                    document.querySelectorAll('.point-e-table input').forEach(input => {
                        if (input.type === 'radio') {
                            input.addEventListener('change', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewirePointE();
                                }, 100);
                            });
                        }

                        if (input.type === 'number') {
                            input.addEventListener('input', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewirePointE();
                                }, 100);
                            });

                            input.addEventListener('change', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewirePointE();
                                }, 100);
                            });
                        }
                    });
                });

                async function handleSubmitPointE() {
                    // 1. Pastikan sync data terbaru
                    syncDataToLivewirePointE();

                    // 2. Validasi radio buttons
                    let isValid = true;
                    const eItems = [
                        'E1_1', 'E1_2', 'E1_3', 'E1_4', 'E1_5', 'E1_6',
                        'E2_1', 'E2_2', 'E2_3', 'E2_4'
                    ];

                    for (const item of eItems) {
                        if (!document.querySelector(`input[name="${item}"]:checked`)) {
                            isValid = false;
                            await Swal.fire({
                                title: 'Perhatian',
                                text: `Harap pilih skor untuk item ${item}`,
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            });
                            break;
                        }
                    }

                    if (!isValid) return;

                    // 3. Validasi file upload untuk item yang memerlukan
                    // const itemsWithFiles = [
                    //     { item: 'E1_1', desc: 'SK Rektor' },
                    //     { item: 'E1_2', desc: 'MoU/MoA' },
                    //     { item: 'E1_3', desc: 'SK Rektor untuk satgas marketing' },
                    //     { item: 'E1_4', desc: 'SK Rektor untuk satgas non-marketing' },
                    //     { item: 'E1_5', desc: 'SK Rektor untuk kepanitiaan' },
                    //     { item: 'E1_6', desc: 'SK Mentor' },
                    //     { item: 'E2_1', desc: 'Ijazah' },
                    //     { item: 'E2_2', desc: 'SK Pembimbingan' },
                    //     { item: 'E2_3', desc: 'Sertifikat Profesi' },
                    //     { item: 'E2_4', desc: 'SK Kursus' }
                    // ];

                    // for (const fileItem of itemsWithFiles) {
                    //     const radioValue = document.querySelector(`input[name="${fileItem.item}"]:checked`);
                    //     if (radioValue && radioValue.value > 1) {
                    //         const fileInput = document.querySelector(`input[name="file${fileItem.item}"]`);
                    //         if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                    //             await Swal.fire({
                    //                 title: 'Perhatian',
                    //                 text: `Untuk skor ${fileItem.item} lebih dari 1, harap upload ${fileItem.desc}`,
                    //                 icon: 'warning',
                    //                 confirmButtonText: 'OK'
                    //             });
                    //             return;
                    //         }
                    //     }
                    // }

                    // 4. Konfirmasi
                    const result = await Swal.fire({
                        title: 'Simpan Data Point E?',
                        text: "Data Pengabdian Kepada Institusi & Pengembangan Diri akan disimpan ke database.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Simpan',
                        cancelButtonText: 'Batal'
                    });

                    if (result.isConfirmed) {
                        // 5. Trigger save di Livewire
                        @this.save();
                    }
                }
            </script>
        @endif
    @endpush
</x-filament-panels::page>
