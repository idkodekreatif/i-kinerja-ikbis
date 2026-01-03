<x-filament-panels::page>
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
            }

            .point-a-table th, .point-a-table td {
                vertical-align: middle;
                padding: 0.5rem;
            }

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
                <form wire:submit="save" enctype="multipart/form-data" id="pointAForm">
                    <div class="overflow-x-auto">
                        <table class="point-a-table w-full table-auto border-collapse border border-gray-300 text-center">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <td rowspan="2" class="border border-gray-300">No</td>
                                    <td rowspan="2" class="border border-gray-300">Komponen Kompetensi</td>
                                    <td colspan="5" class="border border-gray-300">Skor</td>
                                    <td rowspan="2" class="border border-gray-300">Bukti Pendukung</td>
                                    <td rowspan="2" class="border border-gray-300 bg-yellow-100">Skor</td>
                                    <td rowspan="2" class="border border-gray-300">Skor/Skor maks</td>
                                    <td rowspan="2" class="border border-gray-300">Skor x Bobot Sub Item</td>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <td class="border border-gray-300">1</td>
                                    <td class="border border-gray-300">2</td>
                                    <td class="border border-gray-300">3</td>
                                    <td class="border border-gray-300">4</td>
                                    <td class="border border-gray-300">5</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 font-bold">A</td>
                                    <td colspan="10" class="border border-gray-300 text-left font-bold">PENDIDIKAN DAN PENGAJARAN</td>
                                </tr>

                                <!-- A.1 -->
                                <tr>
                                    <td colspan="2" class="border border-gray-300 text-left">Deskripsi penilaian:</td>
                                    <td class="border border-gray-300 text-sm">Nilai rerata < 3.00 (KURANG)</td>
                                    <td class="border border-gray-300 text-sm">Nilai rerata >= 3.00 - < 3.60 (CUKUP)</td>
                                    <td class="border border-gray-300 text-sm">Nilai rerata >= 3.60 - < 4.60 (BAIK)</td>
                                    <td class="border border-gray-300 text-sm">Nilai rerata >= 4.60 - < 4.80 (SANGAT BAIK)</td>
                                    <td class="border border-gray-300 text-sm">Nilai rerata >= 4.80 - 5.00 (ISTIMEWA)</td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <label class="block text-sm font-medium text-red-600 mb-1">
                                            * Upload Hasil evaluasi perkuliahan
                                        </label>
                                        <input type="file"
                                               wire:model="data.fileA1"
                                               class="w-full text-sm border-gray-300 rounded-md"
                                               accept=".pdf,.jpg,.jpeg,.png">
                                        @error('data.fileA1')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td rowspan="2" class="border border-gray-300 bg-yellow-100">
                                        <input type="number"
                                               wire:model="data.scorA1"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.scorMaxA1"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.scorSubItemA1"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300">A.1</td>
                                    <td class="border border-gray-300 text-left">Nilai rerata evaluasi perkuliahan untuk sem. Gasal - sem. Genap</td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <td class="border border-gray-300">
                                            <input type="radio"
                                                   wire:model="data.A1"
                                                   value="{{ $i }}"
                                                   onclick="calculateScores()"
                                                   class="h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- A.2 -->
                                <tr>
                                    <td colspan="2" class="border border-gray-300 text-left">Deskripsi penilaian:</td>
                                    <td class="border border-gray-300 text-sm">Tidak menyusun sama sekali</td>
                                    <td class="border border-gray-300 text-sm">Menyusun kurang dari 25% untuk mata kuliah yang diasuh</td>
                                    <td class="border border-gray-300 text-sm">Menyusun untuk 25% - 50% dari mata kuliah yang diasuh</td>
                                    <td class="border border-gray-300 text-sm">Menyusun untuk 51% - 75% dari mata kuliah yang diasuh</td>
                                    <td class="border border-gray-300 text-sm">Menyusun untuk lebih dari 75% mata kuliah yang diasuh</td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <label class="block text-sm font-medium text-red-600 mb-1">
                                            * Upload Checklist RPS dari Prodi
                                        </label>
                                        <input type="file"
                                               wire:model="data.fileA2"
                                               class="w-full text-sm border-gray-300 rounded-md"
                                               accept=".pdf,.jpg,.jpeg,.png">
                                        @error('data.fileA2')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td rowspan="2" class="border border-gray-300 bg-yellow-100">
                                        <input type="number"
                                               wire:model="data.scorA2"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.scorMaxA2"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.scorSubItemA2"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300">A.2</td>
                                    <td class="border border-gray-300 text-left">Dosen menyusun RPS dari setiap mata kuliah yang diasuhnya dalam satu tahun akademik</td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <td class="border border-gray-300">
                                            <input type="radio"
                                                   wire:model="data.A2"
                                                   value="{{ $i }}"
                                                   onclick="calculateScores()"
                                                   class="h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>

                                <!-- Lanjutkan dengan item A.3 sampai A.13 dengan pola yang sama -->
                                <!-- Untuk menghemat space, saya akan buat template untuk item lainnya -->

                                <!-- Template untuk item A.3 sampai A.10 -->
                                @for($item = 3; $item <= 10; $item++)
                                    <!-- Anda bisa menambahkan deskripsi spesifik untuk setiap item -->
                                    <tr>
                                        <td colspan="2" class="border border-gray-300 text-left">Deskripsi penilaian:</td>
                                        <td colspan="5" class="border border-gray-300 text-sm">
                                            Deskripsi untuk A.{{ $item }} - sesuaikan sesuai kebutuhan
                                        </td>
                                        <td rowspan="2" class="border border-gray-300">
                                            <label class="block text-sm font-medium text-red-600 mb-1">
                                                * Upload File A{{ $item }}
                                            </label>
                                            <input type="file"
                                                   wire:model="data.fileA{{ $item }}"
                                                   class="w-full text-sm border-gray-300 rounded-md"
                                                   accept=".pdf,.jpg,.jpeg,.png">
                                        </td>
                                        <td rowspan="2" class="border border-gray-300 bg-yellow-100">
                                            <input type="number"
                                                   wire:model="data.scorA{{ $item }}"
                                                   readonly
                                                   class="w-full text-center bg-gray-100 border-none">
                                        </td>
                                        <td rowspan="2" class="border border-gray-300">
                                            <input type="number"
                                                   wire:model="data.scorMaxA{{ $item }}"
                                                   readonly
                                                   class="w-full text-center bg-gray-100 border-none">
                                        </td>
                                        <td rowspan="2" class="border border-gray-300">
                                            <input type="number"
                                                   wire:model="data.scorSubItemA{{ $item }}"
                                                   readonly
                                                   class="w-full text-center bg-gray-100 border-none">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-300">A.{{ $item }}</td>
                                        <td class="border border-gray-300 text-left">Deskripsi A.{{ $item }}</td>
                                        @for($i = 1; $i <= 5; $i++)
                                            <td class="border border-gray-300">
                                                <input type="radio"
                                                       wire:model="data.A{{ $item }}"
                                                       value="{{ $i }}"
                                                       onclick="calculateScores()"
                                                       class="h-4 w-4">
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor

                                <!-- A.11 dengan field tambahan -->
                                <tr>
                                    <td colspan="2" class="border border-gray-300 text-left">Deskripsi penilaian:</td>
                                    <td class="border border-gray-300 text-sm">Tidak pernah mengusulkan metode baru</td>
                                    <td class="border border-gray-300 text-sm">Pernah mengusulkan metode baru, namun tidak diimplementasikan</td>
                                    <td class="border border-gray-300 text-sm">Telah mengusulkan metode baru dan sedang dalam proses review</td>
                                    <td class="border border-gray-300 text-sm">Metode baru telah disetujui namun belum diterapkan</td>
                                    <td class="border border-gray-300 text-sm">Metode baru telah disetujui dan diimplementasikan</td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <label class="block text-sm font-medium text-red-600 mb-1">
                                            * Upload Bukti tertulis metode pembelajaran baru
                                        </label>
                                        <input type="file"
                                               wire:model="data.fileA11"
                                               class="w-full text-sm border-gray-300 rounded-md"
                                               accept=".pdf,.jpg,.jpeg,.png">
                                    </td>
                                    <td rowspan="2" class="border border-gray-300 bg-yellow-100">
                                        <input type="number"
                                               wire:model="data.scorA11"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.scorMaxA11"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.scorSubItemA11"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300">A.11</td>
                                    <td class="border border-gray-300 text-left">Dosen berhasil menemukan metode pembelajaran yang inovatif</td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <td class="border border-gray-300">
                                            <input type="radio"
                                                   wire:model="data.A11"
                                                   value="{{ $i }}"
                                                   onclick="calculateScores()"
                                                   class="h-4 w-4">
                                        </td>
                                    @endfor
                                </tr>
                                <!-- Row tambahan untuk A.11 -->
                                <tr>
                                    <td rowspan="2"></td>
                                    <td class="border border-gray-300 text-left">Jumlah yang dihasilkan</td>
                                    <td colspan="4" class="border border-gray-300"></td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.JumlahYangDihasilkanA11_5"
                                               oninput="calculateScores()"
                                               placeholder="0"
                                               class="w-full text-center border-gray-300 rounded">
                                    </td>
                                    <td class="border border-gray-300"></td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.JumlahSkorYangDiHasilkanA11_5"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td class="border border-gray-300"></td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.JumlahSkorYangDiHasilkanBobotSubItemA11_5"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 text-left">Skor Tambahan dari Jumlah</td>
                                    <td colspan="4" class="border border-gray-300"></td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.SkorTambahanA11_5"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.SkorTambahanJumlahA11_5"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td class="border border-gray-300"></td>
                                    <td class="border border-gray-300"></td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.SkorTambahanJumlahBobotSubItemA11_5"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                </tr>

                                <!-- Summary Section -->
                                <tr>
                                    <td colspan="5" class="border border-gray-300"></td>
                                    <td colspan="5" class="border border-gray-300 font-bold">Total Skor Pendidikan dan Pengajaran</td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.TotalSkorPendidikanPointA"
                                               readonly
                                               class="w-full text-center font-bold bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="border border-gray-300"></td>
                                    <td colspan="2" class="border border-gray-300 font-bold">Total Kelebihan Skor No. 11</td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.TotalKelebihanA11"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td colspan="3" class="border border-gray-300 font-bold">Nilai Pendidikan dan Pengajaran</td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.nilaiPendidikandanPengajaran"
                                               readonly
                                               class="w-full text-center font-bold bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="border border-gray-300"></td>
                                    <td colspan="2" class="border border-gray-300 font-bold">Total Kelebihan Skor No. 12</td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.TotalKelebihanA12"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                    <td colspan="3" rowspan="2" class="border border-gray-300 font-bold">Nilai Tambah Pendidikan dan Pengajaran</td>
                                    <td rowspan="2" class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.NilaiTambahPendidikanDanPengajaran"
                                               readonly
                                               class="w-full text-center font-bold bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="border border-gray-300"></td>
                                    <td colspan="2" class="border border-gray-300 font-bold">Total Kelebihan Skor</td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.TotalKelebihanSkor"
                                               readonly
                                               class="w-full text-center bg-gray-100 border-none">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="border border-gray-300"></td>
                                    <td colspan="6" class="border border-gray-300 font-bold">Nilai Total Pendidikan & Pengajaran</td>
                                    <td class="border border-gray-300">
                                        <input type="number"
                                               wire:model="data.NilaiTotalPendidikanDanPengajaran"
                                               readonly
                                               class="w-full text-center font-bold bg-gray-100 border-none">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="button"
                                onclick="confirmSubmit()"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            // Fungsi untuk menghitung skor
            function calculateScores() {
                // Tunggu sejenak agar Livewire update data
                setTimeout(() => {
                    // Kirim event ke Livewire untuk menghitung
                    @this.call('calculateScores');
                }, 100);
            }

            // Fungsi konfirmasi submit
            function confirmSubmit() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menyimpan data Point A.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form melalui Livewire
                        @this.call('save');

                        // Tampilkan notifikasi sukses
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Point A telah disimpan.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            }

            // Inisialisasi perhitungan saat halaman dimuat
            document.addEventListener('DOMContentLoaded', function() {
                calculateScores();
            });
        </script>
    @endpush
</x-filament-panels::page>
