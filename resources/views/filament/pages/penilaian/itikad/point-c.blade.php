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

        .point-c-table {
            font-size: 0.875rem;
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            min-width: 1500px;
        }

        .point-c-table th,
        .point-c-table td {
            vertical-align: middle;
            padding: 0.75rem 0.5rem;
            border: 1px solid #e5e7eb;
            word-wrap: break-word;
        }

        .point-c-table .bg-warning {
            background-color: #fef3c7 !important;
        }

        .point-c-table input[type="radio"] {
            margin: 0 auto;
            display: block;
        }

        .point-c-table input[readonly] {
            background-color: #f3f4f6;
            font-weight: bold;
            width: 100%;
            text-align: center;
            border: none;
            padding: 0.5rem 0;
        }

        .point-c-table input[type="number"]:not([readonly]) {
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

        .text-small {
            font-size: 0.75rem;
            line-height: 1.2;
        }
    </style>
    @endpush

    <div class="space-y-6">
        @if($hasActivePeriod)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        Form Point C - Pengabdian Kepada Masyarakat
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
                <form id="pointCForm" wire:submit.prevent="save" enctype="multipart/form-data">
                    <!-- Hidden inputs untuk data yang akan diisi JavaScript -->
                    <input type="hidden" wire:model="data.user_id" id="user_id" value="{{ auth()->id() }}">

                    @for ($i = 1; $i <= 9; $i++)
                        <input type="hidden" wire:model="data.C{{ $i }}" id="C{{ $i }}">
                    @endfor

                    @for ($i = 1; $i <= 9; $i++)
                        <input type="hidden" wire:model="data.fileC{{ $i }}" id="fileC{{ $i }}_hidden">
                    @endfor

                    <!-- Hidden inputs untuk jumlah yang dihasilkan -->
                    @for ($i = 1; $i <= 9; $i++)
                        @for ($j = 2; $j <= 5; $j++)
                            @if(($i == 3 && ($j == 4 || $j == 5)) || $i != 3)
                                <input type="hidden" wire:model="data.JumlahYangDihasilkanC{{ $i }}_{{ $j }}"
                                       id="hidden_JumlahYangDihasilkanC{{ $i }}_{{ $j }}">
                            @endif
                        @endfor
                    @endfor

                    <!-- Hidden inputs untuk hasil akhir -->
                    <input type="hidden" wire:model="data.TotalSkorPengabdianKepadaMasyarakat"
                           id="Hidden_TotalSkorPengabdianKepadaMasyarakat">
                    @for ($i = 1; $i <= 9; $i++)
                        <input type="hidden" wire:model="data.TotalKelebihaC{{ $i }}"
                               id="Hidden_TotalKelebihaC{{ $i }}">
                    @endfor
                    <input type="hidden" wire:model="data.TotalKelebihanSkor"
                           id="Hidden_TotalKelebihanSkor">
                    <input type="hidden" wire:model="data.NilaiPengabdianKepadaMasyarakat"
                           id="Hidden_NilaiPengabdianKepadaMasyarakat">
                    <input type="hidden" wire:model="data.NilaiTambahPengabdianKepadaMasyarakat"
                           id="Hidden_NilaiTambahPengabdianKepadaMasyarakat">
                    <input type="hidden" wire:model="data.NilaiTotalPengabdianKepadaMasyarakat"
                           id="Hidden_NilaiTotalPengabdianKepadaMasyarakat">

                    <div class="overflow-x-auto mb-6">
                        <table class="point-c-table">
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
                                    <td>C</td>
                                    <td colspan="10" class="text-left font-bold">PENGABDIAN KEPADA MASYARAKAT</td>
                                </tr>

                                <!-- C.1 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali</td>
                                    <td class="text-small">Menjadi anggota/pengurus dalam organisasi skala lokal</td>
                                    <td class="text-small">Menjadi anggota/pengurus dalam organisasi tingkat kota/kabupaten</td>
                                    <td class="text-small">Menjadi anggota/pengurus dalam organisasi tingkat nasional</td>
                                    <td class="text-small">Menjadi anggota/pengurus dalam organisasi tingkat internasional</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Bukti fisik kartu anggota atau akses ke jurnal/website tertentu</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC1"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC1')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC1'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC1']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC1'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC1']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC1" id="scorC1" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC1" id="scorMaxC1" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC1" id="scorSubItemC1" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.1</td>
                                    <td class="text-left">Dosen berperan sebagai pengurus atau anggota organisasi sosial kemasyarakatan (termasuk RT, RW, parpol, organisasi keagamaan, dll)</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C1" id="C1_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C1 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.1 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah yang dihasilkan</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC1_2" id="JumlahYangDihasilkanC1_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC1_3" id="JumlahYangDihasilkanC1_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC1_4" id="JumlahYangDihasilkanC1_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC1_5" id="JumlahYangDihasilkanC1_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC1" id="JumlahSkorYangDiHasilkanC1" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC1" id="SkorTambahanJumlahSkorC1" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC1_2" id="SkorTambahanC1_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC1_3" id="SkorTambahanC1_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC1_4" id="SkorTambahanC1_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC1_5" id="SkorTambahanC1_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC1" id="SkorTambahanJumlahC1" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC1" id="SkorTambahanJumlahBobotSubItemC1" readonly></td>
                                </tr>

                                <!-- C.2 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali / Menjadi anggota organisasi sosial kemasyarakatan secara otomatis</td>
                                    <td class="text-small">Menjadi anggota aktif</td>
                                    <td class="text-small">Menjadi Ketua Bidang / Ketua Seksi</td>
                                    <td class="text-small">Menjadi Pengurus Inti (Sekretaris / Bendahara / Wakil Ketua)</td>
                                    <td class="text-small">Menjadi Ketua Umum Organisasi / Penasihat / Penanggungjawab</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload SK Pengangkatan dosen sebagai pengurus dalam organisasi kemasyarakatan tertentu</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC2"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC2')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC2'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC2']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC2'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC2']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC2" id="scorC2" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC2" id="scorMaxC2" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC2" id="scorSubItemC2" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.2</td>
                                    <td class="text-left">Peranan dosen dalam organisasi sosial kemasyarakatan</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C2" id="C2_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C2 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.2 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah yang dihasilkan</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC2_2" id="JumlahYangDihasilkanC2_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC2_3" id="JumlahYangDihasilkanC2_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC2_4" id="JumlahYangDihasilkanC2_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC2_5" id="JumlahYangDihasilkanC2_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC2" id="JumlahSkorYangDiHasilkanC2" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC2" id="SkorTambahanJumlahSkorC2" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC2_2" id="SkorTambahanC2_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC2_3" id="SkorTambahanC2_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC2_4" id="SkorTambahanC2_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC2_5" id="SkorTambahanC2_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC2" id="SkorTambahanJumlahC2" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC2" id="SkorTambahanJumlahBobotSubItemC2" readonly></td>
                                </tr>

                                <!-- C.3 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak pernah menyampaikan orasi ilmiah</td>
                                    <td class="text-small">Pernah menyampaikan orasi ilmiah 1 kali di lingkup IKBIS sendiri</td>
                                    <td class="text-small">Pernah menyampaikan orasi ilmiah 1 kali di luar IKBIS sendiri</td>
                                    <td class="text-small">Pernah menyampaikan orasi ilmiah lebih dari 1 kali di lingkup IKBIS sendiri</td>
                                    <td class="text-small">Pernah menyampaikan orasi ilmiah lebih dari 1 kali di luar IKBIS sendiri</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Bukti fisik undangan/surat keterangan telah melakukan orasi ilmiah, dan makalah yang disampaikan</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC3"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC3')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC3'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC3']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC3'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC3']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC3" id="scorC3" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC3" id="scorMaxC3" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC3" id="scorSubItemC3" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.3</td>
                                    <td class="text-left">Dosen menyampaikan orasi ilmiah dalam forum-forum kegiatan tradisi akademik seperti dies natalis, wisuda, simposium nasional, dll</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C3" id="C3_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C3 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.3 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah orasi ilmiah (>1)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC3_4" id="JumlahYangDihasilkanC3_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC3_5" id="JumlahYangDihasilkanC3_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC3" id="JumlahSkorYangDiHasilkanC3" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC3" id="SkorTambahanJumlahSkorC3" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC3_4" id="SkorTambahanC3_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC3_5" id="SkorTambahanC3_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC3" id="SkorTambahanJumlahC3" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC3" id="SkorTambahanJumlahBobotSubItemC3" readonly></td>
                                </tr>

                                <!-- C.4 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali</td>
                                    <td class="text-small">menjadi pembicara/instruktur/pengajar/juri dalam kegiatan skala lokal</td>
                                    <td class="text-small">menjadi pembicara/instruktur/pengajar/juri dalam kegiatan tingkat kota/kabupaten</td>
                                    <td class="text-small">menjadi pembicara/instruktur/pengaja/juri dalam kegiatan tingkat regional</td>
                                    <td class="text-small">menjadi pembicara/instruktur/pengaja/juri dalam kegiatan tingkat nasional</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Surat Tugas atau SK atau sertifikat yang menandakan dosen telah berperan serta dalam kegiatan pengabdian kepada masyarakat</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC4"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC4')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC4'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC4']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC4'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC4']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC4" id="scorC4" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC4" id="scorMaxC4" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC4" id="scorSubItemC4" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.4</td>
                                    <td class="text-left">Dosen menjadi pembicara, instruktur ,pengajar pada seminar, lokakarya, dan aktivitas belajar mengajar untuk pengembangan suatu lembaga sosial kemasyarakatan di dalam/luar IKBIS, baik masyarakat umum maupun masyarakat kampus</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C4" id="C4_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C4 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.4 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah kegiatan yang dilakukan</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC4_2" id="JumlahYangDihasilkanC4_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC4_3" id="JumlahYangDihasilkanC4_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC4_4" id="JumlahYangDihasilkanC4_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC4_5" id="JumlahYangDihasilkanC4_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC4" id="JumlahSkorYangDiHasilkanC4" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC4" id="SkorTambahanJumlahSkorC4" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC4_2" id="SkorTambahanC4_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC4_3" id="SkorTambahanC4_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC4_4" id="SkorTambahanC4_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC4_5" id="SkorTambahanC4_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC4" id="SkorTambahanJumlahC4" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC4" id="SkorTambahanJumlahBobotSubItemC4" readonly></td>
                                </tr>

                                <!-- C.5 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali</td>
                                    <td class="text-small">Menjadi salah satu instruktur dalam rangkaian kegiatan yang dilaksanakan</td>
                                    <td class="text-small">Menjadi instruktur utama dalam kegiatan yang dilaksanakan</td>
                                    <td class="text-small">Menjadi salah satu pembicara dalam suatu seminar/diskusi panel yang dilaksanakan</td>
                                    <td class="text-small">Menjadi pembicara utama dalam suatu seminar/diskusi panel yang dilaksanakan</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Surat Tugas atau SK atau sertifikat yang menandakan dosen telah berperan serta dalam kegiatan pengabdian kepada masyarakat</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC5"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC5')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC5'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC5']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC5'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC5']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC5" id="scorC5" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC5" id="scorMaxC5" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC5" id="scorSubItemC5" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.5</td>
                                    <td class="text-left">Peranan dosen dalam kegiatan seminar/lokakarya dan aktivitas belajar mengajar untuk pengembangan suatu lembaga sosial kemasyarakatan di dalam/luar IKBIS, baik masyarakat umum maupun masyarakat kampus</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C5" id="C5_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C5 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.5 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah ormas yang diikuti</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC5_2" id="JumlahYangDihasilkanC5_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC5_3" id="JumlahYangDihasilkanC5_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC5_4" id="JumlahYangDihasilkanC5_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC5_5" id="JumlahYangDihasilkanC5_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC5" id="JumlahSkorYangDiHasilkanC5" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC5" id="SkorTambahanJumlahSkorC5" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC5_2" id="SkorTambahanC5_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC5_3" id="SkorTambahanC5_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC5_4" id="SkorTambahanC5_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC5_5" id="SkorTambahanC5_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC5" id="SkorTambahanJumlahC5" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC5" id="SkorTambahanJumlahBobotSubItemC5" readonly></td>
                                </tr>

                                <!-- C.6 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali</td>
                                    <td class="text-small">Memberikan konsultasi kepada organisasi kemasyarakatan lokal</td>
                                    <td class="text-small">Memberikan konsultasi kepada organisasi kemasyarakatan tingkat kota/kabupaten</td>
                                    <td class="text-small">Memberikan konsultasi kepada organisasi kemasyarakatan tingkat regional</td>
                                    <td class="text-small">Memberikan konsultasi kepada organisasi kemasyarakatan tingkat nasional</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Surat Keterangan dari organisasi yang memanfaatkan jasa dosen</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC6"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC6')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC6'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC6']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC6'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC6']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC6" id="scorC6" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC6" id="scorMaxC6" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC6" id="scorSubItemC6" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.6</td>
                                    <td class="text-left">Dosen memberikan pelayanan konsultasi untuk meningkatkan kesejahteraan masyarakat (sifatnya nirlaba)</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C6" id="C6_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C6 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.6 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah ormas yang dilayani</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC6_2" id="JumlahYangDihasilkanC6_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC6_3" id="JumlahYangDihasilkanC6_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC6_4" id="JumlahYangDihasilkanC6_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC6_5" id="JumlahYangDihasilkanC6_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC6" id="JumlahSkorYangDiHasilkanC6" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC6" id="SkorTambahanJumlahSkorC6" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC6_2" id="SkorTambahanC6_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC6_3" id="SkorTambahanC6_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC6_4" id="SkorTambahanC6_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC6_5" id="SkorTambahanC6_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC6" id="SkorTambahanJumlahC6" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC6" id="SkorTambahanJumlahBobotSubItemC6" readonly></td>
                                </tr>

                                <!-- C.7 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali</td>
                                    <td class="text-small">Menyusun panduan dan disebarluaskan kepada masyarakat lokal</td>
                                    <td class="text-small">Menyusun panduan dan disebarluaskan kepada masyarakat tingkat kota/kabupaten</td>
                                    <td class="text-small">Menyusun panduan dan disebarluaskan kepada masyarakat tingkat regional</td>
                                    <td class="text-small">Menyusun panduan dan disebarluaskan pada masyarakat nasional</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Bukti fisik panduan praktis</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC7"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC7')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC7'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC7']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC7'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC7']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC7" id="scorC7" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC7" id="scorMaxC7" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC7" id="scorSubItemC7" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.7</td>
                                    <td class="text-left">Dosen menulis karya pengabdian kepada masyarakat dalam bentuk panduan praktis/terapan untuk dapat dimanfaatkan oleh masyarakat dan tidak dipublikasikan</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C7" id="C7_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C7 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.7 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah karya yang dihasilkan</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC7_2" id="JumlahYangDihasilkanC7_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC7_3" id="JumlahYangDihasilkanC7_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC7_4" id="JumlahYangDihasilkanC7_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC7_5" id="JumlahYangDihasilkanC7_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC7" id="JumlahSkorYangDiHasilkanC7" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC7" id="SkorTambahanJumlahSkorC7" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC7_2" id="SkorTambahanC7_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC7_3" id="SkorTambahanC7_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC7_4" id="SkorTambahanC7_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC7_5" id="SkorTambahanC7_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC7" id="SkorTambahanJumlahC7" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC7" id="SkorTambahanJumlahBobotSubItemC7" readonly></td>
                                </tr>

                                <!-- C.8 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali</td>
                                    <td class="text-small">Karya dosen dipublikasikan di tingkat lokal dalam jurnal/buku/prosiding</td>
                                    <td class="text-small">Karya dosen dipublikasikan di tingkat regional dalam jurnal/buku/prosiding</td>
                                    <td class="text-small">Karya dosen dipublikasikan di tingkat nasional dalam jurnal/buku/prosiding</td>
                                    <td class="text-small">Karya dosen dipublikasikan di tingkat internasional dalam jurnal/buku/prosiding</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Bukti fisik buku/makalah/artikel yang dipublikasikan</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC8"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC8')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC8'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC8']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC8'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC8']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC8" id="scorC8" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC8" id="scorMaxC8" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC8" id="scorSubItemC8" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.8</td>
                                    <td class="text-left">Dosen menulis karya pengabdian kepada masyarakat dalam bentuk panduan praktis/terapan untuk dapat dimanfaatkan oleh masyarakat dan tidak dipublikasikan</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C8" id="C8_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C8 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.8 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah karya yang dihasilkan</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC8_2" id="JumlahYangDihasilkanC8_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC8_3" id="JumlahYangDihasilkanC8_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC8_4" id="JumlahYangDihasilkanC8_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC8_5" id="JumlahYangDihasilkanC8_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC8" id="JumlahSkorYangDiHasilkanC8" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC8" id="SkorTambahanJumlahSkorC8" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC8_2" id="SkorTambahanC8_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC8_3" id="SkorTambahanC8_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC8_4" id="SkorTambahanC8_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC8_5" id="SkorTambahanC8_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC8" id="SkorTambahanJumlahC8" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC8" id="SkorTambahanJumlahBobotSubItemC8" readonly></td>
                                </tr>

                                <!-- C.9 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-small">Tidak sama sekali</td>
                                    <td class="text-small">Melaksanakan kegiatan praktik nyata di dalam lingkup internal kampus</td>
                                    <td class="text-small">Melaksanakan kegiatan praktik nyata di tingkat lokal</td>
                                    <td class="text-small">Melaksanakan kegiatan praktik nyata di tingkat kota/kabupaten</td>
                                    <td class="text-small">Melaksanakan kegiatan praktik nyata di tingkat nasional</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Laporan kegiatan pengabdian masyarakat</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="fileC9"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('fileC9')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                            @if($this->data['fileC9'] ?? false)
                                                <div class="mt-1 text-xs text-green-600">
                                                    File sudah diupload: {{ basename($this->data['fileC9']) }}
                                                </div>
                                            @endif
                                            @if($this->data['fileC9'] ?? false)
                                                <div class="mt-1">
                                                    <a href="{{ Storage::url($this->data['fileC9']) }}"
                                                    target="_blank"
                                                    class="text-blue-600 hover:text-blue-800 text-xs">
                                                        <i class="fas fa-eye mr-1"></i>Lihat File
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorC9" id="scorC9" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxC9" id="scorMaxC9" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemC9" id="scorSubItemC9" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.9</td>
                                    <td class="text-left">Dosen melaksanakan implementasi pendidikan dan penelitian melalui praktik nyata di lapangan untuk dimanfaatkan kepada masyarakat</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="C9" id="C9_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="C9 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk C.9 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah kegiatan yang dilakukan</td>
                                    <td></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC9_2" id="JumlahYangDihasilkanC9_2" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC9_3" id="JumlahYangDihasilkanC9_3" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC9_4" id="JumlahYangDihasilkanC9_4" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td><input type="number" name="JumlahYangDihasilkanC9_5" id="JumlahYangDihasilkanC9_5" onkeyup="sum()" placeholder="0" class="w-full text-center"></td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanC9" id="JumlahSkorYangDiHasilkanC9" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorC9" id="SkorTambahanJumlahSkorC9" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanC9_2" id="SkorTambahanC9_2" readonly></td>
                                    <td><input type="number" name="SkorTambahanC9_3" id="SkorTambahanC9_3" readonly></td>
                                    <td><input type="number" name="SkorTambahanC9_4" id="SkorTambahanC9_4" readonly></td>
                                    <td><input type="number" name="SkorTambahanC9_5" id="SkorTambahanC9_5" readonly></td>
                                    <td><input type="number" name="SkorTambahanJumlahC9" id="SkorTambahanJumlahC9" readonly></td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td><input type="number" name="SkorTambahanJumlahBobotSubItemC9" id="SkorTambahanJumlahBobotSubItemC9" readonly></td>
                                </tr>

                                <!-- Summary Section -->
                                <tr>
                                    <td colspan="5"></td>
                                    <td colspan="5" class="font-bold">Total Skor Pengabdian Kepada Masyarakat</td>
                                    <td>
                                        <input type="number" name="TotalSkorPengabdianKepadaMasyarakat" id="TotalSkorPengabdianKepadaMasyarakat" readonly class="w-full text-center font-bold">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 1</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC1" id="TotalKelebihaC1" readonly class="w-full text-center">
                                    </td>
                                    <td colspan="3" rowspan="4" class="font-bold">Nilai Pengabdian Kepada Masyarakat</td>
                                    <td rowspan="4">
                                        <input type="number" name="NilaiPengabdianKepadaMasyarakat" id="NilaiPengabdianKepadaMasyarakat" readonly class="w-full text-center font-bold">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 2</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC2" id="TotalKelebihaC2" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 3</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC3" id="TotalKelebihaC3" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 4</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC4" id="TotalKelebihaC4" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 5</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC5" id="TotalKelebihaC5" readonly class="w-full text-center">
                                    </td>
                                    <td colspan="3" rowspan="6" class="font-bold">Nilai Tambah Pengabdian kepada Masyarakat</td>
                                    <td rowspan="6">
                                        <input type="number" name="NilaiTambahPengabdianKepadaMasyarakat" id="NilaiTambahPengabdianKepadaMasyarakat" readonly class="w-full text-center font-bold">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 6</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC6" id="TotalKelebihaC6" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 7</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC7" id="TotalKelebihaC7" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 8</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC8" id="TotalKelebihaC8" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 9</td>
                                    <td>
                                        <input type="number" name="TotalKelebihaC9" id="TotalKelebihaC9" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor</td>
                                    <td>
                                        <input type="number" name="TotalKelebihanSkor" id="TotalKelebihanSkor" readonly class="w-full text-center">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="6" class="font-bold">Nilai Total Pengabdian Kepada Masyarakat</td>
                                    <td>
                                        <input type="number" name="NilaiTotalPengabdianKepadaMasyarakat" id="NilaiTotalPengabdianKepadaMasyarakat" readonly class="w-full text-center font-bold">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="button" onclick="handleSubmit()"
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
        <script src="{{ asset('js/penilaian/itikad/point-c-calculations.js') }}"></script>

       <script>
    // Ambil data awal dari PHP
    const initialData = @json($this->formDataForJS);

    console.log('Initial data loaded:', initialData);

    function fillForm() {
        if (!initialData || Object.keys(initialData).length === 0) {
            console.log('No initial data to fill');
            return;
        }

        console.log('Filling form with data...');

        // 1. Isi Radio Buttons C1-C9
        for (let i = 1; i <= 9; i++) {
            const val = initialData[`C${i}`];
            console.log(`C${i} value:`, val);
            if (val !== undefined && val !== null && val !== '') {
                const radio = document.querySelector(`input[name="C${i}"][value="${val}"]`);
                if (radio) {
                    radio.checked = true;
                    console.log(`Set radio C${i} to ${val}`);

                    // Trigger change event untuk memicu perhitungan
                    const event = new Event('change');
                    radio.dispatchEvent(event);
                } else {
                    console.warn(`Radio C${i} with value ${val} not found`);
                }
            }
        }

        // 2. Isi semua input number
        // Tunggu sebentar untuk memastikan DOM sudah siap
        setTimeout(() => {
            // List semua field yang mungkin ada di form
            const numberFields = [
                // Skor utama
                'scorC1', 'scorC2', 'scorC3', 'scorC4', 'scorC5', 'scorC6', 'scorC7', 'scorC8', 'scorC9',
                'scorMaxC1', 'scorMaxC2', 'scorMaxC3', 'scorMaxC4', 'scorMaxC5', 'scorMaxC6', 'scorMaxC7', 'scorMaxC8', 'scorMaxC9',
                'scorSubItemC1', 'scorSubItemC2', 'scorSubItemC3', 'scorSubItemC4', 'scorSubItemC5',
                'scorSubItemC6', 'scorSubItemC7', 'scorSubItemC8', 'scorSubItemC9',

                // Jumlah yang dihasilkan
                'JumlahYangDihasilkanC1_2', 'JumlahYangDihasilkanC1_3', 'JumlahYangDihasilkanC1_4', 'JumlahYangDihasilkanC1_5',
                'JumlahYangDihasilkanC2_2', 'JumlahYangDihasilkanC2_3', 'JumlahYangDihasilkanC2_4', 'JumlahYangDihasilkanC2_5',
                'JumlahYangDihasilkanC3_4', 'JumlahYangDihasilkanC3_5',
                'JumlahYangDihasilkanC4_2', 'JumlahYangDihasilkanC4_3', 'JumlahYangDihasilkanC4_4', 'JumlahYangDihasilkanC4_5',
                'JumlahYangDihasilkanC5_2', 'JumlahYangDihasilkanC5_3', 'JumlahYangDihasilkanC5_4', 'JumlahYangDihasilkanC5_5',
                'JumlahYangDihasilkanC6_2', 'JumlahYangDihasilkanC6_3', 'JumlahYangDihasilkanC6_4', 'JumlahYangDihasilkanC6_5',
                'JumlahYangDihasilkanC7_2', 'JumlahYangDihasilkanC7_3', 'JumlahYangDihasilkanC7_4', 'JumlahYangDihasilkanC7_5',
                'JumlahYangDihasilkanC8_2', 'JumlahYangDihasilkanC8_3', 'JumlahYangDihasilkanC8_4', 'JumlahYangDihasilkanC8_5',
                'JumlahYangDihasilkanC9_2', 'JumlahYangDihasilkanC9_3', 'JumlahYangDihasilkanC9_4', 'JumlahYangDihasilkanC9_5',

                // Skor tambahan
                'SkorTambahanC1_2', 'SkorTambahanC1_3', 'SkorTambahanC1_4', 'SkorTambahanC1_5',
                'SkorTambahanC2_2', 'SkorTambahanC2_3', 'SkorTambahanC2_4', 'SkorTambahanC2_5',
                'SkorTambahanC3_4', 'SkorTambahanC3_5',
                'SkorTambahanC4_2', 'SkorTambahanC4_3', 'SkorTambahanC4_4', 'SkorTambahanC4_5',
                'SkorTambahanC5_2', 'SkorTambahanC5_3', 'SkorTambahanC5_4', 'SkorTambahanC5_5',
                'SkorTambahanC6_2', 'SkorTambahanC6_3', 'SkorTambahanC6_4', 'SkorTambahanC6_5',
                'SkorTambahanC7_2', 'SkorTambahanC7_3', 'SkorTambahanC7_4', 'SkorTambahanC7_5',
                'SkorTambahanC8_2', 'SkorTambahanC8_3', 'SkorTambahanC8_4', 'SkorTambahanC8_5',
                'SkorTambahanC9_2', 'SkorTambahanC9_3', 'SkorTambahanC9_4', 'SkorTambahanC9_5',

                // Helper fields
                'JumlahSkorYangDiHasilkanC1', 'JumlahSkorYangDiHasilkanC2', 'JumlahSkorYangDiHasilkanC3',
                'JumlahSkorYangDiHasilkanC4', 'JumlahSkorYangDiHasilkanC5', 'JumlahSkorYangDiHasilkanC6',
                'JumlahSkorYangDiHasilkanC7', 'JumlahSkorYangDiHasilkanC8', 'JumlahSkorYangDiHasilkanC9',

                'SkorTambahanJumlahC1', 'SkorTambahanJumlahC2', 'SkorTambahanJumlahC3',
                'SkorTambahanJumlahC4', 'SkorTambahanJumlahC5', 'SkorTambahanJumlahC6',
                'SkorTambahanJumlahC7', 'SkorTambahanJumlahC8', 'SkorTambahanJumlahC9',

                'SkorTambahanJumlahSkorC1', 'SkorTambahanJumlahSkorC2', 'SkorTambahanJumlahSkorC3',
                'SkorTambahanJumlahSkorC4', 'SkorTambahanJumlahSkorC5', 'SkorTambahanJumlahSkorC6',
                'SkorTambahanJumlahSkorC7', 'SkorTambahanJumlahSkorC8', 'SkorTambahanJumlahSkorC9',

                'SkorTambahanJumlahBobotSubItemC1', 'SkorTambahanJumlahBobotSubItemC2', 'SkorTambahanJumlahBobotSubItemC3',
                'SkorTambahanJumlahBobotSubItemC4', 'SkorTambahanJumlahBobotSubItemC5', 'SkorTambahanJumlahBobotSubItemC6',
                'SkorTambahanJumlahBobotSubItemC7', 'SkorTambahanJumlahBobotSubItemC8', 'SkorTambahanJumlahBobotSubItemC9',

                // Hasil akhir
                'TotalSkorPengabdianKepadaMasyarakat',
                'TotalKelebihaC1', 'TotalKelebihaC2', 'TotalKelebihaC3',
                'TotalKelebihaC4', 'TotalKelebihaC5', 'TotalKelebihaC6',
                'TotalKelebihaC7', 'TotalKelebihaC8', 'TotalKelebihaC9',
                'TotalKelebihanSkor',
                'NilaiPengabdianKepadaMasyarakat',
                'NilaiTambahPengabdianKepadaMasyarakat',
                'NilaiTotalPengabdianKepadaMasyarakat'
            ];

            // Isi semua field
            numberFields.forEach(field => {
                const el = document.getElementById(field);
                const value = initialData[field];

                if (el) {
                    if (value !== undefined && value !== null && value !== '') {
                        el.value = value;
                        console.log(`Set ${field} to ${value}`);

                        // Trigger input event untuk update Livewire
                        const event = new Event('input', { bubbles: true });
                        el.dispatchEvent(event);
                    } else {
                        // Set default 0 untuk field skor jika kosong
                        if (field.startsWith('scor') ||
                            field.startsWith('Total') ||
                            field.startsWith('Nilai') ||
                            field.startsWith('JumlahSkor') ||
                            field.startsWith('SkorTambahan')) {
                            el.value = 0;
                        }
                    }
                } else {
                    console.warn(`Element ${field} not found in DOM`);
                }
            });

            // 3. Trigger calculation setelah semua data diisi
            if (typeof sum === 'function') {
                console.log('Triggering calculation...');
                setTimeout(() => {
                    sum();
                    // Sync ke Livewire setelah perhitungan
                    setTimeout(syncDataToLivewire, 200);
                }, 300);
            }
        }, 100);
    }

    // Fungsi untuk sync data dari display ke Livewire state
    function syncDataToLivewire() {
        console.log('Syncing data to Livewire...');

        const dataToSync = {};

        // 1. Ambil semua radio buttons yang checked
        for (let i = 1; i <= 9; i++) {
            const radio = document.querySelector(`input[name="C${i}"]:checked`);
            if (radio) {
                dataToSync[`C${i}`] = radio.value;
            } else {
                // Jika tidak ada radio yang dipilih, set ke null
                dataToSync[`C${i}`] = null;
            }
        }

        // 2. Ambil semua input number di tabel
        const allInputs = document.querySelectorAll('.point-c-table input[type="number"]');
        allInputs.forEach(input => {
            if (input.id && input.id !== '') {
                if (input.value === '' || input.value === null) {
                    // Jika input kosong, set ke 0 untuk field skor
                    if (input.id.startsWith('scor') ||
                        input.id.startsWith('Total') ||
                        input.id.startsWith('Nilai') ||
                        input.id.startsWith('JumlahSkor') ||
                        input.id.startsWith('SkorTambahan')) {
                        dataToSync[input.id] = 0;
                        input.value = 0;
                    } else {
                        dataToSync[input.id] = null;
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

        console.log('Data synced to Livewire:', dataToSync);
    }

    // Override fungsi sum() untuk update Livewire state
    const originalSum = window.sum;
    window.sum = function() {
        // Panggil fungsi asli
        if (typeof originalSum === 'function') {
            originalSum();
        }

        // Sync ke Livewire setelah perhitungan
        setTimeout(syncDataToLivewire, 100);
    };

    // Event listener untuk semua input
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, filling form...');

        // Tunggu sebentar untuk memastikan Livewire sudah selesai mount
        setTimeout(() => {
            // Isi form dengan data awal
            fillForm();

            // Setup event listeners untuk semua input setelah form terisi
            setTimeout(() => {
                setupEventListeners();
            }, 500);
        }, 300);
    });

    function setupEventListeners() {
        console.log('Setting up event listeners...');

        // Setup event listeners untuk semua input
        document.querySelectorAll('.point-c-table input').forEach(input => {
            if (input.type === 'radio') {
                input.addEventListener('change', function() {
                    setTimeout(() => {
                        if (typeof sum === 'function') sum();
                        syncDataToLivewire();
                    }, 100);
                });
            }

            if (input.type === 'number') {
                input.addEventListener('input', function() {
                    setTimeout(() => {
                        if (typeof sum === 'function') sum();
                        syncDataToLivewire();
                    }, 100);
                });

                input.addEventListener('change', function() {
                    setTimeout(() => {
                        if (typeof sum === 'function') sum();
                        syncDataToLivewire();
                    }, 100);
                });
            }
        });

        // Setup khusus untuk JumlahYangDihasilkan fields
        const jumlahFields = [
            // Untuk C.1
            'JumlahYangDihasilkanC1_2', 'JumlahYangDihasilkanC1_3', 'JumlahYangDihasilkanC1_4', 'JumlahYangDihasilkanC1_5',
            // Untuk C.2
            'JumlahYangDihasilkanC2_2', 'JumlahYangDihasilkanC2_3', 'JumlahYangDihasilkanC2_4', 'JumlahYangDihasilkanC2_5',
            // Untuk C.3
            'JumlahYangDihasilkanC3_4', 'JumlahYangDihasilkanC3_5',
            // Untuk C.4
            'JumlahYangDihasilkanC4_2', 'JumlahYangDihasilkanC4_3', 'JumlahYangDihasilkanC4_4', 'JumlahYangDihasilkanC4_5',
            // Untuk C.5
            'JumlahYangDihasilkanC5_2', 'JumlahYangDihasilkanC5_3', 'JumlahYangDihasilkanC5_4', 'JumlahYangDihasilkanC5_5',
            // Untuk C.6
            'JumlahYangDihasilkanC6_2', 'JumlahYangDihasilkanC6_3', 'JumlahYangDihasilkanC6_4', 'JumlahYangDihasilkanC6_5',
            // Untuk C.7
            'JumlahYangDihasilkanC7_2', 'JumlahYangDihasilkanC7_3', 'JumlahYangDihasilkanC7_4', 'JumlahYangDihasilkanC7_5',
            // Untuk C.8
            'JumlahYangDihasilkanC8_2', 'JumlahYangDihasilkanC8_3', 'JumlahYangDihasilkanC8_4', 'JumlahYangDihasilkanC8_5',
            // Untuk C.9
            'JumlahYangDihasilkanC9_2', 'JumlahYangDihasilkanC9_3', 'JumlahYangDihasilkanC9_4', 'JumlahYangDihasilkanC9_5'
        ];

        jumlahFields.forEach(field => {
            const el = document.getElementById(field);
            if (el) {
                el.addEventListener('input', function() {
                    setTimeout(() => {
                        if (typeof sum === 'function') sum();
                        syncDataToLivewire();
                    }, 100);
                });
            }
        });
    }

    async function handleSubmit() {
        // 1. Pastikan sync data terbaru
        syncDataToLivewire();

        // 2. Validasi radio buttons
        let isValid = true;
        for (let i = 1; i <= 9; i++) {
            if (!document.querySelector(`input[name="C${i}"]:checked`)) {
                isValid = false;
                await Swal.fire({
                    title: 'Perhatian',
                    text: `Harap pilih skor untuk item C.${i}`,
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
            // 4. Pastikan semua field sudah tersync
            syncDataToLivewire();

            // Tunggu sebentar untuk Livewire update
            await new Promise(resolve => setTimeout(resolve, 300));

            // 5. Trigger save di Livewire
            @this.save();
        }
    }

    // Livewire hook untuk refresh setelah save
    document.addEventListener('livewire:initialized', () => {
        @this.on('saved', () => {
            console.log('Data saved, reloading...');
            // Refresh data setelah save
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        });
    });
</script>
        @endif
    @endpush
</x-filament-panels::page>
