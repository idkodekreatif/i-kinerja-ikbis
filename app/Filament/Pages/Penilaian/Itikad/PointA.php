<?php

namespace App\Filament\Pages\Penilaian\Itikad;

use App\Models\Penilaian\Itikad\PointA as PointAModel;
use App\Models\Setting\Period;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class PointA extends Page implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Penilaian Dosen';
    protected static string $view = 'filament.pages.penilaian.itikad.point-a';
    protected static ?string $title = 'Form Point A - Pendidikan dan Pengajaran';
    protected static ?string $slug = 'penilaian-dosen/itikad/point-a';

    public ?array $data = [];
    public array $formDataForJS = [];

    // Tambahkan property untuk kontrol tampilan
    public $hasActivePeriod = false;
    public $activePeriod = null;

    public $fileA1, $fileA2, $fileA3, $fileA4, $fileA5, $fileA6, $fileA7,
        $fileA8, $fileA9, $fileA10, $fileA11, $fileA12, $fileA13;

    protected $rules = [
        'fileA1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA6' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA7' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA8' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA9' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA10' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA11' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA12' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileA13' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    ];

    public function mount(): void
    {
        // Cek apakah ada periode aktif
        $this->checkActivePeriod();

        // Hanya load data jika ada periode aktif
        if ($this->hasActivePeriod) {
            $this->loadData();
        }
    }

    private function checkActivePeriod(): void
    {
        try {
            $this->activePeriod = Period::active()->first();
            $this->hasActivePeriod = !is_null($this->activePeriod);

            // Jika tidak ada periode aktif, set flash message
            if (!$this->hasActivePeriod) {
                Notification::make()
                    ->title('Periode Tidak Aktif!')
                    ->body('Tidak ada periode penilaian yang aktif saat ini. Form tidak dapat diakses.')
                    ->danger()
                    ->persistent()
                    ->send();
            }
        } catch (\Exception $e) {
            Log::error('Error checking active period:', ['error' => $e->getMessage()]);
            $this->hasActivePeriod = false;

            Notification::make()
                ->title('Error!')
                ->body('Terjadi kesalahan saat memeriksa periode aktif.')
                ->danger()
                ->send();
        }
    }

    private function getActivePeriodId()
    {
        try {
            $activePeriod = Period::active()->first();
            return $activePeriod ? $activePeriod->id : null;
        } catch (\Exception $e) {
            Log::error('Error getting active period:', ['error' => $e->getMessage()]);
            return null;
        }
    }

    private function loadData(): void
    {
        try {
            $userId = auth()->id();
            $periodId = $this->activePeriod->id;

            if (!$periodId) {
                Notification::make()
                    ->title('Perhatian!')
                    ->body('Tidak ada periode penilaian aktif saat ini.')
                    ->warning()
                    ->persistent()
                    ->send();

                $this->form->fill(['user_id' => $userId]);
                $this->data = ['user_id' => $userId];
                $this->formDataForJS = ['user_id' => $userId];
                return;
            }

            $pointA = PointAModel::where('user_id', $userId)
                ->where('period_id', $periodId)
                ->first();

            if ($pointA) {
                $data = $pointA->toArray();

                // Pastikan semua field skor ada, meskipun null
                $requiredFields = [
                    // A1-A13
                    'A1',
                    'A2',
                    'A3',
                    'A4',
                    'A5',
                    'A6',
                    'A7',
                    'A8',
                    'A9',
                    'A10',
                    'A11',
                    'A12',
                    'A13',

                    // Skor utama
                    'scorA1',
                    'scorA2',
                    'scorA3',
                    'scorA4',
                    'scorA5',
                    'scorA6',
                    'scorA7',
                    'scorA8',
                    'scorA9',
                    'scorA10',
                    'scorA11',
                    'scorA12',
                    'scorA13',
                    'scorMaxA1',
                    'scorMaxA2',
                    'scorMaxA3',
                    'scorMaxA4',
                    'scorMaxA5',
                    'scorMaxA6',
                    'scorMaxA7',
                    'scorMaxA8',
                    'scorMaxA9',
                    'scorMaxA10',
                    'scorMaxA11',
                    'scorMaxA12',
                    'scorMaxA13',
                    'scorSubItemA1',
                    'scorSubItemA2',
                    'scorSubItemA3',
                    'scorSubItemA4',
                    'scorSubItemA5',
                    'scorSubItemA6',
                    'scorSubItemA7',
                    'scorSubItemA8',
                    'scorSubItemA9',
                    'scorSubItemA10',
                    'scorSubItemA11',
                    'scorSubItemA12',
                    'scorSubItemA13',

                    // Tambahan A11
                    'JumlahYangDihasilkanA11_5',
                    'JumlahSkorYangDiHasilkanA11_5',
                    'JumlahSkorYangDiHasilkanBobotSubItemA11_5',
                    'SkorTambahanA11_5',
                    'SkorTambahanJumlahA11_5',
                    'SkorTambahanJumlahBobotSubItemA11_5',

                    // Tambahan A12
                    'JumlahYangDihasilkanA12_3',
                    'JumlahYangDihasilkanA12_4',
                    'JumlahYangDihasilkanA12_5',
                    'SkorTambahanA12_3',
                    'SkorTambahanA12_4',
                    'SkorTambahanA12_5',
                    'SkorTambahanJumlahA12',
                    'JumlahSkorYangDiHasilkanA12',
                    'SkorTambahanJumlahSkorA12',
                    'SkorTambahanJumlahBobotSubItemA12',

                    // Hasil akhir
                    'TotalSkorPendidikanPointA',
                    'TotalKelebihanA11',
                    'TotalKelebihanA12',
                    'TotalKelebihanSkor',
                    'nilaiPendidikandanPengajaran',
                    'NilaiTambahPendidikanDanPengajaran',
                    'NilaiTotalPendidikanDanPengajaran'
                ];

                // Set default 0 untuk field skor yang null
                foreach ($requiredFields as $field) {
                    if (!isset($data[$field]) || $data[$field] === null) {
                        if (
                            str_starts_with($field, 'scor') ||
                            str_starts_with($field, 'Total') ||
                            str_starts_with($field, 'nilai') ||
                            str_starts_with($field, 'Nilai') ||
                            str_starts_with($field, 'JumlahSkor') ||
                            str_starts_with($field, 'SkorTambahan')
                        ) {
                            $data[$field] = 0;
                        }
                    }
                }

                Log::info('Loaded data with defaults:', $data);

                $this->form->fill($data);
                $this->data = $data;
                $this->formDataForJS = $data;
            } else {
                $defaultData = [
                    'user_id' => $userId,
                    'period_id' => $periodId,
                ];

                $this->form->fill($defaultData);
                $this->data = $defaultData;
                $this->formDataForJS = $defaultData;
            }
        } catch (\Exception $e) {
            Log::error('Error loading PointA data:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body('Terjadi kesalahan saat memuat data.')
                ->danger()
                ->send();
        }
    }

    public function form(Form $form): Form
    {
        // HANYA buat form schema jika ada periode aktif
        if (!$this->hasActivePeriod) {
            return $form;
        }

        $schema = [
            Hidden::make('user_id')->default(auth()->id()),
            Hidden::make('period_id')->default($this->getActivePeriodId()),

            // A1-A13
            Hidden::make('A1'),
            Hidden::make('A2'),
            Hidden::make('A3'),
            Hidden::make('A4'),
            Hidden::make('A5'),
            Hidden::make('A6'),
            Hidden::make('A7'),
            Hidden::make('A8'),
            Hidden::make('A9'),
            Hidden::make('A10'),
            Hidden::make('A11'),
            Hidden::make('A12'),
            Hidden::make('A13'),

            // Semua skor
            Hidden::make('scorA1'),
            Hidden::make('scorA2'),
            Hidden::make('scorA3'),
            Hidden::make('scorA4'),
            Hidden::make('scorA5'),
            Hidden::make('scorA6'),
            Hidden::make('scorA7'),
            Hidden::make('scorA8'),
            Hidden::make('scorA9'),
            Hidden::make('scorA10'),
            Hidden::make('scorA11'),
            Hidden::make('scorA12'),
            Hidden::make('scorA13'),

            Hidden::make('scorMaxA1'),
            Hidden::make('scorMaxA2'),
            Hidden::make('scorMaxA3'),
            Hidden::make('scorMaxA4'),
            Hidden::make('scorMaxA5'),
            Hidden::make('scorMaxA6'),
            Hidden::make('scorMaxA7'),
            Hidden::make('scorMaxA8'),
            Hidden::make('scorMaxA9'),
            Hidden::make('scorMaxA10'),
            Hidden::make('scorMaxA11'),
            Hidden::make('scorMaxA12'),
            Hidden::make('scorMaxA13'),

            Hidden::make('scorSubItemA1'),
            Hidden::make('scorSubItemA2'),
            Hidden::make('scorSubItemA3'),
            Hidden::make('scorSubItemA4'),
            Hidden::make('scorSubItemA5'),
            Hidden::make('scorSubItemA6'),
            Hidden::make('scorSubItemA7'),
            Hidden::make('scorSubItemA8'),
            Hidden::make('scorSubItemA9'),
            Hidden::make('scorSubItemA10'),
            Hidden::make('scorSubItemA11'),
            Hidden::make('scorSubItemA12'),
            Hidden::make('scorSubItemA13'),

            // Tambahan A11
            Hidden::make('JumlahYangDihasilkanA11_5'),
            Hidden::make('JumlahSkorYangDiHasilkanA11_5'),
            Hidden::make('JumlahSkorYangDiHasilkanBobotSubItemA11_5'),
            Hidden::make('SkorTambahanA11_5'),
            Hidden::make('SkorTambahanJumlahA11_5'),
            Hidden::make('SkorTambahanJumlahBobotSubItemA11_5'),

            // Tambahan A12
            Hidden::make('JumlahYangDihasilkanA12_3'),
            Hidden::make('JumlahYangDihasilkanA12_4'),
            Hidden::make('JumlahYangDihasilkanA12_5'),
            Hidden::make('SkorTambahanA12_3'),
            Hidden::make('SkorTambahanA12_4'),
            Hidden::make('SkorTambahanA12_5'),
            Hidden::make('SkorTambahanJumlahA12'),
            Hidden::make('JumlahSkorYangDiHasilkanA12'),
            Hidden::make('SkorTambahanJumlahSkorA12'),
            Hidden::make('SkorTambahanJumlahBobotSubItemA12'),

            // Hasil akhir
            Hidden::make('TotalSkorPendidikanPointA'),
            Hidden::make('TotalKelebihanA11'),
            Hidden::make('TotalKelebihanA12'),
            Hidden::make('TotalKelebihanSkor'),
            Hidden::make('nilaiPendidikandanPengajaran'),
            Hidden::make('NilaiTambahPendidikanDanPengajaran'),
            Hidden::make('NilaiTotalPendidikanDanPengajaran'),

            // File paths (hidden)
            Hidden::make('fileA1'),
            Hidden::make('fileA2'),
            Hidden::make('fileA3'),
            Hidden::make('fileA4'),
            Hidden::make('fileA5'),
            Hidden::make('fileA6'),
            Hidden::make('fileA7'),
            Hidden::make('fileA8'),
            Hidden::make('fileA9'),
            Hidden::make('fileA10'),
            Hidden::make('fileA11'),
            Hidden::make('fileA12'),
            Hidden::make('fileA13'),
        ];

        return $form->schema($schema)->statePath('data');
    }

    public function save(): void
    {
        // HANYA bisa save jika ada periode aktif
        if (!$this->hasActivePeriod) {
            Notification::make()
                ->title('Akses Ditolak!')
                ->body('Tidak dapat menyimpan data karena tidak ada periode aktif.')
                ->danger()
                ->send();
            return;
        }

        try {
            // Validasi file
            $this->validate();

            $data = $this->form->getState();

            // Pastikan user_id dan period_id
            if (!isset($data['user_id'])) {
                $data['user_id'] = auth()->id();
            }

            $periodId = $this->getActivePeriodId();
            if (!$data['period_id'] && $periodId) {
                $data['period_id'] = $periodId;
            }

            // Handle file uploads
            $fileFields = [
                'fileA1',
                'fileA2',
                'fileA3',
                'fileA4',
                'fileA5',
                'fileA6',
                'fileA7',
                'fileA8',
                'fileA9',
                'fileA10',
                'fileA11',
                'fileA12',
                'fileA13'
            ];

            foreach ($fileFields as $field) {
                if ($this->{$field}) {
                    $path = $this->{$field}->store("point-a/documents/" . auth()->id(), 'public');
                    $data[$field] = $path;
                }
            }

            // Konversi nilai
            $data = $this->convertNumericValues($data);

            // Simpan
            $pointA = PointAModel::updateOrCreate(
                ['user_id' => $data['user_id'], 'period_id' => $data['period_id']],
                $data
            );

            Notification::make()
                ->title('Berhasil!')
                ->body('Data berhasil disimpan.')
                ->success()
                ->send();

            // Reset file properties
            $this->resetFileProperties();
            $this->loadData();
        } catch (\Exception $e) {
            Log::error('Save error:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    private function resetFileProperties(): void
    {
        $this->fileA1 = $this->fileA2 = $this->fileA3 = $this->fileA4 = $this->fileA5 =
            $this->fileA6 = $this->fileA7 = $this->fileA8 = $this->fileA9 = $this->fileA10 =
            $this->fileA11 = $this->fileA12 = $this->fileA13 = null;
    }

    private function convertNumericValues(array $data): array
    {
        $numericFields = [
            'A1',
            'A2',
            'A3',
            'A4',
            'A5',
            'A6',
            'A7',
            'A8',
            'A9',
            'A10',
            'A11',
            'A12',
            'A13',

            'scorA1',
            'scorA2',
            'scorA3',
            'scorA4',
            'scorA5',
            'scorA6',
            'scorA7',
            'scorA8',
            'scorA9',
            'scorA10',
            'scorA11',
            'scorA12',
            'scorA13',
            'scorMaxA1',
            'scorMaxA2',
            'scorMaxA3',
            'scorMaxA4',
            'scorMaxA5',
            'scorMaxA6',
            'scorMaxA7',
            'scorMaxA8',
            'scorMaxA9',
            'scorMaxA10',
            'scorMaxA11',
            'scorMaxA12',
            'scorMaxA13',
            'scorSubItemA1',
            'scorSubItemA2',
            'scorSubItemA3',
            'scorSubItemA4',
            'scorSubItemA5',
            'scorSubItemA6',
            'scorSubItemA7',
            'scorSubItemA8',
            'scorSubItemA9',
            'scorSubItemA10',
            'scorSubItemA11',
            'scorSubItemA12',
            'scorSubItemA13',

            'JumlahYangDihasilkanA11_5',
            'JumlahSkorYangDiHasilkanA11_5',
            'JumlahSkorYangDiHasilkanBobotSubItemA11_5',
            'SkorTambahanA11_5',
            'SkorTambahanJumlahA11_5',
            'SkorTambahanJumlahBobotSubItemA11_5',

            'JumlahYangDihasilkanA12_3',
            'JumlahYangDihasilkanA12_4',
            'JumlahYangDihasilkanA12_5',
            'SkorTambahanA12_3',
            'SkorTambahanA12_4',
            'SkorTambahanA12_5',
            'SkorTambahanJumlahA12',
            'JumlahSkorYangDiHasilkanA12',
            'SkorTambahanJumlahSkorA12',
            'SkorTambahanJumlahBobotSubItemA12',

            'TotalSkorPendidikanPointA',
            'TotalKelebihanA11',
            'TotalKelebihanA12',
            'TotalKelebihanSkor',
            'nilaiPendidikandanPengajaran',
            'NilaiTambahPendidikanDanPengajaran',
            'NilaiTotalPendidikanDanPengajaran'
        ];

        foreach ($numericFields as $field) {
            if (isset($data[$field])) {
                if ($data[$field] === '') {
                    if (
                        str_starts_with($field, 'scor') ||
                        str_starts_with($field, 'Total') ||
                        str_starts_with($field, 'nilai') ||
                        str_starts_with($field, 'Nilai') ||
                        str_starts_with($field, 'JumlahSkor') ||
                        str_starts_with($field, 'SkorTambahan')
                    ) {
                        $data[$field] = 0;
                    }
                } elseif (is_numeric($data[$field])) {
                    if (
                        in_array($field, ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'A9', 'A10', 'A11', 'A12', 'A13']) ||
                        str_starts_with($field, 'JumlahYangDihasilkan')
                    ) {
                        $data[$field] = (int) $data[$field];
                    } else {
                        $data[$field] = (float) $data[$field];
                    }
                }
            }
        }

        return $data;
    }
}
