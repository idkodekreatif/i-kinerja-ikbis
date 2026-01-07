<?php

namespace App\Filament\Pages\Penilaian\Itikad;

use App\Models\Penilaian\Itikad\PointD as PointDModel;
use App\Models\Setting\Period;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class PointD extends Page implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Penilaian Dosen';
    protected static string $view = 'filament.pages.penilaian.itikad.point-d';
    protected static ?string $title = 'Form Point D - Unsur Penunjang';
    protected static ?string $slug = 'penilaian-dosen/itikad/point-d';

    public ?array $data = [];
    public array $formDataForJS = [];

    // Tambahkan property untuk kontrol tampilan
    public $hasActivePeriod = false;
    public $activePeriod = null;

    // Tambahkan property untuk file upload
    public $fileD1, $fileD2, $fileD3, $fileD4, $fileD5, $fileD6, $fileD7,
        $fileD8, $fileD9, $fileD10, $fileD11;

    protected $rules = [
        'fileD1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD6' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD7' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD8' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD9' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD10' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileD11' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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

            $pointD = PointDModel::where('user_id', $userId)
                ->where('period_id', $periodId)
                ->first();

            if ($pointD) {
                $data = $pointD->toArray();

                // Pastikan semua field skor ada, meskipun null
                $requiredFields = [
                    // D1-D11
                    'D1',
                    'D2',
                    'D3',
                    'D4',
                    'D5',
                    'D6',
                    'D7',
                    'D8',
                    'D9',
                    'D10',
                    'D11',

                    // Skor utama
                    'scorD1',
                    'scorD2',
                    'scorD3',
                    'scorD4',
                    'scorD5',
                    'scorD6',
                    'scorD7',
                    'scorD8',
                    'scorD9',
                    'scorD10',
                    'scorD11',
                    'scorMaxD1',
                    'scorMaxD2',
                    'scorMaxD3',
                    'scorMaxD4',
                    'scorMaxD5',
                    'scorMaxD6',
                    'scorMaxD7',
                    'scorMaxD8',
                    'scorMaxD9',
                    'scorMaxD10',
                    'scorMaxD11',
                    'scorSubItemD1',
                    'scorSubItemD2',
                    'scorSubItemD3',
                    'scorSubItemD4',
                    'scorSubItemD5',
                    'scorSubItemD6',
                    'scorSubItemD7',
                    'scorSubItemD8',
                    'scorSubItemD9',
                    'scorSubItemD10',
                    'scorSubItemD11',

                    // D.2 - Tambahan
                    'JumlahYangDihasilkanD2_2',
                    'JumlahYangDihasilkanD2_3',
                    'JumlahYangDihasilkanD2_4',
                    'JumlahYangDihasilkanD2_5',
                    'JumlahSkorYangDiHasilkanD2',
                    'SkorTambahanD2_2',
                    'SkorTambahanD2_3',
                    'SkorTambahanD2_4',
                    'SkorTambahanD2_5',
                    'SkorTambahanJumlahD2',
                    'SkorTambahanJumlahSkorD2',
                    'SkorTambahanJumlahBobotSubItemD2',

                    // D.3 - Tambahan
                    'JumlahYangDihasilkanD3_2',
                    'JumlahYangDihasilkanD3_3',
                    'JumlahYangDihasilkanD3_4',
                    'JumlahYangDihasilkanD3_5',
                    'JumlahSkorYangDiHasilkanD3',
                    'SkorTambahanD3_2',
                    'SkorTambahanD3_3',
                    'SkorTambahanD3_4',
                    'SkorTambahanD3_5',
                    'SkorTambahanJumlahD3',
                    'SkorTambahanJumlahSkorD3',
                    'SkorTambahanJumlahBobotSubItemD3',

                    // D.4 - Tambahan
                    'JumlahYangDihasilkanD4_3',
                    'JumlahYangDihasilkanD4_4',
                    'JumlahYangDihasilkanD4_5',
                    'JumlahSkorYangDiHasilkanD4',
                    'SkorTambahanD4_3',
                    'SkorTambahanD4_4',
                    'SkorTambahanD4_5',
                    'SkorTambahanJumlahD4',
                    'SkorTambahanJumlahSkorD4',
                    'SkorTambahanJumlahBobotSubItemD4',

                    // D.5 - Tambahan
                    'JumlahYangDihasilkanD5_3',
                    'JumlahYangDihasilkanD5_4',
                    'JumlahYangDihasilkanD5_5',
                    'JumlahSkorYangDiHasilkanD5',
                    'SkorTambahanD5_3',
                    'SkorTambahanD5_4',
                    'SkorTambahanD5_5',
                    'SkorTambahanJumlahD5',
                    'SkorTambahanJumlahSkorD5',
                    'SkorTambahanJumlahBobotSubItemD5',

                    // D.6 - Tambahan
                    'JumlahYangDihasilkanD6_2',
                    'JumlahYangDihasilkanD6_3',
                    'JumlahYangDihasilkanD6_4',
                    'JumlahYangDihasilkanD6_5',
                    'JumlahSkorYangDiHasilkanD6',
                    'SkorTambahanD6_2',
                    'SkorTambahanD6_3',
                    'SkorTambahanD6_4',
                    'SkorTambahanD6_5',
                    'SkorTambahanJumlahD6',
                    'SkorTambahanJumlahSkorD6',
                    'SkorTambahanJumlahBobotSubItemD6',

                    // D.7 - Tambahan
                    'JumlahYangDihasilkanD7_5',
                    'JumlahSkorYangDiHasilkanD7',
                    'SkorTambahanD7_5',
                    'SkorTambahanJumlahD7',
                    'SkorTambahanJumlahSkorD7',
                    'SkorTambahanJumlahBobotSubItemD7',

                    // D.8 - Tambahan
                    'JumlahYangDihasilkanD8_3',
                    'JumlahYangDihasilkanD8_4',
                    'JumlahYangDihasilkanD8_5',
                    'JumlahSkorYangDiHasilkanD8',
                    'SkorTambahanD8_3',
                    'SkorTambahanD8_4',
                    'SkorTambahanD8_5',
                    'SkorTambahanJumlahD8',
                    'SkorTambahanJumlahSkorD8',
                    'SkorTambahanJumlahBobotSubItemD8',

                    // D.9 - Tambahan
                    'JumlahYangDihasilkanD9_2',
                    'JumlahYangDihasilkanD9_3',
                    'JumlahYangDihasilkanD9_4',
                    'JumlahYangDihasilkanD9_5',
                    'JumlahSkorYangDiHasilkanD9',
                    'SkorTambahanD9_2',
                    'SkorTambahanD9_3',
                    'SkorTambahanD9_4',
                    'SkorTambahanD9_5',
                    'SkorTambahanJumlahD9',
                    'SkorTambahanJumlahSkorD9',
                    'SkorTambahanJumlahBobotSubItemD9',

                    // D.10 - Tambahan
                    'JumlahYangDihasilkanD10_3',
                    'JumlahYangDihasilkanD10_4',
                    'JumlahYangDihasilkanD10_5',
                    'JumlahSkorYangDiHasilkanD10',
                    'SkorTambahanD10_3',
                    'SkorTambahanD10_4',
                    'SkorTambahanD10_5',
                    'SkorTambahanJumlahD10',
                    'SkorTambahanJumlahSkorD10',
                    'SkorTambahanJumlahBobotSubItemD10',

                    // D.11 - Tambahan
                    'JumlahYangDihasilkanD11_3',
                    'JumlahYangDihasilkanD11_4',
                    'JumlahYangDihasilkanD11_5',
                    'JumlahSkorYangDiHasilkanD11',
                    'SkorTambahanD11_3',
                    'SkorTambahanD11_4',
                    'SkorTambahanD11_5',
                    'SkorTambahanJumlahD11',
                    'SkorTambahanJumlahSkorD11',
                    'SkorTambahanJumlahBobotSubItemD11',

                    // Hasil akhir
                    'TotalSkorUnsurPenunjang',
                    'TotalKelebihaD2',
                    'TotalKelebihaD3',
                    'TotalKelebihaD4',
                    'TotalKelebihaD5',
                    'TotalKelebihaD6',
                    'TotalKelebihaD7',
                    'TotalKelebihaD8',
                    'TotalKelebihaD9',
                    'TotalKelebihaD10',
                    'TotalKelebihaD11',
                    'TotalKelebihanSkor',
                    'NilaiUnsurPenunjang',
                    'NilaiTambahUnsurPenunjang',
                    'ResultSumNilaiTotalUnsurPenunjang'
                ];

                // Set default 0 untuk field skor yang null
                foreach ($requiredFields as $field) {
                    if (!isset($data[$field]) || $data[$field] === null) {
                        if (
                            str_starts_with($field, 'scor') ||
                            str_starts_with($field, 'Total') ||
                            str_starts_with($field, 'Nilai') ||
                            str_starts_with($field, 'JumlahSkor') ||
                            str_starts_with($field, 'SkorTambahan') ||
                            str_starts_with($field, 'ResultSum')
                        ) {
                            $data[$field] = 0;
                        }
                    }
                }

                Log::info('Loaded Point D data with defaults:', $data);

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
            Log::error('Error loading PointD data:', ['error' => $e->getMessage()]);
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

            // D1-D11
            Hidden::make('D1'),
            Hidden::make('D2'),
            Hidden::make('D3'),
            Hidden::make('D4'),
            Hidden::make('D5'),
            Hidden::make('D6'),
            Hidden::make('D7'),
            Hidden::make('D8'),
            Hidden::make('D9'),
            Hidden::make('D10'),
            Hidden::make('D11'),

            // Semua skor utama
            Hidden::make('scorD1'),
            Hidden::make('scorD2'),
            Hidden::make('scorD3'),
            Hidden::make('scorD4'),
            Hidden::make('scorD5'),
            Hidden::make('scorD6'),
            Hidden::make('scorD7'),
            Hidden::make('scorD8'),
            Hidden::make('scorD9'),
            Hidden::make('scorD10'),
            Hidden::make('scorD11'),

            Hidden::make('scorMaxD1'),
            Hidden::make('scorMaxD2'),
            Hidden::make('scorMaxD3'),
            Hidden::make('scorMaxD4'),
            Hidden::make('scorMaxD5'),
            Hidden::make('scorMaxD6'),
            Hidden::make('scorMaxD7'),
            Hidden::make('scorMaxD8'),
            Hidden::make('scorMaxD9'),
            Hidden::make('scorMaxD10'),
            Hidden::make('scorMaxD11'),

            Hidden::make('scorSubItemD1'),
            Hidden::make('scorSubItemD2'),
            Hidden::make('scorSubItemD3'),
            Hidden::make('scorSubItemD4'),
            Hidden::make('scorSubItemD5'),
            Hidden::make('scorSubItemD6'),
            Hidden::make('scorSubItemD7'),
            Hidden::make('scorSubItemD8'),
            Hidden::make('scorSubItemD9'),
            Hidden::make('scorSubItemD10'),
            Hidden::make('scorSubItemD11'),

            // D.2 - Tambahan
            Hidden::make('JumlahYangDihasilkanD2_2'),
            Hidden::make('JumlahYangDihasilkanD2_3'),
            Hidden::make('JumlahYangDihasilkanD2_4'),
            Hidden::make('JumlahYangDihasilkanD2_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD2'),
            Hidden::make('SkorTambahanD2_2'),
            Hidden::make('SkorTambahanD2_3'),
            Hidden::make('SkorTambahanD2_4'),
            Hidden::make('SkorTambahanD2_5'),
            Hidden::make('SkorTambahanJumlahD2'),
            Hidden::make('SkorTambahanJumlahSkorD2'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD2'),

            // D.3 - Tambahan
            Hidden::make('JumlahYangDihasilkanD3_2'),
            Hidden::make('JumlahYangDihasilkanD3_3'),
            Hidden::make('JumlahYangDihasilkanD3_4'),
            Hidden::make('JumlahYangDihasilkanD3_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD3'),
            Hidden::make('SkorTambahanD3_2'),
            Hidden::make('SkorTambahanD3_3'),
            Hidden::make('SkorTambahanD3_4'),
            Hidden::make('SkorTambahanD3_5'),
            Hidden::make('SkorTambahanJumlahD3'),
            Hidden::make('SkorTambahanJumlahSkorD3'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD3'),

            // D.4 - Tambahan
            Hidden::make('JumlahYangDihasilkanD4_3'),
            Hidden::make('JumlahYangDihasilkanD4_4'),
            Hidden::make('JumlahYangDihasilkanD4_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD4'),
            Hidden::make('SkorTambahanD4_3'),
            Hidden::make('SkorTambahanD4_4'),
            Hidden::make('SkorTambahanD4_5'),
            Hidden::make('SkorTambahanJumlahD4'),
            Hidden::make('SkorTambahanJumlahSkorD4'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD4'),

            // D.5 - Tambahan
            Hidden::make('JumlahYangDihasilkanD5_3'),
            Hidden::make('JumlahYangDihasilkanD5_4'),
            Hidden::make('JumlahYangDihasilkanD5_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD5'),
            Hidden::make('SkorTambahanD5_3'),
            Hidden::make('SkorTambahanD5_4'),
            Hidden::make('SkorTambahanD5_5'),
            Hidden::make('SkorTambahanJumlahD5'),
            Hidden::make('SkorTambahanJumlahSkorD5'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD5'),

            // D.6 - Tambahan
            Hidden::make('JumlahYangDihasilkanD6_2'),
            Hidden::make('JumlahYangDihasilkanD6_3'),
            Hidden::make('JumlahYangDihasilkanD6_4'),
            Hidden::make('JumlahYangDihasilkanD6_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD6'),
            Hidden::make('SkorTambahanD6_2'),
            Hidden::make('SkorTambahanD6_3'),
            Hidden::make('SkorTambahanD6_4'),
            Hidden::make('SkorTambahanD6_5'),
            Hidden::make('SkorTambahanJumlahD6'),
            Hidden::make('SkorTambahanJumlahSkorD6'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD6'),

            // D.7 - Tambahan
            Hidden::make('JumlahYangDihasilkanD7_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD7'),
            Hidden::make('SkorTambahanD7_5'),
            Hidden::make('SkorTambahanJumlahD7'),
            Hidden::make('SkorTambahanJumlahSkorD7'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD7'),

            // D.8 - Tambahan
            Hidden::make('JumlahYangDihasilkanD8_3'),
            Hidden::make('JumlahYangDihasilkanD8_4'),
            Hidden::make('JumlahYangDihasilkanD8_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD8'),
            Hidden::make('SkorTambahanD8_3'),
            Hidden::make('SkorTambahanD8_4'),
            Hidden::make('SkorTambahanD8_5'),
            Hidden::make('SkorTambahanJumlahD8'),
            Hidden::make('SkorTambahanJumlahSkorD8'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD8'),

            // D.9 - Tambahan
            Hidden::make('JumlahYangDihasilkanD9_2'),
            Hidden::make('JumlahYangDihasilkanD9_3'),
            Hidden::make('JumlahYangDihasilkanD9_4'),
            Hidden::make('JumlahYangDihasilkanD9_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD9'),
            Hidden::make('SkorTambahanD9_2'),
            Hidden::make('SkorTambahanD9_3'),
            Hidden::make('SkorTambahanD9_4'),
            Hidden::make('SkorTambahanD9_5'),
            Hidden::make('SkorTambahanJumlahD9'),
            Hidden::make('SkorTambahanJumlahSkorD9'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD9'),

            // D.10 - Tambahan
            Hidden::make('JumlahYangDihasilkanD10_3'),
            Hidden::make('JumlahYangDihasilkanD10_4'),
            Hidden::make('JumlahYangDihasilkanD10_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD10'),
            Hidden::make('SkorTambahanD10_3'),
            Hidden::make('SkorTambahanD10_4'),
            Hidden::make('SkorTambahanD10_5'),
            Hidden::make('SkorTambahanJumlahD10'),
            Hidden::make('SkorTambahanJumlahSkorD10'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD10'),

            // D.11 - Tambahan
            Hidden::make('JumlahYangDihasilkanD11_3'),
            Hidden::make('JumlahYangDihasilkanD11_4'),
            Hidden::make('JumlahYangDihasilkanD11_5'),
            Hidden::make('JumlahSkorYangDiHasilkanD11'),
            Hidden::make('SkorTambahanD11_3'),
            Hidden::make('SkorTambahanD11_4'),
            Hidden::make('SkorTambahanD11_5'),
            Hidden::make('SkorTambahanJumlahD11'),
            Hidden::make('SkorTambahanJumlahSkorD11'),
            Hidden::make('SkorTambahanJumlahBobotSubItemD11'),

            // Hasil akhir
            Hidden::make('TotalSkorUnsurPenunjang'),
            Hidden::make('TotalKelebihaD2'),
            Hidden::make('TotalKelebihaD3'),
            Hidden::make('TotalKelebihaD4'),
            Hidden::make('TotalKelebihaD5'),
            Hidden::make('TotalKelebihaD6'),
            Hidden::make('TotalKelebihaD7'),
            Hidden::make('TotalKelebihaD8'),
            Hidden::make('TotalKelebihaD9'),
            Hidden::make('TotalKelebihaD10'),
            Hidden::make('TotalKelebihaD11'),
            Hidden::make('TotalKelebihanSkor'),
            Hidden::make('NilaiUnsurPenunjang'),
            Hidden::make('NilaiTambahUnsurPenunjang'),
            Hidden::make('ResultSumNilaiTotalUnsurPenunjang'),

            // File paths (hidden)
            Hidden::make('fileD1'),
            Hidden::make('fileD2'),
            Hidden::make('fileD3'),
            Hidden::make('fileD4'),
            Hidden::make('fileD5'),
            Hidden::make('fileD6'),
            Hidden::make('fileD7'),
            Hidden::make('fileD8'),
            Hidden::make('fileD9'),
            Hidden::make('fileD10'),
            Hidden::make('fileD11'),
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
                'fileD1',
                'fileD2',
                'fileD3',
                'fileD4',
                'fileD5',
                'fileD6',
                'fileD7',
                'fileD8',
                'fileD9',
                'fileD10',
                'fileD11'
            ];

            foreach ($fileFields as $field) {
                if ($this->{$field}) {
                    $path = $this->{$field}->store("point-d/documents/" . auth()->id(), 'public');
                    $data[$field] = $path;
                }
            }

            // Konversi nilai
            $data = $this->convertNumericValues($data);

            // Simpan
            $pointD = PointDModel::updateOrCreate(
                ['user_id' => $data['user_id'], 'period_id' => $data['period_id']],
                $data
            );

            Notification::make()
                ->title('Berhasil!')
                ->body('Data Unsur Penunjang berhasil disimpan.')
                ->success()
                ->send();

            // Reset file properties
            $this->resetFileProperties();
            $this->loadData();
        } catch (\Exception $e) {
            Log::error('Save error Point D:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    private function resetFileProperties(): void
    {
        $this->fileD1 = $this->fileD2 = $this->fileD3 = $this->fileD4 = $this->fileD5 =
            $this->fileD6 = $this->fileD7 = $this->fileD8 = $this->fileD9 = $this->fileD10 =
            $this->fileD11 = null;
    }

    private function convertNumericValues(array $data): array
    {
        $numericFields = [
            // D1-D11
            'D1',
            'D2',
            'D3',
            'D4',
            'D5',
            'D6',
            'D7',
            'D8',
            'D9',
            'D10',
            'D11',

            // Skor utama
            'scorD1',
            'scorD2',
            'scorD3',
            'scorD4',
            'scorD5',
            'scorD6',
            'scorD7',
            'scorD8',
            'scorD9',
            'scorD10',
            'scorD11',
            'scorMaxD1',
            'scorMaxD2',
            'scorMaxD3',
            'scorMaxD4',
            'scorMaxD5',
            'scorMaxD6',
            'scorMaxD7',
            'scorMaxD8',
            'scorMaxD9',
            'scorMaxD10',
            'scorMaxD11',
            'scorSubItemD1',
            'scorSubItemD2',
            'scorSubItemD3',
            'scorSubItemD4',
            'scorSubItemD5',
            'scorSubItemD6',
            'scorSubItemD7',
            'scorSubItemD8',
            'scorSubItemD9',
            'scorSubItemD10',
            'scorSubItemD11',

            // D.2
            'JumlahYangDihasilkanD2_2',
            'JumlahYangDihasilkanD2_3',
            'JumlahYangDihasilkanD2_4',
            'JumlahYangDihasilkanD2_5',
            'JumlahSkorYangDiHasilkanD2',
            'SkorTambahanD2_2',
            'SkorTambahanD2_3',
            'SkorTambahanD2_4',
            'SkorTambahanD2_5',
            'SkorTambahanJumlahD2',
            'SkorTambahanJumlahSkorD2',
            'SkorTambahanJumlahBobotSubItemD2',

            // D.3
            'JumlahYangDihasilkanD3_2',
            'JumlahYangDihasilkanD3_3',
            'JumlahYangDihasilkanD3_4',
            'JumlahYangDihasilkanD3_5',
            'JumlahSkorYangDiHasilkanD3',
            'SkorTambahanD3_2',
            'SkorTambahanD3_3',
            'SkorTambahanD3_4',
            'SkorTambahanD3_5',
            'SkorTambahanJumlahD3',
            'SkorTambahanJumlahSkorD3',
            'SkorTambahanJumlahBobotSubItemD3',

            // D.4
            'JumlahYangDihasilkanD4_3',
            'JumlahYangDihasilkanD4_4',
            'JumlahYangDihasilkanD4_5',
            'JumlahSkorYangDiHasilkanD4',
            'SkorTambahanD4_3',
            'SkorTambahanD4_4',
            'SkorTambahanD4_5',
            'SkorTambahanJumlahD4',
            'SkorTambahanJumlahSkorD4',
            'SkorTambahanJumlahBobotSubItemD4',

            // D.5
            'JumlahYangDihasilkanD5_3',
            'JumlahYangDihasilkanD5_4',
            'JumlahYangDihasilkanD5_5',
            'JumlahSkorYangDiHasilkanD5',
            'SkorTambahanD5_3',
            'SkorTambahanD5_4',
            'SkorTambahanD5_5',
            'SkorTambahanJumlahD5',
            'SkorTambahanJumlahSkorD5',
            'SkorTambahanJumlahBobotSubItemD5',

            // D.6
            'JumlahYangDihasilkanD6_2',
            'JumlahYangDihasilkanD6_3',
            'JumlahYangDihasilkanD6_4',
            'JumlahYangDihasilkanD6_5',
            'JumlahSkorYangDiHasilkanD6',
            'SkorTambahanD6_2',
            'SkorTambahanD6_3',
            'SkorTambahanD6_4',
            'SkorTambahanD6_5',
            'SkorTambahanJumlahD6',
            'SkorTambahanJumlahSkorD6',
            'SkorTambahanJumlahBobotSubItemD6',

            // D.7
            'JumlahYangDihasilkanD7_5',
            'JumlahSkorYangDiHasilkanD7',
            'SkorTambahanD7_5',
            'SkorTambahanJumlahD7',
            'SkorTambahanJumlahSkorD7',
            'SkorTambahanJumlahBobotSubItemD7',

            // D.8
            'JumlahYangDihasilkanD8_3',
            'JumlahYangDihasilkanD8_4',
            'JumlahYangDihasilkanD8_5',
            'JumlahSkorYangDiHasilkanD8',
            'SkorTambahanD8_3',
            'SkorTambahanD8_4',
            'SkorTambahanD8_5',
            'SkorTambahanJumlahD8',
            'SkorTambahanJumlahSkorD8',
            'SkorTambahanJumlahBobotSubItemD8',

            // D.9
            'JumlahYangDihasilkanD9_2',
            'JumlahYangDihasilkanD9_3',
            'JumlahYangDihasilkanD9_4',
            'JumlahYangDihasilkanD9_5',
            'JumlahSkorYangDiHasilkanD9',
            'SkorTambahanD9_2',
            'SkorTambahanD9_3',
            'SkorTambahanD9_4',
            'SkorTambahanD9_5',
            'SkorTambahanJumlahD9',
            'SkorTambahanJumlahSkorD9',
            'SkorTambahanJumlahBobotSubItemD9',

            // D.10
            'JumlahYangDihasilkanD10_3',
            'JumlahYangDihasilkanD10_4',
            'JumlahYangDihasilkanD10_5',
            'JumlahSkorYangDiHasilkanD10',
            'SkorTambahanD10_3',
            'SkorTambahanD10_4',
            'SkorTambahanD10_5',
            'SkorTambahanJumlahD10',
            'SkorTambahanJumlahSkorD10',
            'SkorTambahanJumlahBobotSubItemD10',

            // D.11
            'JumlahYangDihasilkanD11_3',
            'JumlahYangDihasilkanD11_4',
            'JumlahYangDihasilkanD11_5',
            'JumlahSkorYangDiHasilkanD11',
            'SkorTambahanD11_3',
            'SkorTambahanD11_4',
            'SkorTambahanD11_5',
            'SkorTambahanJumlahD11',
            'SkorTambahanJumlahSkorD11',
            'SkorTambahanJumlahBobotSubItemD11',

            // Hasil akhir
            'TotalSkorUnsurPenunjang',
            'TotalKelebihaD2',
            'TotalKelebihaD3',
            'TotalKelebihaD4',
            'TotalKelebihaD5',
            'TotalKelebihaD6',
            'TotalKelebihaD7',
            'TotalKelebihaD8',
            'TotalKelebihaD9',
            'TotalKelebihaD10',
            'TotalKelebihaD11',
            'TotalKelebihanSkor',
            'NilaiUnsurPenunjang',
            'NilaiTambahUnsurPenunjang',
            'ResultSumNilaiTotalUnsurPenunjang'
        ];

        foreach ($numericFields as $field) {
            if (isset($data[$field])) {
                if ($data[$field] === '') {
                    if (
                        str_starts_with($field, 'scor') ||
                        str_starts_with($field, 'Total') ||
                        str_starts_with($field, 'Nilai') ||
                        str_starts_with($field, 'JumlahSkor') ||
                        str_starts_with($field, 'SkorTambahan') ||
                        str_starts_with($field, 'ResultSum')
                    ) {
                        $data[$field] = 0;
                    }
                } elseif (is_numeric($data[$field])) {
                    if (
                        in_array($field, ['D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8', 'D9', 'D10', 'D11']) ||
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
