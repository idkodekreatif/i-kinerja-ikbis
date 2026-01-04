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

            .point-b-table {
                font-size: 0.875rem;
                width: 100%;
                border-collapse: collapse;
                table-layout: auto;
                min-width: 1300px;
            }

            .point-b-table th,
            .point-b-table td {
                vertical-align: middle;
                padding: 0.75rem 0.5rem;
                border: 1px solid #e5e7eb;
                word-wrap: break-word;
            }

            /* Pengaturan Lebar Kolom Spesifik */
            .col-no { width: 40px; }
            .col-komponen { width: 250px; }
            .col-skor-radio { width: 45px; }
            .col-bukti { width: 300px; min-width: 300px; }
            .col-skor-kuning { width: 90px; min-width: 90px; }
            .col-skor-maks { width: 100px; min-width: 100px; }
            .col-skor-bobot { width: 120px; min-width: 120px; }

            .point-b-table .bg-warning {
                background-color: #fef3c7 !important;
            }

            .point-b-table input[type="radio"] {
                margin: 0 auto;
                display: block;
            }

            .point-b-table input[readonly] {
                background-color: #f3f4f6;
                font-weight: bold;
                width: 100%;
                text-align: center;
                border: none;
                padding: 0.5rem 0;
            }

            .point-b-table input[type="number"]:not([readonly]) {
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
                font-size: 0.75rem;
            }
        </style>
    @endpush

    <div class="space-y-6">
        @if($hasActivePeriod)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                            Form Point B - Penelitian dan Karya Ilmiah
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
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <form id="pointBForm" wire:submit.prevent="save" enctype="multipart/form-data">
                        <!-- Hidden inputs untuk Livewire -->
                        <input type="hidden" wire:model="data.user_id" id="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" wire:model="data.period_id" id="period_id">

                        <!-- Hidden inputs untuk B1-B18 -->
                        @for ($i = 1; $i <= 18; $i++)
                            <input type="hidden" wire:model="data.B{{ $i }}" id="hidden_B{{ $i }}">
                        @endfor

                        <!-- Hidden inputs untuk file -->
                        @for ($i = 1; $i <= 18; $i++)
                            <input type="hidden" wire:model="data.fileB{{ $i }}" id="hidden_fileB{{ $i }}">
                        @endfor

                        <!-- Hidden inputs untuk jumlah yang dihasilkan -->
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB1_2" id="hidden_JumlahYangDihasilkanB1_2">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB1_3" id="hidden_JumlahYangDihasilkanB1_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB1_4" id="hidden_JumlahYangDihasilkanB1_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB1_5" id="hidden_JumlahYangDihasilkanB1_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB2_4" id="hidden_JumlahYangDihasilkanB2_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB2_5" id="hidden_JumlahYangDihasilkanB2_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB3_4" id="hidden_JumlahYangDihasilkanB3_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB3_5" id="hidden_JumlahYangDihasilkanB3_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB5_5" id="hidden_JumlahYangDihasilkanB5_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB6_5" id="hidden_JumlahYangDihasilkanB6_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB7_5" id="hidden_JumlahYangDihasilkanB7_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB9_3" id="hidden_JumlahYangDihasilkanB9_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB9_5" id="hidden_JumlahYangDihasilkanB9_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB10_3" id="hidden_JumlahYangDihasilkanB10_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB10_5" id="hidden_JumlahYangDihasilkanB10_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB11_5" id="hidden_JumlahYangDihasilkanB11_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB12_5" id="hidden_JumlahYangDihasilkanB12_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB13_3" id="hidden_JumlahYangDihasilkanB13_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB13_4" id="hidden_JumlahYangDihasilkanB13_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB13_5" id="hidden_JumlahYangDihasilkanB13_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB14_2" id="hidden_JumlahYangDihasilkanB14_2">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB14_3" id="hidden_JumlahYangDihasilkanB14_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB14_4" id="hidden_JumlahYangDihasilkanB14_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB14_5" id="hidden_JumlahYangDihasilkanB14_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB15_3" id="hidden_JumlahYangDihasilkanB15_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB15_4" id="hidden_JumlahYangDihasilkanB15_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB15_5" id="hidden_JumlahYangDihasilkanB15_5">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB17_2" id="hidden_JumlahYangDihasilkanB17_2">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB17_3" id="hidden_JumlahYangDihasilkanB17_3">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB17_4" id="hidden_JumlahYangDihasilkanB17_4">
                        <input type="hidden" wire:model="data.JumlahYangDihasilkanB17_5" id="hidden_JumlahYangDihasilkanB17_5">

                        <!-- Hidden inputs untuk skor total -->
                        <input type="hidden" wire:model="data.TotalSkorPenelitianPointB" id="hidden_TotalSkorPenelitianPointB">
                        <input type="hidden" wire:model="data.TotalKelebihanSkor" id="hidden_TotalKelebihanSkor">
                        <input type="hidden" wire:model="data.NilaiPenelitian" id="hidden_NilaiPenelitian">
                        <input type="hidden" wire:model="data.NilaiTambahPenelitian" id="hidden_NilaiTambahPenelitian">
                        <input type="hidden" wire:model="data.NilaiTotalPenelitiandanKaryaIlmiah" id="hidden_NilaiTotalPenelitiandanKaryaIlmiah">

                        <div class="overflow-x-auto mb-6">
                            <table class="point-b-table">
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
                                        <td>B</td>
                                        <td colspan="10" class="text-left font-bold">PENELITIAN DAN KARYA ILMIAH</td>
                                    </tr>

                                    <!-- B.1 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Memiliki karya yang diakui di tingkat nasional (Hak Cipta Nasional)</td>
                                        <td class="text-xs">Memiliki karya yang diakui di tingkat Internasional (Hak Cipta internasional)</td>
                                        <td class="text-xs">Memiliki karya yang memiliki hak Paten Terdaftar</td>
                                        <td class="text-xs">Metode baru yang diusulkan telah disetujui dan diimplementasikan dalam PT / Fakultas / Prodinya</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload:<br>1. Sertifikat Hak Cipta<br>2. Formulir Pendaftaran Permohonan Paten<br>3. Sertifikat Hak Paten</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB1"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB1')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB1'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB1']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB1']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB1" id="scorB1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB1" id="scorMaxB1" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB1" id="scorSubItemB1" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.1</td>
                                        <td class="text-left">Dosen memiliki karya yang telah dipatenkan atau diakui secara nasional maupun internasional</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B1" id="B1_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B1 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB1_2" id="JumlahYangDihasilkanB1_2" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB1_3" id="JumlahYangDihasilkanB1_3" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB1_4" id="JumlahYangDihasilkanB1_4" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB1_5" id="JumlahYangDihasilkanB1_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB1" id="JumlahSkorYangDiHasilkanB1" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB1" id="SkorTambahanJumlahSkorB1" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB1_2" id="SkorTambahanB1_2" readonly></td>
                                        <td><input type="number" name="SkorTambahanB1_3" id="SkorTambahanB1_3" readonly></td>
                                        <td><input type="number" name="SkorTambahanB1_4" id="SkorTambahanB1_4" readonly></td>
                                        <td><input type="number" name="SkorTambahanB1_5" id="SkorTambahanB1_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB1" id="SkorTambahanJumlahB1" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB1" id="SkorTambahanJumlahBobotSubItemB1" readonly></td>
                                    </tr>

                                    <!-- B.2 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Dalam pertengahan proses pembuatan buku</td>
                                        <td class="text-xs">Dalam proses percetakan</td>
                                        <td class="text-xs">Diterbitkan dan diedarkan secara nasional</td>
                                        <td class="text-xs">Diterbitkan dan diedarkan secara Internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik monograf</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB2"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB2')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB2'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB2']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB2']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB2" id="scorB2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB2" id="scorMaxB2" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB2" id="scorSubItemB2" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.2</td>
                                        <td class="text-left">Dosen menghasilkan monograf yang relevan dengan bidang kelimuan</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B2" id="B2_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B2 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB2_4" id="JumlahYangDihasilkanB2_4" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB2_5" id="JumlahYangDihasilkanB2_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB2" id="JumlahSkorYangDiHasilkanB2" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB2" id="SkorTambahanJumlahSkorB2" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB2_4" id="SkorTambahanB2_4" readonly></td>
                                        <td><input type="number" name="SkorTambahanB2_5" id="SkorTambahanB2_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB2" id="SkorTambahanJumlahB2" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB2" id="SkorTambahanJumlahBobotSubItemB2" readonly></td>
                                    </tr>

                                    <!-- B.3 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Dalam pertengahan proses pembuatan buku</td>
                                        <td class="text-xs">Dalam proses percetakan</td>
                                        <td class="text-xs">Diterbitkan dan diedarkan secara nasional</td>
                                        <td class="text-xs">Diterbitkan dan diedarkan secara Internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik buku referensi</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB3"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB3')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB3'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB3']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB3']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB3" id="scorB3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB3" id="scorMaxB3" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB3" id="scorSubItemB3" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.3</td>
                                        <td class="text-left">Dosen menghasilkan buku referensi yang relevan dengan bidang keilmuan</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B3" id="B3_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B3 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB3_4" id="JumlahYangDihasilkanB3_4" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB3_5" id="JumlahYangDihasilkanB3_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB3" id="JumlahSkorYangDiHasilkanB3" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB3" id="SkorTambahanJumlahSkorB3" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB3_4" id="SkorTambahanB3_4" readonly></td>
                                        <td><input type="number" name="SkorTambahanB3_5" id="SkorTambahanB3_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB3" id="SkorTambahanJumlahB3" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB3" id="SkorTambahanJumlahBobotSubItemB3" readonly></td>
                                    </tr>

                                    <!-- B.4 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">satu kali sebagai anggota penulis</td>
                                        <td class="text-xs">Lebih dari 1 kali sebagai anggota penulis</td>
                                        <td class="text-xs">Satu kali sebagai penulis utama/tunggal</td>
                                        <td class="text-xs">Lebih dari satu kali sebagai penulis utama/tunggal</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik monograf/buku</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB4"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB4')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB4'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB4']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB4']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB4" id="scorB4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB4" id="scorMaxB4" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB4" id="scorSubItemB4" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.4</td>
                                        <td class="text-left">Peran Dosen sebagai Penulis Utama/tunggal, Monograf/Buku yang diterbitkan</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B4" id="B4_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B4 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- B.5 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">telah dikirimkan dan belum mendapat balasan / telah dikirimkan namun ditolak</td>
                                        <td class="text-xs">sedang dalam proses review redaksi</td>
                                        <td class="text-xs">sudah ada konfirmasi untuk dimuat / sedang dalam revisi</td>
                                        <td class="text-xs">telah dimuat dalam jurnal ilmiah internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik jurnal ilmiah internasional dan bukti penerimaan naskah</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB5"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB5')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB5'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB5']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB5']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB5" id="scorB5" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB5" id="scorMaxB5" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB5" id="scorSubItemB5" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.5</td>
                                        <td class="text-left">Dosen menulis artikel yang diterbitkan dalam Jurnal Ilmiah Internasional</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B5" id="B5_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B5 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB5_5" id="JumlahYangDihasilkanB5_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB5" id="JumlahSkorYangDiHasilkanB5" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB5" id="SkorTambahanJumlahSkorB5" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB5_5" id="SkorTambahanB5_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB5" id="SkorTambahanJumlahB5" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB5" id="SkorTambahanJumlahBobotSubItemB5" readonly></td>
                                    </tr>

                                    <!-- B.6 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">telah dikirimkan dan belum mendapat balasan / telah dikirimkan namun ditolak</td>
                                        <td class="text-xs">sedang dalam proses review redaksi</td>
                                        <td class="text-xs">sudah ada konfirmasi untuk dimuat / sedang dalam revisi</td>
                                        <td class="text-xs">telah dimuat dalam jurnal ilmiah nasional terakreditasi</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik jurnal ilmiah nasional terakreditasi dan bukti penerimaan naskah</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB6"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB6')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB6'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB6']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB6']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB6" id="scorB6" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB6" id="scorMaxB6" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB6" id="scorSubItemB6" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.6</td>
                                        <td class="text-left">Dosen menulis artikel yang diterbitkan dalam Jurnal Ilmiah nasional terakreditasi</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B6" id="B6_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B6 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB6_5" id="JumlahYangDihasilkanB6_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB6" id="JumlahSkorYangDiHasilkanB6" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB6" id="SkorTambahanJumlahSkorB6" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB6_5" id="SkorTambahanB6_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB6" id="SkorTambahanJumlahB6" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB6" id="SkorTambahanJumlahBobotSubItemB6" readonly></td>
                                    </tr>

                                    <!-- B.7 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">telah dikirimkan dan belum mendapat balasan / telah dikirimkan namun ditolak</td>
                                        <td class="text-xs">sudah ada konfirmasi/sedang dalam revisi</td>
                                        <td class="text-xs">1 - 2 karya dimuat dalam jurnal ilmiah nasional tidak terakreditasi</td>
                                        <td class="text-xs">3 karya dimuat dalam jurnal ilmiah tidak terakreditasi</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik jurnal ilmiah nasional tidak terakreditasi dan bukti penerimaan naskah</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB7"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB7')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB7'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB7']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB7']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB7" id="scorB7" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB7" id="scorMaxB7" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB7" id="scorSubItemB7" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.7</td>
                                        <td class="text-left">Dosen menulis artikel yang diterbitkan dalam Jurnal Ilmiah Nasional tidak terakreditasi / Jurnal Ilmiah Nasional ber-ISSN</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B7" id="B7_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B7 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah kelebihan karya artikel (>3 karya)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB7_5" id="JumlahYangDihasilkanB7_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB7" id="JumlahSkorYangDiHasilkanB7" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB7" id="SkorTambahanJumlahSkorB7" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB7_5" id="SkorTambahanB7_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB7" id="SkorTambahanJumlahB7" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB7" id="SkorTambahanJumlahBobotSubItemB7" readonly></td>
                                    </tr>

                                    <!-- B.8 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">satu kali sebagai anggota penulis</td>
                                        <td class="text-xs">Lebih dari 1 kali sebagai anggota penulis</td>
                                        <td class="text-xs">Satu kali sebagai penulis utama/tunggal</td>
                                        <td class="text-xs">Lebih dari satu kali sebagai penulis utama/tunggal</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik jurnal</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB8"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB8')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB8'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB8']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB8']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB8" id="scorB8" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB8" id="scorMaxB8" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB8" id="scorSubItemB8" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.8</td>
                                        <td class="text-left">Peran Dosen sebagai Penulis Utama/tunggal, dari jurnal yang diterbitkan</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B8" id="B8_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B8 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- B.9 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">makalah telah ditampilkan namun belum ada bukti berupa prosiding/tidak dimuat dalam prosiding</td>
                                        <td class="text-xs">makalah tidak ditampilkan namun dimuat dalam prosiding yang dipublikasikan</td>
                                        <td class="text-xs">makalah telah ditampilkan dan bukti sertifikat maupun prosiding telah diterima lengkap, jumlah makalah = 1</td>
                                        <td class="text-xs">makalah telah ditampilkan dan bukti sertifikat maupun prosiding telah diterima lengkap, jumlah makalah = 2</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik sertifikat dan prosiding seminar</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB9"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB9')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB9'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB9']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB9']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB9" id="scorB9" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB9" id="scorMaxB9" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB9" id="scorSubItemB9" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.9</td>
                                        <td class="text-left">Dosen membuat makalah dipresentasikan dalam seminar dan dimuat dalam prosiding internasional</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B9" id="B9_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B9 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah kelebihan karya makalah (>2 makalah)</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB9_3" id="JumlahYangDihasilkanB9_3" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB9_5" id="JumlahYangDihasilkanB9_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB9" id="JumlahSkorYangDiHasilkanB9" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB9" id="SkorTambahanJumlahSkorB9" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB9_3" id="SkorTambahanB9_3" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB9_5" id="SkorTambahanB9_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB9" id="SkorTambahanJumlahB9" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB9" id="SkorTambahanJumlahBobotSubItemB9" readonly></td>
                                    </tr>

                                    <!-- B.10 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">makalah telah ditampilkan namun belum ada bukti berupa prosiding/tidak dimuat dalam prosiding</td>
                                        <td class="text-xs">makalah tidak ditampilkan namun dimuat dalam prosiding yang dipublikasikan</td>
                                        <td class="text-xs">makalah telah ditampilkan dan bukti sertifikat maupun prosiding telah diterima lengkap, jumlah makalah = 1 -2</td>
                                        <td class="text-xs">makalah telah ditampilkan dan bukti sertifikat maupun prosiding telah diterima lengkap, jumlah makalah 3 - 4</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik sertifikat dan prosiding seminar</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB10"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB10')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB10'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB10']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB10']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB10" id="scorB10" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB10" id="scorMaxB10" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB10" id="scorSubItemB10" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.10</td>
                                        <td class="text-left">Dosen membuat makalah dipresentasikan dalam seminar dan dimuat dalam prosiding nasional/lokal</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B10" id="B10_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B10 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah kelebihan karya makalah (>4 makalah)</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB10_3" id="JumlahYangDihasilkanB10_3" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB10_5" id="JumlahYangDihasilkanB10_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB10" id="JumlahSkorYangDiHasilkanB10" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB10" id="SkorTambahanJumlahSkorB10" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB10_3" id="SkorTambahanB10_3" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB10_5" id="SkorTambahanB10_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB10" id="SkorTambahanJumlahB10" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB10" id="SkorTambahanJumlahBobotSubItemB10" readonly></td>
                                    </tr>

                                    <!-- B.11 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">poster telah mendapat konfirmasi untuk ditampilkan dalam seminar internasional</td>
                                        <td class="text-xs">poster telah ditampilkan namun belum ada bukti sertifikatnya</td>
                                        <td class="text-xs">poster telah ditampilkan dan bukti sertifiakat telah diterima lengkap, jumlah poster = 1</td>
                                        <td class="text-xs">poster telah ditampilkan dan bukti sertifikat telah diterima lengkap, jumlah poster = 2</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik sertifikat dan prosiding seminar</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB11"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB11')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB11'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB11']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB11']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB11" id="scorB11" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB11" id="scorMaxB11" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB11" id="scorSubItemB11" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.11</td>
                                        <td class="text-left">Dosen membuat POSTER dipresentasikan dalam seminar dan prosiding internasional</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B11" id="B11_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B11 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah kelebihan karya poster (>2 poster)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB11_5" id="JumlahYangDihasilkanB11_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB11" id="JumlahSkorYangDiHasilkanB11" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB11" id="SkorTambahanJumlahSkorB11" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB11_5" id="SkorTambahanB11_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB11" id="SkorTambahanJumlahB11" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB11" id="SkorTambahanJumlahBobotSubItemB11" readonly></td>
                                    </tr>

                                    <!-- B.12 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">poster telah mendapat konfirmasi untuk ditampilkan dalam seminar internasional</td>
                                        <td class="text-xs">poster telah ditampilkan namun belum ada bukti sertifikatnya</td>
                                        <td class="text-xs">poster telah ditampilkan dan bukti sertifikat telah diterima lengkap, jumlah poster 1 - 2</td>
                                        <td class="text-xs">poster telah ditampilkan dan bukti sertifiakat telah diterima lengkap, jumlah poster 3 - 4</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik sertifikat dan prosiding seminar</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB12"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB12')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB12'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB12']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB12']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB12" id="scorB12" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB12" id="scorMaxB12" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB12" id="scorSubItemB12" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.12</td>
                                        <td class="text-left">Dosen membuat POSTER dipresentasikan dalam seminar dan prosiding Nasional</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B12" id="B12_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B12 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah kelebihan karya poster (>4 poster)</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB12_5" id="JumlahYangDihasilkanB12_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB12" id="JumlahSkorYangDiHasilkanB12" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB12" id="SkorTambahanJumlahSkorB12" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB12_5" id="SkorTambahanB12_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB12" id="SkorTambahanJumlahB12" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB12" id="SkorTambahanJumlahBobotSubItemB12" readonly></td>
                                    </tr>

                                    <!-- B.13 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Opini sudah dikonfirmasi untuk diterbitkan</td>
                                        <td class="text-xs">Opini telah diterbitkan dalam koran/majalah lokal</td>
                                        <td class="text-xs">Opini telah diterbitkan dalam koran/majalah nasional</td>
                                        <td class="text-xs">Opini telah diterbitkan dalam koran/majalah internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik koran/majalah populer/umum</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB13"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB13')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB13'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB13']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB13']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB13" id="scorB13" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB13" id="scorMaxB13" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB13" id="scorSubItemB13" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.13</td>
                                        <td class="text-left">Dosen menulis opini dalam Koran/Majalah populer / umum</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B13" id="B13_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B13 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB13_3" id="JumlahYangDihasilkanB13_3" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB13_4" id="JumlahYangDihasilkanB13_4" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB13_5" id="JumlahYangDihasilkanB13_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB13" id="JumlahSkorYangDiHasilkanB13" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB13" id="SkorTambahanJumlahSkorB13" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB13_3" id="SkorTambahanB13_3" readonly></td>
                                        <td><input type="number" name="SkorTambahanB13_4" id="SkorTambahanB13_4" readonly></td>
                                        <td><input type="number" name="SkorTambahanB13_5" id="SkorTambahanB13_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB13" id="SkorTambahanJumlahB13" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB13" id="SkorTambahanJumlahBobotSubItemB13" readonly></td>
                                    </tr>

                                    <!-- B.14 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Hasil penelitian digunakan untuk kepentingan internal Institusi</td>
                                        <td class="text-xs">Hasil penelitian digunakan untuk kepentingan lokal (kota/kabupaten)</td>
                                        <td class="text-xs">Hasil penelitian digunakan untuk kepentingan nasional</td>
                                        <td class="text-xs">Hasil penelitian/pemikiran digunakan untuk kepentingan internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik buku yang telah disimpan di Perpustakaan PT</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB14"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB14')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB14'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB14']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB14']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB14" id="scorB14" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB14" id="scorMaxB14" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB14" id="scorSubItemB14" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.14</td>
                                        <td class="text-left">Dosen menghasilkan penelitian/pemikiran yang tidak dipublikasikan, tapi digunakan untuk kepentingan tertentu (dibukukan dan disimpan dalam perpustakaan PT)</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B14" id="B14_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B14 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB14_2" id="JumlahYangDihasilkanB14_2" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB14_3" id="JumlahYangDihasilkanB14_3" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB14_4" id="JumlahYangDihasilkanB14_4" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB14_5" id="JumlahYangDihasilkanB14_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB14" id="JumlahSkorYangDiHasilkanB14" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB14" id="SkorTambahanJumlahSkorB14" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB14_2" id="SkorTambahanB14_2" readonly></td>
                                        <td><input type="number" name="SkorTambahanB14_3" id="SkorTambahanB14_3" readonly></td>
                                        <td><input type="number" name="SkorTambahanB14_4" id="SkorTambahanB14_4" readonly></td>
                                        <td><input type="number" name="SkorTambahanB14_5" id="SkorTambahanB14_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB14" id="SkorTambahanJumlahB14" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB14" id="SkorTambahanJumlahBobotSubItemB14" readonly></td>
                                    </tr>

                                    <!-- B.15 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Pernah membuat proposal penelitian yang ditolak/tidak mendapatkan pendanaan, dalam 1 tahun penilaian</td>
                                        <td class="text-xs">Proposal penelitian dengan dana hibah lokal/Institusi</td>
                                        <td class="text-xs">Proposal penelitian dengan dana hibah nasional (DIKTI/BRIN/dll)</td>
                                        <td class="text-xs">Proposal penelitian dengan dana hibah internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik proposal dan bukti fisik surat/surel penerimaan proposal</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB15"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB15')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB15'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB15']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB15']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB15" id="scorB15" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB15" id="scorMaxB15" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB15" id="scorSubItemB15" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.15</td>
                                        <td class="text-left">Dosen membuat proposal penelitian, karya/desain teknologi, seni dan sastra dengan dana hibah</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B15" id="B15_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B15 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB15_3" id="JumlahYangDihasilkanB15_3" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB15_4" id="JumlahYangDihasilkanB15_4" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB15_5" id="JumlahYangDihasilkanB15_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB15" id="JumlahSkorYangDiHasilkanB15" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB15" id="SkorTambahanJumlahSkorB15" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB15_3" id="SkorTambahanB15_3" readonly></td>
                                        <td><input type="number" name="SkorTambahanB15_4" id="SkorTambahanB15_4" readonly></td>
                                        <td><input type="number" name="SkorTambahanB15_5" id="SkorTambahanB15_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB15" id="SkorTambahanJumlahB15" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB15" id="SkorTambahanJumlahBobotSubItemB15" readonly></td>
                                    </tr>

                                    <!-- B.16 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">satu kali sebagai anggota penulis</td>
                                        <td class="text-xs">Lebih dari 1 kali sebagai anggota penulis</td>
                                        <td class="text-xs">Satu kali sebagai penulis utama/tunggal</td>
                                        <td class="text-xs">lebih dari 1 kali sebagai penulis utama/tunggal</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik proposal dan bukti fisik surat/surel penerimaan proposal</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB16"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB16')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB16'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB16']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB16']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB16" id="scorB16" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB16" id="scorMaxB16" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB16" id="scorSubItemB16" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.16</td>
                                        <td class="text-left">Peran Dosen dlm pembuatan proposal penelitian, karya/disain teknologi, seni dan sastra</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B16" id="B16_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B16 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- B.17 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">Dosen sedang melaksanakan penelitian dengan dana pribadi</td>
                                        <td class="text-xs">Dosen sedang melaksanakan penelitian dengan dana hibah lokal/IKBIS</td>
                                        <td class="text-xs">Dosen sedang melaksanakan penelitian dengan dana hibah nasional</td>
                                        <td class="text-xs">Dosen sedang melaksanakan penelitian dengan dana hibah internasional</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik surat kontrak penelitian/surat penerimaan dana hibah, dan jurnal penelitian</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB17"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB17')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB17'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB17']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB17']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB17" id="scorB17" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB17" id="scorMaxB17" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB17" id="scorSubItemB17" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.17</td>
                                        <td class="text-left">Dosen melakukan penelitian dengan dana hibah</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B17" id="B17_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B17 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td class="text-left">Jumlah yang dihasilkan</td>
                                        <td></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB17_2" id="JumlahYangDihasilkanB17_2" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB17_3" id="JumlahYangDihasilkanB17_3" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB17_4" id="JumlahYangDihasilkanB17_4" onkeyup="sum()" placeholder="0"></td>
                                        <td><input type="number" name="JumlahYangDihasilkanB17_5" id="JumlahYangDihasilkanB17_5" onkeyup="sum()" placeholder="0"></td>
                                        <td></td>
                                        <td class="bg-warning"><input type="number" name="JumlahSkorYangDiHasilkanB17" id="JumlahSkorYangDiHasilkanB17" readonly></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahSkorB17" id="SkorTambahanJumlahSkorB17" readonly></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Skor Tambahan dari Jumlah</td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanB17_2" id="SkorTambahanB17_2" readonly></td>
                                        <td><input type="number" name="SkorTambahanB17_3" id="SkorTambahanB17_3" readonly></td>
                                        <td><input type="number" name="SkorTambahanB17_4" id="SkorTambahanB17_4" readonly></td>
                                        <td><input type="number" name="SkorTambahanB17_5" id="SkorTambahanB17_5" readonly></td>
                                        <td><input type="number" name="SkorTambahanJumlahB17" id="SkorTambahanJumlahB17" readonly></td>
                                        <td class="bg-warning"></td>
                                        <td></td>
                                        <td><input type="number" name="SkorTambahanJumlahBobotSubItemB17" id="SkorTambahanJumlahBobotSubItemB17" readonly></td>
                                    </tr>

                                    <!-- B.18 -->
                                    <tr>
                                        <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                        <td class="text-xs">Tidak sama sekali</td>
                                        <td class="text-xs">satu kali sebagai anggota penulis</td>
                                        <td class="text-xs">Lebih dari 1 kali sebagai anggota penulis</td>
                                        <td class="text-xs">Satu kali sebagai penulis utama/tunggal</td>
                                        <td class="text-xs">lebih dari 1 kali sebagai penulis utama/tunggal</td>
                                        <td rowspan="2">
                                            <label class="form-label text-danger">* Upload Bukti fisik proposal dan bukti fisik surat/surel penerimaan proposal</label>
                                            <div class="file-upload-container">
                                                <input type="file" wire:model="fileB18"
                                                    class="w-full text-xs border-gray-300 rounded-md"
                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                @error('fileB18')
                                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                                @enderror
                                                @if($this->data['fileB18'] ?? false)
                                                    <div class="mt-1 text-xs text-green-600">
                                                        File sudah diupload: {{ basename($this->data['fileB18']) }}
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ Storage::url($this->data['fileB18']) }}"
                                                            target="_blank"
                                                            class="text-blue-600 hover:text-blue-800 text-xs">
                                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td rowspan="2" class="bg-warning">
                                            <input type="number" name="scorB18" id="scorB18" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorMaxB18" id="scorMaxB18" readonly>
                                        </td>
                                        <td rowspan="2">
                                            <input type="number" name="scorSubItemB18" id="scorSubItemB18" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B.18</td>
                                        <td class="text-left">Peran Dosen dalam penelitian</td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <td>
                                                <input type="radio" name="B18" id="B18_{{ $i }}"
                                                    value="{{ $i }}" onclick="sum()" class="B18 h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>

                                    <!-- Summary Section -->
                                    <tr>
                                        <td colspan="5"></td>
                                        <td colspan="5" class="font-bold">Total Skor Penelitian</td>
                                        <td>
                                            <input type="number" name="TotalSkorPenelitianPointB"
                                                id="TotalSkorPenelitianPointB" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 1</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB1" id="TotalKelebihaB1"
                                                readonly class="w-full text-center">
                                        </td>
                                        <td colspan="3" rowspan="7" class="font-bold">Nilai Penelitian</td>
                                        <td rowspan="7">
                                            <input type="number" name="NilaiPenelitian" id="NilaiPenelitian"
                                                readonly class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 2</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB2" id="TotalKelebihaB2"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 3</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB3" id="TotalKelebihaB3"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 5</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB5" id="TotalKelebihaB5"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 6</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB6" id="TotalKelebihaB6"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 7</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB7" id="TotalKelebihaB7"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 9</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB9" id="TotalKelebihaB9"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 10</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB10" id="TotalKelebihaB10"
                                                readonly class="w-full text-center">
                                        </td>
                                        <td colspan="3" rowspan="8" class="font-bold">Nilai Tambah Penelitian</td>
                                        <td rowspan="8">
                                            <input type="number" name="NilaiTambahPenelitian"
                                                id="NilaiTambahPenelitian" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 11</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB11" id="TotalKelebihaB11"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 12</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB12" id="TotalKelebihaB12"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 13</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB13" id="TotalKelebihaB13"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 14</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB14" id="TotalKelebihaB14"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 15</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB15" id="TotalKelebihaB15"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor No. 17</td>
                                        <td>
                                            <input type="number" name="TotalKelebihaB17" id="TotalKelebihaB17"
                                                readonly class="w-full text-center">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2" class="font-bold">Total Kelebihan Skor</td>
                                        <td>
                                            <input type="number" name="TotalKelebihanSkor" id="TotalKelebihanSkor"
                                                readonly class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="6" class="font-bold">Nilai Total Penelitian & Karya Ilmiah</td>
                                        <td>
                                            <input type="number" name="NilaiTotalPenelitiandanKaryaIlmiah"
                                                id="NilaiTotalPenelitiandanKaryaIlmiah" readonly
                                                class="w-full text-center font-bold">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="handleSubmitB()"
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
        @if($hasActivePeriod)
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="{{ asset('js/penilaian/itikad/point-b-calculations.js') }}"></script>

            <script>
                // Ambil data awal dari PHP
                const initialData = @json($this->formDataForJS);

                function fillFormB() {
                    if (!initialData || Object.keys(initialData).length === 0) return;

                    // 1. Isi Radio Buttons B1-B18
                    for (let i = 1; i <= 18; i++) {
                        const val = initialData[`B${i}`];
                        if (val !== undefined && val !== null) {
                            const radio = document.querySelector(`input[name="B${i}"][value="${val}"]`);
                            if (radio) {
                                radio.checked = true;
                            }
                        }
                    }

                    // 2. Isi semua input number
                    const allNumberFields = [
                        // Skor utama B1-B18
                        'scorB1', 'scorB2', 'scorB3', 'scorB4', 'scorB5', 'scorB6', 'scorB7', 'scorB8',
                        'scorB9', 'scorB10', 'scorB11', 'scorB12', 'scorB13', 'scorB14', 'scorB15', 'scorB16', 'scorB17', 'scorB18',
                        'scorMaxB1', 'scorMaxB2', 'scorMaxB3', 'scorMaxB4', 'scorMaxB5', 'scorMaxB6', 'scorMaxB7', 'scorMaxB8',
                        'scorMaxB9', 'scorMaxB10', 'scorMaxB11', 'scorMaxB12', 'scorMaxB13', 'scorMaxB14', 'scorMaxB15', 'scorMaxB16', 'scorMaxB17', 'scorMaxB18',
                        'scorSubItemB1', 'scorSubItemB2', 'scorSubItemB3', 'scorSubItemB4', 'scorSubItemB5',
                        'scorSubItemB6', 'scorSubItemB7', 'scorSubItemB8', 'scorSubItemB9', 'scorSubItemB10',
                        'scorSubItemB11', 'scorSubItemB12', 'scorSubItemB13', 'scorSubItemB14', 'scorSubItemB15',
                        'scorSubItemB16', 'scorSubItemB17', 'scorSubItemB18',

                        // Jumlah yang dihasilkan
                        'JumlahYangDihasilkanB1_2', 'JumlahYangDihasilkanB1_3', 'JumlahYangDihasilkanB1_4', 'JumlahYangDihasilkanB1_5',
                        'JumlahYangDihasilkanB2_4', 'JumlahYangDihasilkanB2_5',
                        'JumlahYangDihasilkanB3_4', 'JumlahYangDihasilkanB3_5',
                        'JumlahYangDihasilkanB5_5',
                        'JumlahYangDihasilkanB6_5',
                        'JumlahYangDihasilkanB7_5',
                        'JumlahYangDihasilkanB9_3', 'JumlahYangDihasilkanB9_5',
                        'JumlahYangDihasilkanB10_3', 'JumlahYangDihasilkanB10_5',
                        'JumlahYangDihasilkanB11_5',
                        'JumlahYangDihasilkanB12_5',
                        'JumlahYangDihasilkanB13_3', 'JumlahYangDihasilkanB13_4', 'JumlahYangDihasilkanB13_5',
                        'JumlahYangDihasilkanB14_2', 'JumlahYangDihasilkanB14_3', 'JumlahYangDihasilkanB14_4', 'JumlahYangDihasilkanB14_5',
                        'JumlahYangDihasilkanB15_3', 'JumlahYangDihasilkanB15_4', 'JumlahYangDihasilkanB15_5',
                        'JumlahYangDihasilkanB17_2', 'JumlahYangDihasilkanB17_3', 'JumlahYangDihasilkanB17_4', 'JumlahYangDihasilkanB17_5',

                        // Skor tambahan
                        'JumlahSkorYangDiHasilkanB1', 'JumlahSkorYangDiHasilkanB2', 'JumlahSkorYangDiHasilkanB3',
                        'JumlahSkorYangDiHasilkanB5', 'JumlahSkorYangDiHasilkanB6', 'JumlahSkorYangDiHasilkanB7',
                        'JumlahSkorYangDiHasilkanB9', 'JumlahSkorYangDiHasilkanB10', 'JumlahSkorYangDiHasilkanB11',
                        'JumlahSkorYangDiHasilkanB12', 'JumlahSkorYangDiHasilkanB13', 'JumlahSkorYangDiHasilkanB14',
                        'JumlahSkorYangDiHasilkanB15', 'JumlahSkorYangDiHasilkanB17',

                        'SkorTambahanB1_2', 'SkorTambahanB1_3', 'SkorTambahanB1_4', 'SkorTambahanB1_5',
                        'SkorTambahanB2_4', 'SkorTambahanB2_5',
                        'SkorTambahanB3_4', 'SkorTambahanB3_5',
                        'SkorTambahanB5_5',
                        'SkorTambahanB6_5',
                        'SkorTambahanB7_5',
                        'SkorTambahanB9_3', 'SkorTambahanB9_5',
                        'SkorTambahanB10_3', 'SkorTambahanB10_5',
                        'SkorTambahanB11_5',
                        'SkorTambahanB12_5',
                        'SkorTambahanB13_3', 'SkorTambahanB13_4', 'SkorTambahanB13_5',
                        'SkorTambahanB14_2', 'SkorTambahanB14_3', 'SkorTambahanB14_4', 'SkorTambahanB14_5',
                        'SkorTambahanB15_3', 'SkorTambahanB15_4', 'SkorTambahanB15_5',
                        'SkorTambahanB17_2', 'SkorTambahanB17_3', 'SkorTambahanB17_4', 'SkorTambahanB17_5',

                        'SkorTambahanJumlahB1', 'SkorTambahanJumlahB2', 'SkorTambahanJumlahB3',
                        'SkorTambahanJumlahB5', 'SkorTambahanJumlahB6', 'SkorTambahanJumlahB7',
                        'SkorTambahanJumlahB9', 'SkorTambahanJumlahB10', 'SkorTambahanJumlahB11',
                        'SkorTambahanJumlahB12', 'SkorTambahanJumlahB13', 'SkorTambahanJumlahB14',
                        'SkorTambahanJumlahB15', 'SkorTambahanJumlahB17',

                        'SkorTambahanJumlahSkorB1', 'SkorTambahanJumlahSkorB2', 'SkorTambahanJumlahSkorB3',
                        'SkorTambahanJumlahSkorB5', 'SkorTambahanJumlahSkorB6', 'SkorTambahanJumlahSkorB7',
                        'SkorTambahanJumlahSkorB9', 'SkorTambahanJumlahSkorB10', 'SkorTambahanJumlahSkorB11',
                        'SkorTambahanJumlahSkorB12', 'SkorTambahanJumlahSkorB13', 'SkorTambahanJumlahSkorB14',
                        'SkorTambahanJumlahSkorB15', 'SkorTambahanJumlahSkorB17',

                        'SkorTambahanJumlahBobotSubItemB1', 'SkorTambahanJumlahBobotSubItemB2', 'SkorTambahanJumlahBobotSubItemB3',
                        'SkorTambahanJumlahBobotSubItemB5', 'SkorTambahanJumlahBobotSubItemB6', 'SkorTambahanJumlahBobotSubItemB7',
                        'SkorTambahanJumlahBobotSubItemB9', 'SkorTambahanJumlahBobotSubItemB10', 'SkorTambahanJumlahBobotSubItemB11',
                        'SkorTambahanJumlahBobotSubItemB12', 'SkorTambahanJumlahBobotSubItemB13', 'SkorTambahanJumlahBobotSubItemB14',
                        'SkorTambahanJumlahBobotSubItemB15', 'SkorTambahanJumlahBobotSubItemB17',

                        // Total
                        'TotalSkorPenelitianPointB',
                        'TotalKelebihaB1', 'TotalKelebihaB2', 'TotalKelebihaB3', 'TotalKelebihaB5',
                        'TotalKelebihaB6', 'TotalKelebihaB7', 'TotalKelebihaB9', 'TotalKelebihaB10',
                        'TotalKelebihaB11', 'TotalKelebihaB12', 'TotalKelebihaB13', 'TotalKelebihaB14',
                        'TotalKelebihaB15', 'TotalKelebihaB17',
                        'TotalKelebihanSkor',
                        'NilaiPenelitian',
                        'NilaiTambahPenelitian',
                        'NilaiTotalPenelitiandanKaryaIlmiah'
                    ];

                    allNumberFields.forEach(field => {
                        const el = document.getElementById(field);
                        if (el && initialData[field] !== undefined && initialData[field] !== null) {
                            el.value = initialData[field];
                        }
                    });

                    // 3. Isi hidden inputs untuk Livewire
                    syncDataToLivewireB();

                    // 4. Trigger calculation
                    setTimeout(() => {
                        if (typeof sum === 'function') {
                            sum();
                        }
                    }, 500);
                }

                function syncDataToLivewireB() {
                    const dataToSync = {};

                    // 1. Ambil semua radio buttons yang checked
                    for (let i = 1; i <= 18; i++) {
                        const radio = document.querySelector(`input[name="B${i}"]:checked`);
                        if (radio) {
                            dataToSync[`B${i}`] = radio.value;
                        }
                    }

                    // 2. Ambil semua input number di tabel
                    const allInputs = document.querySelectorAll('.point-b-table input[type="number"]');
                    allInputs.forEach(input => {
                        if (input.id && input.id !== '') {
                            if (input.value === '' || input.value === null) {
                                if (input.id.startsWith('scor') ||
                                    input.id.startsWith('Total') ||
                                    input.id.startsWith('Nilai') ||
                                    input.id.startsWith('JumlahSkor') ||
                                    input.id.startsWith('SkorTambahan') ||
                                    input.id.startsWith('JumlahYangDihasilkan')) {
                                    dataToSync[input.id] = 0;
                                    input.value = 0;
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
                }

                // Override fungsi sum() untuk update Livewire state
                const originalSumB = window.sum;
                window.sum = function() {
                    if (typeof originalSumB === 'function') {
                        originalSumB();
                    }
                    setTimeout(syncDataToLivewireB, 100);
                };

                // Event listener untuk semua input
                document.addEventListener('DOMContentLoaded', function() {
                    fillFormB();

                    document.querySelectorAll('.point-b-table input').forEach(input => {
                        if (input.type === 'radio') {
                            input.addEventListener('change', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewireB();
                                }, 100);
                            });
                        }

                        if (input.type === 'number') {
                            input.addEventListener('input', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewireB();
                                }, 100);
                            });

                            input.addEventListener('change', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewireB();
                                }, 100);
                            });
                        }
                    });

                    // Setup khusus untuk JumlahYangDihasilkan fields
                    const jumlahFields = [
                        'JumlahYangDihasilkanB1_2', 'JumlahYangDihasilkanB1_3', 'JumlahYangDihasilkanB1_4', 'JumlahYangDihasilkanB1_5',
                        'JumlahYangDihasilkanB2_4', 'JumlahYangDihasilkanB2_5',
                        'JumlahYangDihasilkanB3_4', 'JumlahYangDihasilkanB3_5',
                        'JumlahYangDihasilkanB5_5',
                        'JumlahYangDihasilkanB6_5',
                        'JumlahYangDihasilkanB7_5',
                        'JumlahYangDihasilkanB9_3', 'JumlahYangDihasilkanB9_5',
                        'JumlahYangDihasilkanB10_3', 'JumlahYangDihasilkanB10_5',
                        'JumlahYangDihasilkanB11_5',
                        'JumlahYangDihasilkanB12_5',
                        'JumlahYangDihasilkanB13_3', 'JumlahYangDihasilkanB13_4', 'JumlahYangDihasilkanB13_5',
                        'JumlahYangDihasilkanB14_2', 'JumlahYangDihasilkanB14_3', 'JumlahYangDihasilkanB14_4', 'JumlahYangDihasilkanB14_5',
                        'JumlahYangDihasilkanB15_3', 'JumlahYangDihasilkanB15_4', 'JumlahYangDihasilkanB15_5',
                        'JumlahYangDihasilkanB17_2', 'JumlahYangDihasilkanB17_3', 'JumlahYangDihasilkanB17_4', 'JumlahYangDihasilkanB17_5'
                    ];

                    jumlahFields.forEach(field => {
                        const el = document.getElementById(field);
                        if (el) {
                            el.addEventListener('input', function() {
                                setTimeout(() => {
                                    if (typeof sum === 'function') sum();
                                    syncDataToLivewireB();
                                }, 100);
                            });
                        }
                    });
                });

                async function handleSubmitB() {
                    // 1. Pastikan sync data terbaru
                    syncDataToLivewireB();

                    // 2. Validasi radio buttons
                    let isValid = true;
                    for (let i = 1; i <= 18; i++) {
                        if (!document.querySelector(`input[name="B${i}"]:checked`)) {
                            isValid = false;
                            await Swal.fire({
                                title: 'Perhatian',
                                text: `Harap pilih skor untuk item B.${i}`,
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            });
                            break;
                        }
                    }

                    if (!isValid) return;

                    // 3. Konfirmasi
                    const result = await Swal.fire({
                        title: 'Simpan Data?',
                        text: "Data akan disimpan ke database.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Simpan',
                        cancelButtonText: 'Batal'
                    });

                    if (result.isConfirmed) {
                        @this.save();
                    }
                }
            </script>
        @endif
    @endpush
</x-filament-panels::page>
