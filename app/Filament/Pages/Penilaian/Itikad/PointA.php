<?php

namespace App\Filament\Pages\Penilaian\Itikad;

use App\Models\Penilaian\Itikad\PointA as PointAModel;
use App\Models\Setting\Period;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
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
    use WithFileUploads; // TAMBAHKAN INI untuk Livewire file upload

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Penilaian Dosen';
    protected static string $view = 'filament.pages.penilaian.itikad.point-a';
    protected static ?string $title = 'Form Point A - Pendidikan dan Pengajaran';
    protected static ?string $slug = 'penilaian-dosen/itikad/point-a';

    public ?array $data = [];
    public array $formDataForJS = [];

    // Tambahkan property untuk file upload
    public $fileA1;
    public $fileA2;
    public $fileA3;
    public $fileA4;
    public $fileA5;
    public $fileA6;
    public $fileA7;
    public $fileA8;
    public $fileA9;
    public $fileA10;
    public $fileA11;
    public $fileA12;
    public $fileA13;

    // Tambahkan rules untuk file validation
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
        $this->loadData();
    }

    private function getActivePeriodId()
    {
        try {
            $activePeriod = Period::active()->first();

            Log::info('Active period found:', [
                'period' => $activePeriod ? [
                    'id' => $activePeriod->id,
                    'name' => $activePeriod->name,
                    'start_date' => $activePeriod->start_date,
                    'end_date' => $activePeriod->end_date,
                    'is_closed' => $activePeriod->is_closed,
                ] : 'No active period found'
            ]);

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
            $periodId = $this->getActivePeriodId();

            Log::info('Loading PointA data for:', [
                'user_id' => $userId,
                'period_id' => $periodId
            ]);

            if (!$periodId) {
                Log::warning('No active period found!');

                Notification::make()
                    ->title('Perhatian!')
                    ->body('Tidak ada periode penilaian aktif saat ini.')
                    ->warning()
                    ->persistent()
                    ->send();

                $defaultData = [
                    'user_id' => $userId,
                    'period_id' => null,
                ];

                $this->form->fill($defaultData);
                $this->data = $defaultData;
                $this->formDataForJS = $defaultData;

                return;
            }

            $pointA = PointAModel::where('user_id', $userId)
                ->where('period_id', $periodId)
                ->first();

            if ($pointA) {
                $data = $pointA->toArray();
                Log::info('Found existing data for user ' . $userId . ' and period ' . $periodId);

                $this->form->fill($data);
                $this->data = $data;
                $this->formDataForJS = $data;
            } else {
                Log::info('No existing data found, setting defaults');
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
                ->body('Terjadi kesalahan saat memuat data: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function form(Form $form): Form
    {
        $periodId = $this->getActivePeriodId();

        // Hanya hidden inputs, TANPA FileUpload
        $schema = [
            Hidden::make('user_id')->default(auth()->id()),
            Hidden::make('period_id')->default($periodId),

            // Semua field A1-A13
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

            // Semua field skor
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
        ];

        return $form->schema($schema)->statePath('data');
    }

    public function save(): void
    {
        try {
            // Validasi file upload
            $this->validate();

            // Ambil data dari form (TANPA file)
            $data = $this->form->getState();

            Log::info('PointA Save - Form Data Keys:', array_keys($data));

            // Pastikan user_id dan period_id ada
            if (!isset($data['user_id'])) {
                $data['user_id'] = auth()->id();
            }

            if (!isset($data['period_id']) || !$data['period_id']) {
                $periodId = $this->getActivePeriodId();
                if ($periodId) {
                    $data['period_id'] = $periodId;
                }
            }

            // Validasi period_id
            if (!isset($data['period_id']) || !$data['period_id']) {
                throw new \Exception('Tidak ada periode penilaian aktif.');
            }

            $period = Period::find($data['period_id']);
            if (!$period || !$period->isActive()) {
                throw new \Exception('Periode penilaian sudah tidak aktif.');
            }

            // Konversi nilai numerik
            $data = $this->convertNumericValues($data);

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
                    // Simpan file ke storage
                    $path = $this->{$field}->store("point-a/documents/" . auth()->id(), 'public');
                    $data[$field] = $path;
                }
            }

            // Simpan data
            $pointA = PointAModel::updateOrCreate(
                [
                    'user_id' => $data['user_id'],
                    'period_id' => $data['period_id']
                ],
                $data
            );

            Log::info('PointA Save - Success:', [
                'id' => $pointA->id,
                'user_id' => $pointA->user_id,
                'period_id' => $pointA->period_id
            ]);

            Notification::make()
                ->title('Data berhasil disimpan!')
                ->success()
                ->send();

            // Reset file properties
            $this->resetFileProperties();

            // Refresh data
            $this->loadData();
        } catch (\Exception $e) {
            Log::error('PointA Save Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            Notification::make()
                ->title('Terjadi kesalahan!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    private function resetFileProperties(): void
    {
        $this->fileA1 = null;
        $this->fileA2 = null;
        $this->fileA3 = null;
        $this->fileA4 = null;
        $this->fileA5 = null;
        $this->fileA6 = null;
        $this->fileA7 = null;
        $this->fileA8 = null;
        $this->fileA9 = null;
        $this->fileA10 = null;
        $this->fileA11 = null;
        $this->fileA12 = null;
        $this->fileA13 = null;
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
                } elseif (str_starts_with($field, 'JumlahYangDihasilkan')) {
                    $data[$field] = 0;
                }
            } else {
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
                    } else {
                        $data[$field] = null;
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
