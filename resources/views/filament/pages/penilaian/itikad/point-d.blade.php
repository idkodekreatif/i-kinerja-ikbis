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

            .point-d-table {
                font-size: 0.875rem;
                width: 100%;
                border-collapse: collapse;
                table-layout: auto;
                min-width: 1300px;
            }

            .point-d-table th,
            .point-d-table td {
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

            .point-d-table .bg-warning {
                background-color: #fef3c7 !important;
            }

            .point-d-table input[type="radio"] {
                margin: 0 auto;
                display: block;
            }

            .point-d-table input[readonly] {
                background-color: #f3f4f6;
                font-weight: bold;
                width: 100%;
                text-align: center;
                border: none;
                padding: 0.5rem 0;
            }

            .point-d-table input[type="number"]:not([readonly]) {
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
                            Form Point D - Unsur Penunjang
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
                    <form id="pointDForm" wire:submit.prevent="save" enctype="multipart/form-data">
                        <!-- Hidden inputs untuk data yang akan diisi JavaScript -->
                        <input type="hidden" wire:model="data.user_id" id="user_id" value="{{ auth()->id() }}">

                        <!-- Hidden inputs untuk D1-D11 -->
                        @for ($i = 1; $i <= 11; $i++)
                            <input type="hidden" wire:model="data.D{{ $i }}" id="D{{ $i }}">
                        @endfor

                        <!-- Hidden inputs untuk file uploads -->
                        @for ($i = 1; $i <= 11; $i++)
                            <input type="hidden" wire:model="data.fileD{{ $i }}" id="fileD{{ $i }}_hidden">
                        @endfor

                        <!-- Hidden inputs untuk jumlah yang dihasilkan -->
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD2_2" id="hidden_JumlahYangDihasilkanD2_2">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD2_3" id="hidden_JumlahYangDihasilkanD2_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD2_4" id="hidden_JumlahYangDihasilkanD2_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD2_5" id="hidden_JumlahYangDihasilkanD2_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD3_2" id="hidden_JumlahYangDihasilkanD3_2">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD3_3" id="hidden_JumlahYangDihasilkanD3_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD3_4" id="hidden_JumlahYangDihasilkanD3_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD3_5" id="hidden_JumlahYangDihasilkanD3_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD4_3" id="hidden_JumlahYangDihasilkanD4_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD4_4" id="hidden_JumlahYangDihasilkanD4_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD4_5" id="hidden_JumlahYangDihasilkanD4_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD5_3" id="hidden_JumlahYangDihasilkanD5_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD5_4" id="hidden_JumlahYangDihasilkanD5_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD5_5" id="hidden_JumlahYangDihasilkanD5_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD6_2" id="hidden_JumlahYangDihasilkanD6_2">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD6_3" id="hidden_JumlahYangDihasilkanD6_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD6_4" id="hidden_JumlahYangDihasilkanD6_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD6_5" id="hidden_JumlahYangDihasilkanD6_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD7_5" id="hidden_JumlahYangDihasilkanD7_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD8_3" id="hidden_JumlahYangDihasilkanD8_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD8_4" id="hidden_JumlahYangDihasilkanD8_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD8_5" id="hidden_JumlahYangDihasilkanD8_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD9_2" id="hidden_JumlahYangDihasilkanD9_2">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD9_3" id="hidden_JumlahYangDihasilkanD9_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD9_4" id="hidden_JumlahYangDihasilkanD9_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD9_5" id="hidden_JumlahYangDihasilkanD9_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD10_3" id="hidden_JumlahYangDihasilkanD10_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD10_4" id="hidden_JumlahYangDihasilkanD10_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD10_5" id="hidden_JumlahYangDihasilkanD10_5">

                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD11_3" id="hidden_JumlahYangDihasilkanD11_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD11_4" id="hidden_JumlahYangDihasilkanD11_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanD11_5" id="hidden_JumlahYangDihasilkanD11_5">

                        <!-- Hidden inputs untuk total skor -->
                        <input type="hidden" wire:model="data.TotalSkorUnsurPenunjang" id="Hidden_TotalSkorUnsurPenunjang">
                        <input type="hidden" wire:model="data.NilaiUnsurPenunjang" id="Hidden_NilaiUnsurPenunjang">
                        <input type="hidden" wire:model="data.NilaiTambahUnsurPenunjang" id="Hidden_NilaiTambahUnsurPenunjang">
                        <input type="hidden" wire:model="data.ResultSumNilaiTotalUnsurPenunjang" id="Hidden_ResultSumNilaiTotalUnsurPenunjang">

                        <!-- Hidden inputs untuk total kelebihan -->
                        <input type="hidden" wire:model="data.TotalKelebihaD2" id="Hidden_TotalKelebihaD2">
                        <input type="hidden" wire:model="data.TotalKelebihaD3" id="Hidden_TotalKelebihaD3">
                        <input type="hidden" wire:model="data.TotalKelebihaD4" id="Hidden_TotalKelebihaD4">
                        <input type="hidden" wire:model="data.TotalKelebihaD5" id="Hidden_TotalKelebihaD5">
                        <input type="hidden" wire:model="data.TotalKelebihaD6" id="Hidden_TotalKelebihaD6">
                        <input type="hidden" wire:model="data.TotalKelebihaD7" id="Hidden_TotalKelebihaD7">
                        <input type="hidden" wire:model="data.TotalKelebihaD8" id="Hidden_TotalKelebihaD8">
                        <input type="hidden" wire:model="data.TotalKelebihaD9" id="Hidden_TotalKelebihaD9">
                        <input type="hidden" wire:model="data.TotalKelebihaD10" id="Hidden_TotalKelebihaD10">
                        <input type="hidden" wire:model="data.TotalKelebihaD11" id="Hidden_TotalKelebihaD11">
                        <input type="hidden" wire:model="data.TotalKelebihanSkor" id="Hidden_TotalKelebihanSkor">

                        <div class="overflow-x-auto mb-6">
                            <table class="point-d-table">
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
                                    <tr>
                                        <td>D</td>
                                        <td colspan="10" class="text-left font-bold">UNSUR PENUNJANG</td>
                                    </tr>

                                    <!-- D.1 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Menjadi anggota senat fakultas</td>
                                        <td class="text-xs">Menjadi anggota senat Institusi</td>
                                        <td class="text-xs">Menjadi Ketua/Sekretaris Senat fakultas</td>
                                        <td class="text-xs">Menjadi Ketua/Sekretaris Senat Institusi</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Yayasan yang menyatakan keanggotaan dalam Senat Akademik</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD1"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD1')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD1'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD1']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD1'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD1']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD1" id="scorD1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD1" id="scorMaxD1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD1" id="scorSubItemD1" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.1</td>
                                        <td class="text-left">Dosen menjadi ketua, sekretaris atau anggota senat fakultas/Institusi</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D1" id="D1_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D1 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- D.2 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Terlibat dalam Kepanitiaan Kegiatan Internal / Lokal</td>
                                        <td class="text-xs">Terlibat dalam Kepanitiaan Kegiatan Regional</td>
                                        <td class="text-xs">Terlibat dalam Kepanitiaan Kegiatan Nasional</td>
                                        <td class="text-xs">Terlibat dalam Kepanitiaan Kegiatan Internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK atau Surat Tugas yang menyatakan keanggotaan dosen</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD2"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD2')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD2'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD2']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD2'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD2']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD2" id="scorD2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD2" id="scorMaxD2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD2" id="scorSubItemD2" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.2</td>
                                        <td class="text-left">Dosen menjadi anggota pada kepanitiaan tertentu (terkait Tri Dharma)</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D2" id="D2_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D2 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.2 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah kepanitiaan yang diikuti</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD2_2"
                                                id="JumlahYangDihasilkanD2_2" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD2_3"
                                                id="JumlahYangDihasilkanD2_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD2_4"
                                                id="JumlahYangDihasilkanD2_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD2_5"
                                                id="JumlahYangDihasilkanD2_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD2"
                                                id="JumlahSkorYangDiHasilkanD2" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD2"
                                                id="SkorTambahanJumlahSkorD2" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD2_2" id="SkorTambahanD2_2" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD2_3" id="SkorTambahanD2_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD2_4" id="SkorTambahanD2_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD2_5" id="SkorTambahanD2_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD2" id="SkorTambahanJumlahD2" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD2"
                                                id="SkorTambahanJumlahBobotSubItemD2" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.3 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Menjadi anggota dari suatu bidang kerja</td>
                                        <td class="text-xs">Menjadi Ketua bidang/Koordinator suatu bidang kerja</td>
                                        <td class="text-xs">Menjadi Pengurus inti (Sekretaris / Bendahara) dalam kegiatan</td>
                                        <td class="text-xs">Menjadi Ketua/Wakil Ketua dalam kegiatan</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload SK Pengangkatan dosen sebagai pengurus dalam organisasi kemasyarakatan tertentu</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD3"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD3')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD3'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD3']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD3'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD3']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD3" id="scorD3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD3" id="scorMaxD3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD3" id="scorSubItemD3" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.3</td>
                                        <td class="text-left">Peranan dosen dalam kepanitiaan tertentu</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D3" id="D3_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D3 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.3 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah peranan dosen dalam kepanitiaan</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD3_2"
                                                id="JumlahYangDihasilkanD3_2" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD3_3"
                                                id="JumlahYangDihasilkanD3_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD3_4"
                                                id="JumlahYangDihasilkanD3_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD3_5"
                                                id="JumlahYangDihasilkanD3_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD3"
                                                id="JumlahSkorYangDiHasilkanD3" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD3"
                                                id="SkorTambahanJumlahSkorD3" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD3_2" id="SkorTambahanD3_2" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD3_3" id="SkorTambahanD3_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD3_4" id="SkorTambahanD3_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD3_5" id="SkorTambahanD3_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD3" id="SkorTambahanJumlahD3" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD3"
                                                id="SkorTambahanJumlahBobotSubItemD3" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.4 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Pernah menjadi mitra bestari/reviewer pada 1 tahun penilaian yang lampau</td>
                                        <td class="text-xs">Sedang menjadi mitra bestari/reviewer jurnal ilmiah tidak terakreditasi</td>
                                        <td class="text-xs">Sedang menjadi mitra bestari/reviewer jurnal ilmiah nasional terakreditasi</td>
                                        <td class="text-xs">Sedang menjadi mitra bestari/reviewer jurnal ilmiah internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Surat Keterangan dan Bukti Jurnal</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD4"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD4')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD4'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD4']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD4'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD4']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD4" id="scorD4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD4" id="scorMaxD4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD4" id="scorSubItemD4" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.4</td>
                                        <td class="text-left">Dosen menjadi mitra bestari/reviewer dalam jurnal ilmiah</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D4" id="D4_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D4 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.4 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah jurnal</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD4_3"
                                                id="JumlahYangDihasilkanD4_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD4_4"
                                                id="JumlahYangDihasilkanD4_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD4_5"
                                                id="JumlahYangDihasilkanD4_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD4"
                                                id="JumlahSkorYangDiHasilkanD4" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD4"
                                                id="SkorTambahanJumlahSkorD4" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD4_3" id="SkorTambahanD4_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD4_4" id="SkorTambahanD4_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD4_5" id="SkorTambahanD4_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD4" id="SkorTambahanJumlahD4" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD4"
                                                id="SkorTambahanJumlahBobotSubItemD4" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.5 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Pernah menjadi redaktur/editor pada 1 tahun penilaian yang lampau</td>
                                        <td class="text-xs">Sedang menjadi redaktur/editor terbitan lokal</td>
                                        <td class="text-xs">Sedang menjadi redaktur/editor terbitan nasional</td>
                                        <td class="text-xs">Sedang menjadi redaktur/editor terbitan internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Surat Keterangan dan Bukti Majalah/terbitan populer lainnya</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD5"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD5')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD5'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD5']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD5'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD5']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD5" id="scorD5" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD5" id="scorMaxD5" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD5" id="scorSubItemD5" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.5</td>
                                        <td class="text-left">Dosen menjadi redaktur/editor dalam suatu terbitan populer yang terkait erat dengan bidang keilmuannya</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D5" id="D5_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D5 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.5 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah terbitan populer</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD5_3"
                                                id="JumlahYangDihasilkanD5_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD5_4"
                                                id="JumlahYangDihasilkanD5_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD5_5"
                                                id="JumlahYangDihasilkanD5_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD5"
                                                id="JumlahSkorYangDiHasilkanD5" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD5"
                                                id="SkorTambahanJumlahSkorD5" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD5_3" id="SkorTambahanD5_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD5_4" id="SkorTambahanD5_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD5_5" id="SkorTambahanD5_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD5" id="SkorTambahanJumlahD5" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD5"
                                                id="SkorTambahanJumlahBobotSubItemD5" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.6 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Menjadi anggota di tingkat nasional</td>
                                        <td class="text-xs">Menjadi anggota di tingkat internasional</td>
                                        <td class="text-xs">Menjadi pengurus di tingkat nasional</td>
                                        <td class="text-xs">Menjadi pengurus di tingkat internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Kartu Keanggotaan / Surat Keterangan anggota</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD6"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD6')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD6'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD6']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD6'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD6']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD6" id="scorD6" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD6" id="scorMaxD6" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD6" id="scorSubItemD6" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.6</td>
                                        <td class="text-left">Dosen menjadi anggota organisasi asosiasi profesi, yang terkait bidang keilmuannya</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D6" id="D6_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D6 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.6 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah organisasi asosiasi profesi</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD6_2"
                                                id="JumlahYangDihasilkanD6_2" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD6_3"
                                                id="JumlahYangDihasilkanD6_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD6_4"
                                                id="JumlahYangDihasilkanD6_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD6_5"
                                                id="JumlahYangDihasilkanD6_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD6"
                                                id="JumlahSkorYangDiHasilkanD6" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD6"
                                                id="SkorTambahanJumlahSkorD6" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD6_2" id="SkorTambahanD6_2" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD6_3" id="SkorTambahanD6_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD6_4" id="SkorTambahanD6_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD6_5" id="SkorTambahanD6_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD6" id="SkorTambahanJumlahD6" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD6"
                                                id="SkorTambahanJumlahBobotSubItemD6" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.7 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Menjadi anggota delegasi dalam 1 pertemuan internasional</td>
                                        <td class="text-xs">Menjadi anggota delegasi dalam 2 pertemuan internasional</td>
                                        <td class="text-xs">Menjadi anggota delegasi dalam 3 pertemuan internasional</td>
                                        <td class="text-xs">Menjadi anggota delegasi dalam 4 pertemuan internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Surat Tugas yang menyatakan dosen menjadi anggota delegasi internasional</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD7"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD7')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD7'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD7']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD7'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD7']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD7" id="scorD7" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD7" id="scorMaxD7" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD7" id="scorSubItemD7" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.7</td>
                                        <td class="text-left">Dosen menjadi anggota delegasi nasional dalam pertemuan internasional</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D7" id="D7_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D7 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.7 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah (>4 pertemuan internasional)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD7_5"
                                                id="JumlahYangDihasilkanD7_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD7"
                                                id="JumlahSkorYangDiHasilkanD7" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD7"
                                                id="SkorTambahanJumlahSkorD7" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD7_5" id="SkorTambahanD7_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD7" id="SkorTambahanJumlahD7" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD7"
                                                id="SkorTambahanJumlahBobotSubItemD7" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.8 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Menjadi peserta dalam suatu pertemuan ilmiah internal IKBIS (minimal 5 pertemuan internal)</td>
                                        <td class="text-xs">Menjadi peserta dalam suatu pertemuan ilmiah tingkat lokal dan regional dan minimal 4 kali dalam pertemuan internal</td>
                                        <td class="text-xs">Menjadi peserta dalam suatu pertemuan ilmiah tingkat nasional dan minimal 3 kali dalam pertemuan internal / menjadi moderator di tingkat lokal dan regional</td>
                                        <td class="text-xs">Menjadi peserta dalam suatu pertemuan ilmiah tingkat internasional dan minimal 2 kali dalam pertemuan internal / menjadi moderator di tingkat nasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Presensi Forum Komunikasi Ilmiah dan Sertifikat Seminar</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD8"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD8')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD8'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD8']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD8'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD8']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD8" id="scorD8" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD8" id="scorMaxD8" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD8" id="scorSubItemD8" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.8</td>
                                        <td class="text-left">Dosen berperan serta dalam pertemuan ilmiah (misalnya: Seminar, Simposium)</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D8" id="D8_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D8 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.8 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah pertemuan ilmiah</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD8_3"
                                                id="JumlahYangDihasilkanD8_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD8_4"
                                                id="JumlahYangDihasilkanD8_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD8_5"
                                                id="JumlahYangDihasilkanD8_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD8"
                                                id="JumlahSkorYangDiHasilkanD8" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD8"
                                                id="SkorTambahanJumlahSkorD8" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD8_3" id="SkorTambahanD8_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD8_4" id="SkorTambahanD8_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD8_5" id="SkorTambahanD8_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD8" id="SkorTambahanJumlahD8" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD8"
                                                id="SkorTambahanJumlahBobotSubItemD8" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.9 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Mendapatkan tanda jasa/penghargaan internal IKBIS</td>
                                        <td class="text-xs">Mendapatkan tanda jasa/penghargaan tingkat lokal (kota/kabupaten)</td>
                                        <td class="text-xs">Mendapatkan tanda jasa/penghargaan tingkat nasional</td>
                                        <td class="text-xs">Mendapatkan tanda jasa/penghargaan tingkat internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Piagam Penghargaan dan atau SK yang menyertai</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD9"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD9')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD9'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD9']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD9'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD9']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD9" id="scorD9" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD9" id="scorMaxD9" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD9" id="scorSubItemD9" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.9</td>
                                        <td class="text-left">Dosen mendapatkan tanda jasa/penghargaan</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D9" id="D9_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D9 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.9 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah tanda jasa</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD9_2"
                                                id="JumlahYangDihasilkanD9_2" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD9_3"
                                                id="JumlahYangDihasilkanD9_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD9_4"
                                                id="JumlahYangDihasilkanD9_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD9_5"
                                                id="JumlahYangDihasilkanD9_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD9"
                                                id="JumlahSkorYangDiHasilkanD9" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD9"
                                                id="SkorTambahanJumlahSkorD9" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD9_2" id="SkorTambahanD9_2" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD9_3" id="SkorTambahanD9_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD9_4" id="SkorTambahanD9_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD9_5" id="SkorTambahanD9_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD9" id="SkorTambahanJumlahD9" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD9"
                                                id="SkorTambahanJumlahBobotSubItemD9" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.10 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Pernah menulis buku pelajaran SMA ke bawah pada tahun penilaian sebelumnya</td>
                                        <td class="text-xs">Menulis buku SD atau setingkat</td>
                                        <td class="text-xs">Menulis buku SMP atau setingkat</td>
                                        <td class="text-xs">Menulis buku SMA atau setingkat</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti Fisik Buku</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD10"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD10')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD10'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD10']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD10'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD10']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD10" id="scorD10" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD10" id="scorMaxD10" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD10" id="scorSubItemD10" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.10</td>
                                        <td class="text-left">Dosen menulis buku pelajaran SMA ke bawah yang diterbitkan dan diedarkan secara nasional</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D10" id="D10_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D10 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.10 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah buku yang diterbitkan</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD10_3"
                                                id="JumlahYangDihasilkanD10_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD10_4"
                                                id="JumlahYangDihasilkanD10_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD10_5"
                                                id="JumlahYangDihasilkanD10_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD10"
                                                id="JumlahSkorYangDiHasilkanD10" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD10"
                                                id="SkorTambahanJumlahSkorD10" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD10_3" id="SkorTambahanD10_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD10_4" id="SkorTambahanD10_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD10_5" id="SkorTambahanD10_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD10" id="SkorTambahanJumlahD10" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD10"
                                                id="SkorTambahanJumlahBobotSubItemD10" readonly>
                                        </td>
                                    </tr>

                                    <!-- D.11 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak diperhitungkan</td>
                                        <td class="text-xs">Tidak Sama Sekali</td>
                                        <td class="text-xs">Berprestasi di tingkat lokal/regional</td>
                                        <td class="text-xs">Berprestasi di tingkat nasional</td>
                                        <td class="text-xs">Berprestasi di tingkat internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Piagam Penghargaan dan atau SK yang menyertai</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileD11"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileD11')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileD11'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileD11']) }}
                                                    </div>
                                                @endif

                                                @if($this->data['fileD11'] ?? false)
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileD11']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorD11" id="scorD11" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxD11" id="scorMaxD11" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemD11" id="scorSubItemD11" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D.11</td>
                                        <td class="text-left">Dosen memiliki prestasi di bidang olah raga/kesenian/humaniora (menjadi duta besar organisasi tertentu atau negara tertentu)</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="D11" id="D11_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="D11 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Tambahan untuk D.11 -->
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah prestasi</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD11_3"
                                                id="JumlahYangDihasilkanD11_3" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD11_4"
                                                id="JumlahYangDihasilkanD11_4" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td>
                                            <input type="number" name="JumlahYangDihasilkanD11_5"
                                                id="JumlahYangDihasilkanD11_5" onkeyup="sum()" placeholder="0"
                                                class="w-full text-center">
                                        </td>
                                        <td></td>
                                        <td class="bg-warning">
                                            <input type="number" name="JumlahSkorYangDiHasilkanD11"
                                                id="JumlahSkorYangDiHasilkanD11" readonly>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahSkorD11"
                                                id="SkorTambahanJumlahSkorD11" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanD11_3" id="SkorTambahanD11_3" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD11_4" id="SkorTambahanD11_4" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanD11_5" id="SkorTambahanD11_5" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahD11" id="SkorTambahanJumlahD11" readonly>
                                        </td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td>
                                            <input type="number" name="SkorTambahanJumlahBobotSubItemD11"
                                                id="SkorTambahanJumlahBobotSubItemD11" readonly>
                                        </td>
                                    </tr>

                                    <!-- Summary Section -->
                                    <tr>
                                        <td colspan="5"></td>
                                        <td colspan="5" class="font-bold">Total Skor Unsur Penunjang</td>
                                        <td>
                                            <input type="number" name="TotalSkorUnsurPenunjang"
                                                id="TotalSkorUnsurPenunjang" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 2</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD2" id="TotalKelebihaD2"
                                                readonly class="w-full text-center">
                                        </td>
                                        <td colspan="3" rowspan="4" class="font-bold">Nilai Unsur Penunjang</td>
                                        <td rowspan="4">
                                            <input type="number" name="NilaiUnsurPenunjang"
                                                id="NilaiUnsurPenunjang" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 3</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD3" id="TotalKelebihaD3"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 4</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD4" id="TotalKelebihaD4"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 5</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD5" id="TotalKelebihaD5"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 6</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD6" id="TotalKelebihaD6"
                                                readonly class="w-full text-center">
                                        </td>
                                        <td colspan="3" rowspan="7" class="font-bold">Nilai Tambah Unsur Penunjang</td>
                                        <td rowspan="7">
                                            <input type="number" name="NilaiTambahUnsurPenunjang"
                                                id="NilaiTambahUnsurPenunjang" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 7</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD7" id="TotalKelebihaD7"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 8</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD8" id="TotalKelebihaD8"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 9</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD9" id="TotalKelebihaD9"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 10</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD10" id="TotalKelebihaD10"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 11</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaD11" id="TotalKelebihaD11"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor</td>
                                        <td>
                                            <input type="number" name="TotalKelebihanSkor" id="TotalKelebihanSkor"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="6" class="font-bold">Nilai Total Unsur Penunjang</td>
                                        <td>
                                            <input type="number" name="ResultSumNilaiTotalUnsurPenunjang"
                                                id="ResultSumNilaiTotalUnsurPenunjang" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="handleSubmitPointD()"
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
            <script src="{{ asset('js/penilaian/itikad/point-d-calculations.js') }}"></script>

            <script>
                // Ambil data awal dari PHP
                const initialDataD = @json($this->formDataForJS);

                console.log('Initial data Point D loaded:', initialDataD);

                function fillFormPointD() {
                    if (!initialDataD || Object.keys(initialDataD).length === 0) return;

                    console.log('Filling Point D form with data...');

                    // 1. Isi Radio Buttons D1-D11
                    for (let i = 1; i <= 11; i++) {
                        const val = initialDataD[`D${i}`];
                        if (val !== undefined && val !== null) {
                            const radio = document.querySelector(`input[name="D${i}"][value="${val}"]`);
                            if (radio) {
                                radio.checked = true;
                                console.log(`Set radio D${i} to ${val}`);
                            }
                        }
                    }

                    // 2. Isi SEMUA input number yang ada di tabel
                    const allNumberFieldsD = [
                        // Skor utama D1-D11
                        'scorD1', 'scorD2', 'scorD3', 'scorD4', 'scorD5', 'scorD6', 'scorD7', 'scorD8',
                        'scorD9', 'scorD10', 'scorD11',
                        'scorMaxD1', 'scorMaxD2', 'scorMaxD3', 'scorMaxD4', 'scorMaxD5', 'scorMaxD6',
                        'scorMaxD7', 'scorMaxD8', 'scorMaxD9', 'scorMaxD10', 'scorMaxD11',
                        'scorSubItemD1', 'scorSubItemD2', 'scorSubItemD3', 'scorSubItemD4', 'scorSubItemD5',
                        'scorSubItemD6', 'scorSubItemD7', 'scorSubItemD8', 'scorSubItemD9', 'scorSubItemD10',
                        'scorSubItemD11',

                        // Tambahan untuk semua item yang punya jumlah
                        'JumlahYangDihasilkanD2_2', 'JumlahYangDihasilkanD2_3', 'JumlahYangDihasilkanD2_4', 'JumlahYangDihasilkanD2_5',
                        'JumlahSkorYangDiHasilkanD2', 'SkorTambahanD2_2', 'SkorTambahanD2_3', 'SkorTambahanD2_4', 'SkorTambahanD2_5',
                        'SkorTambahanJumlahD2', 'SkorTambahanJumlahSkorD2', 'SkorTambahanJumlahBobotSubItemD2',

                        'JumlahYangDihasilkanD3_2', 'JumlahYangDihasilkanD3_3', 'JumlahYangDihasilkanD3_4', 'JumlahYangDihasilkanD3_5',
                        'JumlahSkorYangDiHasilkanD3', 'SkorTambahanD3_2', 'SkorTambahanD3_3', 'SkorTambahanD3_4', 'SkorTambahanD3_5',
                        'SkorTambahanJumlahD3', 'SkorTambahanJumlahSkorD3', 'SkorTambahanJumlahBobotSubItemD3',

                        'JumlahYangDihasilkanD4_3', 'JumlahYangDihasilkanD4_4', 'JumlahYangDihasilkanD4_5',
                        'JumlahSkorYangDiHasilkanD4', 'SkorTambahanD4_3', 'SkorTambahanD4_4', 'SkorTambahanD4_5',
                        'SkorTambahanJumlahD4', 'SkorTambahanJumlahSkorD4', 'SkorTambahanJumlahBobotSubItemD4',

                        'JumlahYangDihasilkanD5_3', 'JumlahYangDihasilkanD5_4', 'JumlahYangDihasilkanD5_5',
                        'JumlahSkorYangDiHasilkanD5', 'SkorTambahanD5_3', 'SkorTambahanD5_4', 'SkorTambahanD5_5',
                        'SkorTambahanJumlahD5', 'SkorTambahanJumlahSkorD5', 'SkorTambahanJumlahBobotSubItemD5',

                        'JumlahYangDihasilkanD6_2', 'JumlahYangDihasilkanD6_3', 'JumlahYangDihasilkanD6_4', 'JumlahYangDihasilkanD6_5',
                        'JumlahSkorYangDiHasilkanD6', 'SkorTambahanD6_2', 'SkorTambahanD6_3', 'SkorTambahanD6_4', 'SkorTambahanD6_5',
                        'SkorTambahanJumlahD6', 'SkorTambahanJumlahSkorD6', 'SkorTambahanJumlahBobotSubItemD6',

                        'JumlahYangDihasilkanD7_5',
                        'JumlahSkorYangDiHasilkanD7', 'SkorTambahanD7_5',
                        'SkorTambahanJumlahD7', 'SkorTambahanJumlahSkorD7', 'SkorTambahanJumlahBobotSubItemD7',

                        'JumlahYangDihasilkanD8_3', 'JumlahYangDihasilkanD8_4', 'JumlahYangDihasilkanD8_5',
                        'JumlahSkorYangDiHasilkanD8', 'SkorTambahanD8_3', 'SkorTambahanD8_4', 'SkorTambahanD8_5',
                        'SkorTambahanJumlahD8', 'SkorTambahanJumlahSkorD8', 'SkorTambahanJumlahBobotSubItemD8',

                        'JumlahYangDihasilkanD9_2', 'JumlahYangDihasilkanD9_3', 'JumlahYangDihasilkanD9_4', 'JumlahYangDihasilkanD9_5',
                        'JumlahSkorYangDiHasilkanD9', 'SkorTambahanD9_2', 'SkorTambahanD9_3', 'SkorTambahanD9_4', 'SkorTambahanD9_5',
                        'SkorTambahanJumlahD9', 'SkorTambahanJumlahSkorD9', 'SkorTambahanJumlahBobotSubItemD9',

                        'JumlahYangDihasilkanD10_3', 'JumlahYangDihasilkanD10_4', 'JumlahYangDihasilkanD10_5',
                        'JumlahSkorYangDiHasilkanD10', 'SkorTambahanD10_3', 'SkorTambahanD10_4', 'SkorTambahanD10_5',
                        'SkorTambahanJumlahD10', 'SkorTambahanJumlahSkorD10', 'SkorTambahanJumlahBobotSubItemD10',

                        'JumlahYangDihasilkanD11_3', 'JumlahYangDihasilkanD11_4', 'JumlahYangDihasilkanD11_5',
                        'JumlahSkorYangDiHasilkanD11', 'SkorTambahanD11_3', 'SkorTambahanD11_4', 'SkorTambahanD11_5',
                        'SkorTambahanJumlahD11', 'SkorTambahanJumlahSkorD11', 'SkorTambahanJumlahBobotSubItemD11',

                        // Hasil akhir
                        'TotalSkorUnsurPenunjang',
                        'TotalKelebihaD2', 'TotalKelebihaD3', 'TotalKelebihaD4', 'TotalKelebihaD5',
                        'TotalKelebihaD6', 'TotalKelebihaD7', 'TotalKelebihaD8', 'TotalKelebihaD9',
                        'TotalKelebihaD10', 'TotalKelebihaD11',
                        'TotalKelebihanSkor',
                        'NilaiUnsurPenunjang',
                        'NilaiTambahUnsurPenunjang',
                        'ResultSumNilaiTotalUnsurPenunjang'
                    ];

                    // Isi semua field
                    allNumberFieldsD.forEach(field => {
                        const el = document.getElementById(field);
                        if (el && initialDataD[field] !== undefined && initialDataD[field] !== null) {
                            el.value = initialDataD[field];
                            console.log(`Set ${field} to ${initialDataD[field]}`);
                        }
                    });

                    // 3. Isi hidden inputs untuk Livewire
                    syncDataToLivewirePointD();

                    // 4. Trigger calculation setelah semua data diisi
                    setTimeout(() => {
                        if (typeof sum === 'function') {
                            console.log('Triggering Point D calculation...');
                            sum();
                        }
                    }, 500);
                }

                // Fungsi untuk sync data dari display ke Livewire state untuk Point D
                function syncDataToLivewirePointD() {
                    console.log('Syncing Point D data to Livewire...');

                    const dataToSync = {};

                    // 1. Ambil semua radio buttons yang checked
                    for (let i = 1; i <= 11; i++) {
                        const radio = document.querySelector(`input[name="D${i}"]:checked`);
                        if (radio) {
                            dataToSync[`D${i}`] = radio.value;
                        }
                    }

                    // 2. Ambil semua input number di tabel Point D
                    const allInputs = document.querySelectorAll('.point-d-table input[type="number"]');
                    allInputs.forEach(input => {
                        if (input.id && input.id !== '') {
                            // Jika input kosong, set ke 0 (untuk field skor)
                            if (input.value === '' || input.value === null) {
                                if (input.id.startsWith('scor') ||
                                    input.id.startsWith('Total') ||
                                    input.id.startsWith('Nilai') ||
                                    input.id.startsWith('JumlahSkor') ||
                                    input.id.startsWith('SkorTambahan') ||
                                    input.id.startsWith('ResultSum')) {
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

                    console.log('Point D data synced to Livewire:', dataToSync);
                }

                // Override fungsi sum() untuk update Livewire state
                const originalSumPointD = window.sum;
                window.sum = function() {
                    // Panggil fungsi asli
                    if (typeof originalSumPointD === 'function') {
                        originalSumPointD();
                    }

                    // Sync ke Livewire setelah perhitungan
                    setTimeout(syncDataToLivewirePointD, 100);
                };

                // Event listener untuk semua input Point D
                document.addEventListener('DOMContentLoaded', function() {
                    console.log('DOM loaded, filling Point D form...');

                    // Isi form dengan data awal
                    fillFormPointD();

                    // Setup event listeners untuk semua input Point D
                    document.querySelectorAll('.point-d-table input').forEach(input => {
                        if (input.type === 'radio') {
                            input.addEventListener('change', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewirePointD();
                                }, 100);
                            });
                        }

                        if (input.type === 'number') {
                            input.addEventListener('input', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewirePointD();
                                }, 100);
                            });

                            input.addEventListener('change', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewirePointD();
                                }, 100);
                            });
                        }
                    });

                    // Setup khusus untuk JumlahYangDihasilkan fields
                    const jumlahFieldsD = [
                        // D.2
                        'JumlahYangDihasilkanD2_2', 'JumlahYangDihasilkanD2_3', 'JumlahYangDihasilkanD2_4', 'JumlahYangDihasilkanD2_5',
                        // D.3
                        'JumlahYangDihasilkanD3_2', 'JumlahYangDihasilkanD3_3', 'JumlahYangDihasilkanD3_4', 'JumlahYangDihasilkanD3_5',
                        // D.4
                        'JumlahYangDihasilkanD4_3', 'JumlahYangDihasilkanD4_4', 'JumlahYangDihasilkanD4_5',
                        // D.5
                        'JumlahYangDihasilkanD5_3', 'JumlahYangDihasilkanD5_4', 'JumlahYangDihasilkanD5_5',
                        // D.6
                        'JumlahYangDihasilkanD6_2', 'JumlahYangDihasilkanD6_3', 'JumlahYangDihasilkanD6_4', 'JumlahYangDihasilkanD6_5',
                        // D.7
                        'JumlahYangDihasilkanD7_5',
                        // D.8
                        'JumlahYangDihasilkanD8_3', 'JumlahYangDihasilkanD8_4', 'JumlahYangDihasilkanD8_5',
                        // D.9
                        'JumlahYangDihasilkanD9_2', 'JumlahYangDihasilkanD9_3', 'JumlahYangDihasilkanD9_4', 'JumlahYangDihasilkanD9_5',
                        // D.10
                        'JumlahYangDihasilkanD10_3', 'JumlahYangDihasilkanD10_4', 'JumlahYangDihasilkanD10_5',
                        // D.11
                        'JumlahYangDihasilkanD11_3', 'JumlahYangDihasilkanD11_4', 'JumlahYangDihasilkanD11_5'
                    ];

                    jumlahFieldsD.forEach(field => {
                        const el = document.getElementById(field);
                        if (el) {
                            el.addEventListener('input', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewirePointD();
                                }, 100);
                            });
                        }
                    });
                });

                async function handleSubmitPointD() {
                    // 1. Pastikan sync data terbaru
                    syncDataToLivewirePointD();

                    // 2. Validasi radio buttons
                    let isValid = true;
                    for (let i = 1; i <= 11; i++) {
                        if (!document.querySelector(`input[name="D${i}"]:checked`)) {
                            isValid = false;
                            await Swal.fire({
                                title: 'Perhatian',
                                text: `Harap pilih skor untuk item D.${i}`,
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            });
                            break;
                        }
                    }

                    if (!isValid) return;

                    // 3. Validasi file upload untuk D.11 (jika skor > 1)
                    // const d11Value = document.querySelector('input[name="D11"]:checked');
                    // if (d11Value && d11Value.value > 1) {
                    //     const fileD11 = document.querySelector('input[name="fileD11"]');
                    //     if (!fileD11 || !fileD11.files || fileD11.files.length === 0) {
                    //         await Swal.fire({
                    //             title: 'Perhatian',
                    //             text: 'Untuk skor D.11 lebih dari 1, harap upload Piagam Penghargaan atau SK yang menyertai',
                    //             icon: 'warning',
                    //             confirmButtonText: 'OK'
                    //         });
                    //         return;
                    //     }
                    // }

                    // 4. Konfirmasi
                    const result = await Swal.fire({
                        title: 'Simpan Data Point D?',
                        text: "Data Unsur Penunjang akan disimpan ke database.",
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
