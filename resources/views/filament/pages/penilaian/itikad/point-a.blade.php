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

            .point-a-table {
                font-size: 0.875rem;
                width: 100%;
                border-collapse: collapse;
                /* Tambahan agar tabel tidak terlalu mampat */
                table-layout: auto;
                min-width: 1300px;
            }

            .point-a-table th,
            .point-a-table td {
                vertical-align: middle;
                padding: 0.75rem 0.5rem;
                border: 1px solid #e5e7eb;
                word-wrap: break-word;
            }

            /* Pengaturan Lebar Kolom Spesifik */
            .col-no { width: 40px; }
            .col-komponen { width: 250px; }
            .col-skor-radio { width: 45px; }
            .col-bukti { width: 300px; min-width: 300px; } /* Kolom Bukti diperlebar */
            .col-skor-kuning { width: 90px; min-width: 90px; }
            .col-skor-maks { width: 100px; min-width: 100px; }
            .col-skor-bobot { width: 120px; min-width: 120px; }

            .point-a-table .bg-warning {
                background-color: #fef3c7 !important;
            }

            .point-a-table input[type="radio"] {
                margin: 0 auto;
                display: block;
            }

            .point-a-table input[readonly] {
                background-color: #f3f4f6;
                font-weight: bold;
                width: 100%;
                text-align: center;
                border: none;
                padding: 0.5rem 0;
            }

            .point-a-table input[type="number"]:not([readonly]) {
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

            .filament-forms-file-upload-component {
                margin-bottom: 0.5rem;
            }

            .file-upload-container {
                margin-top: 0.5rem;
            }

            .file-upload-container input[type="file"] {
                background: #fff;
                padding: 0.25rem;
                border: 1px solid #d1d5db;
                border-radius: 4px;
            }
        </style>
    @endpush

    <div class="space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    Form Point A - Pendidikan dan Pengajaran
                </h2>
            </div>

            <div class="p-6">
                <form id="pointAForm" wire:submit.prevent="save" enctype="multipart/form-data">
                    <!-- Hidden inputs untuk data yang akan diisi JavaScript -->
                    <input type="hidden" wire:model="data.user_id" id="user_id" value="{{ auth()->id() }}">

                    @for ($i = 1; $i <= 13; $i++)
                        <input type="hidden" wire:model="data.A{{ $i }}" id="A{{ $i }}">
                    @endfor

                    <input type="hidden" wire:model="data.JumlahYangDihasilkanA11_5" id="JumlahYangDihasilkanA11_5">
                    <input type="hidden" wire:model="data.JumlahYangDihasilkanA12_3" id="JumlahYangDihasilkanA12_3">
                    <input type="hidden" wire:model="data.JumlahYangDihasilkanA12_4" id="JumlahYangDihasilkanA12_4">
                    <input type="hidden" wire:model="data.JumlahYangDihasilkanA12_5" id="JumlahYangDihasilkanA12_5">

                    <input type="hidden" wire:model="data.TotalSkorPendidikanPointA" id="Hidden_TotalSkorPendidikanPointA">
                    <input type="hidden" wire:model="data.TotalKelebihanA11" id="Hidden_TotalKelebihanA11">
                    <input type="hidden" wire:model="data.TotalKelebihanA12" id="Hidden_TotalKelebihanA12">
                    <input type="hidden" wire:model="data.TotalKelebihanSkor" id="Hidden_TotalKelebihanSkor">
                    <input type="hidden" wire:model="data.nilaiPendidikandanPengajaran"
                        id="Hidden_nilaiPendidikandanPengajaran">
                    <input type="hidden" wire:model="data.NilaiTambahPendidikanDanPengajaran"
                        id="Hidden_NilaiTambahPendidikanDanPengajaran">
                    <input type="hidden" wire:model="data.NilaiTotalPendidikanDanPengajaran"
                        id="Hidden_NilaiTotalPendidikanDanPengajaran">

                    <div class="overflow-x-auto mb-6">
                        <table class="point-a-table">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <td rowspan="2">No</td>
                                    <td rowspan="2">Komponen Kompetensi</td>
                                    <td colspan="5" class="textcenter">Skor</td>
                                    <td rowspan="2">Bukti Pendukung</td>
                                    <td rowspan="2" class="bg-warning">Skor</td>
                                    <td rowspan="2">Skor/Skor maks</td>
                                    <td rowspan="2">Skor x Bobot Sub Item</td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>A</td>
                                    <td colspan="10" class="text-left font-bold">PENDIDIKAN DAN PENGAJARAN</td>
                                </tr>

                                <!-- A.1 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Nilai rerata &lt; 3.00 (KURANG)</td>
                                    <td class="text-xs">Nilai rerata >= 3.00 - &lt; 3.60 (CUKUP)</td>
                                    <td class="text-xs">Nilai rerata >= 3.60 - &lt; 4.60 (BAIK)</td>
                                    <td class="text-xs">Nilai rerata >= 4.60 - &lt; 4.80 (SANGAT BAIK)</td>
                                    <td class="text-xs">Nilai rerata >= 4.80 - 5.00 (ISTIMEWA)</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Hasil evaluasi
                                            perkuliahan</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA1"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA1')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA1" id="scorA1" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA1" id="scorMaxA1" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA1" id="scorSubItemA1" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.1</td>
                                    <td class="text-left">Nilai rerata evaluasi perkuliahan untuk sem. Gasal - sem.
                                        Genap</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A1" id="A1_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A1 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.2 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak menyusun sama sekali</td>
                                    <td class="text-xs">Menyusun kurang dari 25% untuk mata kuliah yang diasuh</td>
                                    <td class="text-xs">Menyusun untuk 25% - 50% dari mata kuliah yang diasuh</td>
                                    <td class="text-xs">Menyusun untuk 51% - 75% dari mata kuliah yang diasuh</td>
                                    <td class="text-xs">Menyusun untuk lebih dari 75% mata kuliah yang diasuh</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Checklist RPS dari
                                            Prodi</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA2"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA2')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA2" id="scorA2" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA2" id="scorMaxA2" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA2" id="scorSubItemA2" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.2</td>
                                    <td class="text-left">Dosen menyusun RPS dari setiap mata kuliah yang diasuhnya
                                        dalam satu tahun akademik</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A2" id="A2_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A2 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.3 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Kurang dari 8 sks per Tahun Ajaran (semester Gasal dan
                                        Genap)</td>
                                    <td class="text-xs">Mengampu total 8 - 16 sks per Tahun Ajaran (semester Gasal
                                        dan Genap)</td>
                                    <td class="text-xs">Mengampu total 17 - 22 sks per Tahun Ajaran (semester Gasal
                                        dan Genap)</td>
                                    <td class="text-xs">Mengampu total 23 - 30 sks per Tahun Ajaran (semester Gasal
                                        dan Genap)</td>
                                    <td class="text-xs">Mengampu rata-rata 31 sks atau lebih, per Tahun Ajaran
                                        (semester Gasal dan Genap)</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Jumlah SKS (termasuk SKS
                                            Mengajar, Jabatan Struktural, dll)</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA3"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA3')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA3" id="scorA3" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA3" id="scorMaxA3" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA3" id="scorSubItemA3" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.3</td>
                                    <td class="text-left">Dosen menjadi pengampu mata kuliah</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A3" id="A3_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A3 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.4 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak membimbing mahasiswa sama sekali</td>
                                    <td class="text-xs">Membimbing 1 mata kuliah dengan tugas akhir seminar</td>
                                    <td class="text-xs">Membimbing 2 - 3 mata kuliah dengan tugas akhir seminar</td>
                                    <td class="text-xs">Membimbing 4 mata kuliah dengan tugas akhir seminar</td>
                                    <td class="text-xs">Membimbing >4 mata kuliah dengan tugas akhir seminar</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload SK Pembimbing dan Keterangan
                                            Prodi</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA4"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA4')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA4" id="scorA4" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA4" id="scorMaxA4" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA4" id="scorSubItemA4" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.4</td>
                                    <td class="text-left">Dosen menjadi pembimbing seminar akhir mahasiswa dalam
                                        suatu mata kuliah yang mensyaratkan seminar dan pembuatan karya ilmiah
                                        tertentu untuk kelulusannya</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A4" id="A4_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A4 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.5 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak membimbing mahasiswa PKL/ PPM/KKM</td>
                                    <td class="text-xs">Membimbing mahasiswa PKL/ PPM/KKM (0.5 Kelompok ATAU 4 - 7
                                        mahasiswa PKL)</td>
                                    <td class="text-xs">Membimbing mahasiswa PKL dan/ atau PPM/KKM (1 Kelompok ATAU
                                        8 - 10 mahasiswa)</td>
                                    <td class="text-xs">Membimbing mahasiswa PKL dan/ atau PPM/KKM (1.5 Kelompok
                                        ATAU 11 - 15 mahasiswa)</td>
                                    <td class="text-xs">Membimbing mahasiswa PKL dan/ atau PPM/KKM (2 Kelompok ATAU
                                        16 - 20 mahasiswa, atau lebih)</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload SK Pembimbingan</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA5"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA5')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA5" id="scorA5" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA5" id="scorMaxA5" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA5" id="scorSubItemA5" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.5</td>
                                    <td class="text-left">Dosen membimbing Praktik Kerja Lapangan atau Program
                                        Pemberdayaan Masyarakat atau Kuliah Kerja Mahasiswa (1 kelompok PPM dihitung
                                        2 mahasiswa)</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A5" id="A5_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A5 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.6 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak sedang membimbing Skripsi</td>
                                    <td class="text-xs">Membimbing skripsi sebagai pembimbing pendamping (1 - 8
                                        lulusan)</td>
                                    <td class="text-xs">Membimbing skripsi sebagai pembimbing pendamping (>8
                                        lulusan)</td>
                                    <td class="text-xs">Membimbing skripsi sebagai pembimbing utama (1 - 8 lulusan)
                                    </td>
                                    <td class="text-xs">Membimbing skripsi sebagai pembimbing utama (>8 lulusan)
                                    </td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload SK Pembimbingan</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA6"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA6')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA6" id="scorA6" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA6" id="scorMaxA6" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA6" id="scorSubItemA6" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.6</td>
                                    <td class="text-left">Dosen membimbing dalam menghasilkan Skripsi bagi mahasiswa
                                        strata 1 atau Tugas Akhir bagi mahasiswa diploma 3</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A6" id="A6_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A6 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.7 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak pernah menguji dalam ujian akhir mahasiswa</td>
                                    <td class="text-xs">Dosen menjadi anggota penguji (1 - 8 mahasiswa)</td>
                                    <td class="text-xs">Dosen menjadi anggota penguji (> 8 mahasiswa)</td>
                                    <td class="text-xs">Dosen menjadi Ketua Penguji (1 - 8 mahasiswa)</td>
                                    <td class="text-xs">Dosen menjadi Ketua Penguji (> 8 mahasiswa)</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload SK penunjukkan sebagai
                                            penguji</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA7"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA7')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA7" id="scorA7" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA7" id="scorMaxA7" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA7" id="scorSubItemA7" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.7</td>
                                    <td class="text-left">Dosen bertugas sebagai penguji pada ujian akhir mahasiswa
                                    </td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A7" id="A7_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A7 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.8 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Menjadi pembimbing akademik kurang dari 10 Mahasiswa</td>
                                    <td class="text-xs">Menjadi pembimbing akademik (10 - 17 mahasiswa)</td>
                                    <td class="text-xs">Menjadi pembimbing akademik (18 - 24 mahasiswa)</td>
                                    <td class="text-xs">Menjadi pembimbing akademik (25 - 30 mahasiswa)</td>
                                    <td class="text-xs">Menjadi pembimbing akademik (>30 mahasiswa)</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload SK Dosen Pembimbing Akademik
                                            (Dosen PA/Dosen Wali)</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA8"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA8')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA8" id="scorA8" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA8" id="scorMaxA8" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA8" id="scorSubItemA8" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.8</td>
                                    <td class="text-left">Dosen membimbing akademik /dosen pembimbing akademik
                                        (dosen PA/dosen wali)</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A8" id="A8_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A8 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.9 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Kurang dari 80% Jumlah mahasiswa yang dibimbingnya lancar
                                        (Jumlah mahasiswa melanjutkan studi/lulus < 80% )</td>
                                    <td class="text-xs">Tidak diperhitungkan</td>
                                    <td class="text-xs">80% s.d. < 100% Jumlah mahasiswa yang dibimbingnya lancar
                                            (Jumlah mahasiswa melanjutkan studi/lulus=80% s.d. < 100%)</td>
                                    <td class="text-xs">Tidak diperhitungkan</td>
                                    <td class="text-xs">100% jumlah mahasiswa yang dibimbingnya lancar (Jumlah
                                        mahasiswa melanjutkan studi/lulus = 100%)</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Keterangan dari Prodi dan
                                            BAAK</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA9"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA9')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA9" id="scorA9" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA9" id="scorMaxA9" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA9" id="scorSubItemA9" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.9</td>
                                    <td class="text-left">Dosen PA/Dosen Wali membimbing kelancaran studi mahasiswa
                                        yang dibimbingnya</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A9" id="A9_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A9 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.10 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak sedang menjadi pembina kegiatan akademik maupun
                                        kemahasiswaan</td>
                                    <td class="text-xs">Menjadi pembina 1 (satu) kegiatan kemahasiswaan saja</td>
                                    <td class="text-xs">Menjadi penasihat akademik saja</td>
                                    <td class="text-xs">Menjadi penasihat akademik dan pembina 1 kegiatan
                                        kemahasiswaan</td>
                                    <td class="text-xs">Menjadi penasihat akademik dan pembina kegiatan
                                        kemahasiswaan lebih dari 1</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Keterangan dari Prodi</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA10"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA10')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA10" id="scorA10" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA10" id="scorMaxA10" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA10" id="scorSubItemA10" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.10</td>
                                    <td class="text-left">Dosen menjadi pembina dalam kegiatan mahasiswa dalam
                                        bidang akademik dan kemahasiswaan</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A10" id="A10_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A10 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.11 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak pernah mengusulkan metode baru</td>
                                    <td class="text-xs">Pernah mengusulkan metode baru, namun tidak
                                        diimplementasikan</td>
                                    <td class="text-xs">Telah mengusulkan metode baru dan sedang dalam proses review
                                        oleh Dekan / Tim Kurikulum</td>
                                    <td class="text-xs">Metode baru yang diusulkan telah disetujui namun belum
                                        diterapkan dalam PT / Fakultas / Prodinya</td>
                                    <td class="text-xs">Metode baru yang diusulkan telah disetujui dan
                                        diimplementasikan dalam PT / Fakultas / Prodinya</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Bukti tertulis terkait metode
                                            pembelajaran baru yang telah disampaikan</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA11"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA11')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA11" id="scorA11" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA11" id="scorMaxA11" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA11" id="scorSubItemA11" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.11</td>
                                    <td class="text-left">Dosen berhasil menemukan metode pembelajaran yang
                                        inovatif, dilengkapi dengan media pembelajaran dan evaluasi pembelajaran
                                        yang tertulis dan tersimpan dalam perpustakaan IKBIS.</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A11" id="A11_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A11 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk A.11 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah yang dihasilkan</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="JumlahYangDihasilkanA11_5"
                                            id="JumlahYangDihasilkanA11_5" onkeyup="sum()" placeholder="0"
                                            class="w-full text-center">
                                    </td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanA11_5"
                                            id="JumlahSkorYangDiHasilkanA11_5" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="JumlahSkorYangDiHasilkanBobotSubItemA11_5"
                                            id="JumlahSkorYangDiHasilkanBobotSubItemA11_5" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanA11_5" id="SkorTambahanA11_5"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahA11_5"
                                            id="SkorTambahanJumlahA11_5" readonly>
                                    </td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahBobotSubItemA11_5"
                                            id="SkorTambahanJumlahBobotSubItemA11_5" readonly>
                                    </td>
                                </tr>

                                <!-- A.12 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak pernah menyusun bahan pengajaran sendiri</td>
                                    <td class="text-xs">Menyusun bahan pengajaran dalam bentuk naskah tutorial yang
                                        ditulis mengikuti kaidah tulisan ilmiah</td>
                                    <td class="text-xs">Membuat alat bantu dalam bentuk audio visual, atau model
                                        yang memudahkan proses pengajaran</td>
                                    <td class="text-xs">Menyusun diktat, modul, model, dan petunjuk praktikum untuk
                                        membantu proses pengajaran</td>
                                    <td class="text-xs">Menyusun buku ajar/buku number untuk suatu mata kuliah,
                                        mengikuti kaidah buku number serta diterbitkan secara resmi dan
                                        disebarluaskan</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload Bukti fisik bahan pengajaran
                                            yang dihasilkan, dan jumlah mata kuliah diperhitungkan</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA12"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA12')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA12" id="scorA12" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA12" id="scorMaxA12" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA12" id="scorSubItemA12" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.12</td>
                                    <td class="text-left">Dosen mengembangkan bahan pengajaran sebagai hasil
                                        pengembangan inovatif materi substansi pengajaran</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A12" id="A12_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A12 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Tambahan untuk A.12 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="text-left">Jumlah yang dihasilkan</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="JumlahYangDihasilkanA12_3"
                                            id="JumlahYangDihasilkanA12_3" onkeyup="sum()" placeholder="0"
                                            class="w-full text-center">
                                    </td>
                                    <td>
                                        <input type="number" name="JumlahYangDihasilkanA12_4"
                                            id="JumlahYangDihasilkanA12_4" onkeyup="sum()" placeholder="0"
                                            class="w-full text-center">
                                    </td>
                                    <td>
                                        <input type="number" name="JumlahYangDihasilkanA12_5"
                                            id="JumlahYangDihasilkanA12_5" onkeyup="sum()" placeholder="0"
                                            class="w-full text-center">
                                    </td>
                                    <td></td>
                                    <td class="bg-warning">
                                        <input type="number" name="JumlahSkorYangDiHasilkanA12"
                                            id="JumlahSkorYangDiHasilkanA12" readonly>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahSkorA12"
                                            id="SkorTambahanJumlahSkorA12" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Skor Tambahan dari Jumlah</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanA12_3" id="SkorTambahanA12_3"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="SkorTambahanA12_4" id="SkorTambahanA12_4"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="SkorTambahanA12_5" id="SkorTambahanA12_5"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahA12" id="SkorTambahanJumlahA12"
                                            readonly>
                                    </td>
                                    <td class="bg-warning"></td>
                                    <td></td>
                                    <td>
                                        <input type="number" name="SkorTambahanJumlahBobotSubItemA12"
                                            id="SkorTambahanJumlahBobotSubItemA12" readonly>
                                    </td>
                                </tr>

                                <!-- A.13 -->
                                <tr>
                                    <td colspan="2" class="text-left">Deskripsi penilaian:</td>
                                    <td class="text-xs">Tidak sedang menduduki jabatan struktural</td>
                                    <td class="text-xs">Sedang menjabat sebagai Kepala Program Studi, Ka. Sub.
                                        Lembaga</td>
                                    <td class="text-xs">Sedang menjabat sebagai Dekan, Ka. Lembaga, Ka. UPT</td>
                                    <td class="text-xs">Sedang menjabat sebagai Wakil Rektor</td>
                                    <td class="text-xs">Sedang menjabat sebagai Rektor</td>
                                    <td rowspan="2">
                                        <label class="form-label text-danger">* Upload SK Pengangkatan sebagai
                                            Pejabat Struktural</label>
                                        <div class="file-upload-container">
                                            <input type="file" wire:model="data.fileA13"
                                                class="w-full text-xs border-gray-300 rounded-md"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            @error('data.fileA13')
                                                <span class="text-red-500 text-xs">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </td>
                                    <td rowspan="2" class="bg-warning">
                                        <input type="number" name="scorA13" id="scorA13" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorMaxA13" id="scorMaxA13" readonly>
                                    </td>
                                    <td rowspan="2">
                                        <input type="number" name="scorSubItemA13" id="scorSubItemA13" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>A.13</td>
                                    <td class="text-left">Dosen menduduki jabatan struktural Akademik di perguruan
                                        tinggi</td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <td>
                                            <input type="radio" name="A13" id="A13_{{ $i }}"
                                                value="{{ $i }}" onclick="sum()" class="A13 h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Summary Section -->
                                <tr>
                                    <td colspan="5"></td>
                                    <td colspan="5" class="font-bold">Total Skor Pendidikan dan Pengajaran</td>
                                    <td>
                                        <input type="number" name="TotalSkorPendidikanPointA"
                                            id="TotalSkorPendidikanPointA" readonly
                                            class="w-full text-center font-bold">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 11</td>
                                    <td>
                                        <input type="number" name="TotalKelebihanA11" id="TotalKelebihanA11"
                                            readonly class="w-full text-center">
                                    </td>
                                    <td colspan="3" class="font-bold">Nilai Pendidikan dan Pengajaran</td>
                                    <td>
                                        <input type="number" name="nilaiPendidikandanPengajaran"
                                            id="nilaiPendidikandanPengajaran" readonly
                                            class="w-full text-center font-bold">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2" class="font-bold">Total Kelebihan Skor No. 12</td>
                                    <td>
                                        <input type="number" name="TotalKelebihanA12" id="TotalKelebihanA12"
                                            readonly class="w-full text-center">
                                    </td>
                                    <td colspan="3" rowspan="2" class="font-bold">Nilai Tambah Pendidikan dan
                                        Pengajaran</td>
                                    <td rowspan="2">
                                        <input type="number" name="NilaiTambahPendidikanDanPengajaran"
                                            id="NilaiTambahPendidikanDanPengajaran" readonly
                                            class="w-full text-center font-bold">
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
                                    <td colspan="6" class="font-bold">Nilai Total Pendidikan & Pengajaran</td>
                                    <td>
                                        <input type="number" name="NilaiTotalPendidikanDanPengajaran"
                                            id="NilaiTotalPendidikanDanPengajaran" readonly
                                            class="w-full text-center font-bold">
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
    </div>

    @livewireScripts
    @push('scripts')
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Include your existing calculation script -->
        <script src="{{ asset('js/penilaian/itikad/point-a-calculations.js') }}"></script>

        <script>
            // Data dari PHP untuk JavaScript (untuk edit mode)
            const formDataFromPHP = @json($this->formDataForJS);

            // Fungsi untuk load data dari database ke form
            function loadFormData() {
                if (Object.keys(formDataFromPHP).length > 0) {
                    console.log('Loading form data from PHP:', formDataFromPHP);

                    // Load A1-A13 radio buttons
                    for (let i = 1; i <= 13; i++) {
                        const value = formDataFromPHP[`A${i}`];
                        if (value) {
                            const radio = document.querySelector(`input[name="A${i}"][value="${value}"]`);
                            if (radio) radio.checked = true;
                        }
                    }

                    // Load additional inputs
                    const additionalFields = [
                        'JumlahYangDihasilkanA11_5',
                        'JumlahYangDihasilkanA12_3',
                        'JumlahYangDihasilkanA12_4',
                        'JumlahYangDihasilkanA12_5'
                    ];

                    additionalFields.forEach(field => {
                        const value = formDataFromPHP[field];
                        if (value !== undefined) {
                            const input = document.getElementById(field);
                            if (input) input.value = value;
                        }
                    });

                    // Trigger calculation after loading data
                    setTimeout(() => {
                        if (typeof sum === 'function') {
                            sum();
                        }
                    }, 100);
                }
            }

            // Fungsi untuk sync data ke hidden inputs sebelum submit
            // Fungsi untuk sync data ke hidden inputs DAN update display inputs
            function syncDataToHiddenInputs() {
                console.log('Syncing data to hidden inputs and updating display...');

                // Daftar field yang perlu di-sync
                const fieldsToSync = [
                    'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10', 'A11', 'A12', 'A13',
                    'JumlahYangDihasilkanA11_5',
                    'JumlahYangDihasilkanA12_3',
                    'JumlahYangDihasilkanA12_4',
                    'JumlahYangDihasilkanA12_5',
                    'TotalSkorPendidikanPointA',
                    'TotalKelebihanA11',
                    'TotalKelebihanA12',
                    'TotalKelebihanSkor',
                    'nilaiPendidikandanPengajaran',
                    'NilaiTambahPendidikanDanPengajaran',
                    'NilaiTotalPendidikanDanPengajaran'
                ];

                fieldsToSync.forEach(field => {
                    const displayInput = document.getElementById(field);
                    const hiddenInput = document.getElementById(field);

                    if (displayInput && hiddenInput) {
                        // Jika display input ada value, sync ke hidden
                        if (displayInput.value !== '') {
                            hiddenInput.value = displayInput.value;
                        }
                        // Jika hidden input ada value (dari perhitungan), sync ke display
                        else if (hiddenInput.value !== '') {
                            displayInput.value = hiddenInput.value;
                        }
                    }
                });

                // Sync khusus untuk radio buttons A1-A13
                for (let i = 1; i <= 13; i++) {
                    const fieldName = `A${i}`;
                    const radio = document.querySelector(`input[name="${fieldName}"]:checked`);
                    const hiddenInput = document.getElementById(fieldName);

                    if (radio && hiddenInput) {
                        hiddenInput.value = radio.value;
                    }
                }

                // Log untuk debugging
                console.log('Sync complete. Display values:', {
                    TotalSkorPendidikanPointA: document.getElementById('TotalSkorPendidikanPointA').value,
                    nilaiPendidikandanPengajaran: document.getElementById('nilaiPendidikandanPengajaran').value,
                    NilaiTotalPendidikanDanPengajaran: document.getElementById('NilaiTotalPendidikanDanPengajaran')
                        .value
                });
            }

            // Fungsi handle submit
            async function handleSubmit() {
                // Sync data ke hidden inputs
                syncDataToHiddenInputs();

                // Validasi minimal
                const requiredFields = ['fileA1', 'fileA2', 'fileA3', 'fileA4', 'fileA5', 'fileA6', 'fileA7', 'fileA8',
                    'fileA9', 'fileA10', 'fileA11', 'fileA12', 'fileA13'
                ];
                let isValid = true;

                // Check if at least one radio button per row is selected
                for (let i = 1; i <= 13; i++) {
                    const radios = document.getElementsByName(`A${i}`);
                    const isChecked = Array.from(radios).some(radio => radio.checked);
                    if (!isChecked) {
                        isValid = false;
                        alert(`Harap pilih skor untuk A.${i}`);
                        break;
                    }
                }

                if (!isValid) {
                    return;
                }

                // Show confirmation dialog
                const result = await Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menyimpan data Point A.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                });

                if (result.isConfirmed) {
                    // Trigger Livewire submit
                    const form = document.getElementById('pointAForm');
                    form.dispatchEvent(new Event('submit', {
                        bubbles: true
                    }));
                }
            }

            // Initialize when page loads
            document.addEventListener('DOMContentLoaded', function() {
                // Load data from PHP (for edit mode)
                loadFormData();

                // Setup event listeners for number inputs
                const numberInputs = [
                    'JumlahYangDihasilkanA11_5',
                    'JumlahYangDihasilkanA12_3',
                    'JumlahYangDihasilkanA12_4',
                    'JumlahYangDihasilkanA12_5'
                ];

                numberInputs.forEach(id => {
                    const input = document.getElementById(id);
                    if (input) {
                        input.addEventListener('input', function() {
                            setTimeout(sum, 100);
                        });
                    }
                });

                // Setup event listeners for radio buttons
                for (let i = 1; i <= 13; i++) {
                    const radios = document.getElementsByName(`A${i}`);
                    radios.forEach(radio => {
                        radio.addEventListener('change', function() {
                            setTimeout(sum, 100);
                        });
                    });
                }

                // Initial calculation
                setTimeout(sum, 200);
            });

            // Override original sum function to add sync to hidden inputs
            const originalSum = window.sum;
            window.sum = function() {
                // Call original function
                if (typeof originalSum === 'function') {
                    originalSum();
                }

                // Sync to hidden inputs after calculation
                setTimeout(syncDataToHiddenInputs, 50);
            };
        </script>
    @endpush
</x-filament-panels::page>
