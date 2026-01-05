<?php

namespace App\Filament\Pages\Penilaian\Itikad;

use App\Models\Penilaian\Itikad\PointE as PointEModel;
use App\Models\Setting\Period;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class PointE extends Page implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Penilaian Dosen';
    protected static string $view = 'filament.pages.penilaian.itikad.point-e';
    protected static ?string $title = 'Form Point E - Pengabdian Kepada Institusi & Pengembangan Diri';
    protected static ?string $slug = 'penilaian-dosen/itikad/point-e';

    public ?array $data = [];
    public array $formDataForJS = [];

    // Tambahkan property untuk kontrol tampilan
    public $hasActivePeriod = false;
    public $activePeriod = null;

    // Tambahkan property untuk file upload
    public $fileE1_1, $fileE1_2, $fileE1_3, $fileE1_4, $fileE1_5, $fileE1_6,
        $fileE2_1, $fileE2_2, $fileE2_3, $fileE2_4;

    protected $rules = [
        'fileE1_1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE1_2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE1_3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE1_4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE1_5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE1_6' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE2_1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE2_2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE2_3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileE2_4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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

            $pointE = PointEModel::where('user_id', $userId)
                ->where('period_id', $periodId)
                ->first();

            if ($pointE) {
                $data = $pointE->toArray();

                // Pastikan semua field skor ada, meskipun null
                $requiredFields = [
                    // Radio buttons
                    'E1_1',
                    'E1_2',
                    'E1_3',
                    'E1_4',
                    'E1_5',
                    'E1_6',
                    'E2_1',
                    'E2_2',
                    'E2_3',
                    'E2_4',

                    // Skor utama
                    'scorE1_1',
                    'scorE1_2',
                    'scorE1_3',
                    'scorE1_4',
                    'scorE1_5',
                    'scorE1_6',
                    'scorE2_1',
                    'scorE2_2',
                    'scorE2_3',
                    'scorE2_4',

                    'scorMaxE1_1',
                    'scorMaxE1_2',
                    'scorMaxE1_3',
                    'scorMaxE1_4',
                    'scorMaxE1_5',
                    'scorMaxE1_6',
                    'scorMaxE2_1',
                    'scorMaxE2_2',
                    'scorMaxE2_3',
                    'scorMaxE2_4',

                    'scorSubItemE1_1',
                    'scorSubItemE1_2',
                    'scorSubItemE1_3',
                    'scorSubItemE1_4',
                    'scorSubItemE1_5',
                    'scorSubItemE1_6',
                    'scorSubItemE2_1',
                    'scorSubItemE2_2',
                    'scorSubItemE2_3',
                    'scorSubItemE2_4',

                    // Hasil akhir
                    'SumSkor',
                    'NilaiUnsurPengabdian'
                ];

                // Set default 0 untuk field skor yang null
                foreach ($requiredFields as $field) {
                    if (!isset($data[$field]) || $data[$field] === null) {
                        if (
                            str_starts_with($field, 'scor') ||
                            str_starts_with($field, 'SumSkor') ||
                            str_starts_with($field, 'Nilai')
                        ) {
                            $data[$field] = 0;
                        }
                    }
                }

                Log::info('Loaded Point E data with defaults:', $data);

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
            Log::error('Error loading PointE data:', ['error' => $e->getMessage()]);
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

            // Radio buttons E1_1 sampai E2_4
            Hidden::make('E1_1'),
            Hidden::make('E1_2'),
            Hidden::make('E1_3'),
            Hidden::make('E1_4'),
            Hidden::make('E1_5'),
            Hidden::make('E1_6'),
            Hidden::make('E2_1'),
            Hidden::make('E2_2'),
            Hidden::make('E2_3'),
            Hidden::make('E2_4'),

            // Skor utama
            Hidden::make('scorE1_1'),
            Hidden::make('scorE1_2'),
            Hidden::make('scorE1_3'),
            Hidden::make('scorE1_4'),
            Hidden::make('scorE1_5'),
            Hidden::make('scorE1_6'),
            Hidden::make('scorE2_1'),
            Hidden::make('scorE2_2'),
            Hidden::make('scorE2_3'),
            Hidden::make('scorE2_4'),

            Hidden::make('scorMaxE1_1'),
            Hidden::make('scorMaxE1_2'),
            Hidden::make('scorMaxE1_3'),
            Hidden::make('scorMaxE1_4'),
            Hidden::make('scorMaxE1_5'),
            Hidden::make('scorMaxE1_6'),
            Hidden::make('scorMaxE2_1'),
            Hidden::make('scorMaxE2_2'),
            Hidden::make('scorMaxE2_3'),
            Hidden::make('scorMaxE2_4'),

            Hidden::make('scorSubItemE1_1'),
            Hidden::make('scorSubItemE1_2'),
            Hidden::make('scorSubItemE1_3'),
            Hidden::make('scorSubItemE1_4'),
            Hidden::make('scorSubItemE1_5'),
            Hidden::make('scorSubItemE1_6'),
            Hidden::make('scorSubItemE2_1'),
            Hidden::make('scorSubItemE2_2'),
            Hidden::make('scorSubItemE2_3'),
            Hidden::make('scorSubItemE2_4'),

            // Hasil akhir
            Hidden::make('SumSkor'),
            Hidden::make('NilaiUnsurPengabdian'),

            // File paths (hidden)
            Hidden::make('fileE1_1'),
            Hidden::make('fileE1_2'),
            Hidden::make('fileE1_3'),
            Hidden::make('fileE1_4'),
            Hidden::make('fileE1_5'),
            Hidden::make('fileE1_6'),
            Hidden::make('fileE2_1'),
            Hidden::make('fileE2_2'),
            Hidden::make('fileE2_3'),
            Hidden::make('fileE2_4'),
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
                'fileE1_1',
                'fileE1_2',
                'fileE1_3',
                'fileE1_4',
                'fileE1_5',
                'fileE1_6',
                'fileE2_1',
                'fileE2_2',
                'fileE2_3',
                'fileE2_4'
            ];

            foreach ($fileFields as $field) {
                if ($this->{$field}) {
                    $path = $this->{$field}->store("point-e/documents/" . auth()->id(), 'public');
                    $data[$field] = $path;
                }
            }

            // Konversi nilai
            $data = $this->convertNumericValues($data);

            // Simpan
            $pointE = PointEModel::updateOrCreate(
                ['user_id' => $data['user_id'], 'period_id' => $data['period_id']],
                $data
            );

            Notification::make()
                ->title('Berhasil!')
                ->body('Data Pengabdian Kepada Institusi & Pengembangan Diri berhasil disimpan.')
                ->success()
                ->send();

            // Reset file properties
            $this->resetFileProperties();
            $this->loadData();
        } catch (\Exception $e) {
            Log::error('Save error Point E:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    private function resetFileProperties(): void
    {
        $this->fileE1_1 = $this->fileE1_2 = $this->fileE1_3 = $this->fileE1_4 = $this->fileE1_5 = $this->fileE1_6 =
            $this->fileE2_1 = $this->fileE2_2 = $this->fileE2_3 = $this->fileE2_4 = null;
    }

    private function convertNumericValues(array $data): array
    {
        $numericFields = [
            // Radio buttons
            'E1_1',
            'E1_2',
            'E1_3',
            'E1_4',
            'E1_5',
            'E1_6',
            'E2_1',
            'E2_2',
            'E2_3',
            'E2_4',

            // Skor utama
            'scorE1_1',
            'scorE1_2',
            'scorE1_3',
            'scorE1_4',
            'scorE1_5',
            'scorE1_6',
            'scorE2_1',
            'scorE2_2',
            'scorE2_3',
            'scorE2_4',
            'scorMaxE1_1',
            'scorMaxE1_2',
            'scorMaxE1_3',
            'scorMaxE1_4',
            'scorMaxE1_5',
            'scorMaxE1_6',
            'scorMaxE2_1',
            'scorMaxE2_2',
            'scorMaxE2_3',
            'scorMaxE2_4',
            'scorSubItemE1_1',
            'scorSubItemE1_2',
            'scorSubItemE1_3',
            'scorSubItemE1_4',
            'scorSubItemE1_5',
            'scorSubItemE1_6',
            'scorSubItemE2_1',
            'scorSubItemE2_2',
            'scorSubItemE2_3',
            'scorSubItemE2_4',

            // Hasil akhir
            'SumSkor',
            'NilaiUnsurPengabdian'
        ];

        foreach ($numericFields as $field) {
            if (isset($data[$field])) {
                if ($data[$field] === '') {
                    if (
                        str_starts_with($field, 'scor') ||
                        str_starts_with($field, 'SumSkor') ||
                        str_starts_with($field, 'Nilai')
                    ) {
                        $data[$field] = 0;
                    }
                } elseif (is_numeric($data[$field])) {
                    if (
                        in_array($field, ['E1_1', 'E1_2', 'E1_3', 'E1_4', 'E1_5', 'E1_6', 'E2_1', 'E2_2', 'E2_3', 'E2_4'])
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
