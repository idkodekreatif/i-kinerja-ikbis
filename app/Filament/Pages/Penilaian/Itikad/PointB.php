<?php

namespace App\Filament\Pages\Penilaian\Itikad;

use App\Models\Penilaian\Itikad\PointB as PointBModel;
use App\Models\Setting\Period;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class PointB extends Page implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Penilaian Dosen';
    protected static string $view = 'filament.pages.penilaian.itikad.point-b';
    protected static ?string $title = 'Form Point B - Penelitian dan Karya Ilmiah';
    protected static ?string $slug = 'penilaian-dosen/itikad/point-b';

    public ?array $data = [];
    public array $formDataForJS = [];
    public $hasActivePeriod = false;
    public $activePeriod = null;

    public $fileB1, $fileB2, $fileB3, $fileB4, $fileB5, $fileB6, $fileB7, $fileB8,
        $fileB9, $fileB10, $fileB11, $fileB12, $fileB13, $fileB14, $fileB15,
        $fileB16, $fileB17, $fileB18;

    protected $rules = [
        'fileB1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB6' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB7' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB8' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB9' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB10' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB11' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB12' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB13' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB14' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB15' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB16' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB17' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileB18' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
    ];

    public function mount(): void
    {
        $this->checkActivePeriod();

        if ($this->hasActivePeriod) {
            $this->loadData();
        }
    }

    private function checkActivePeriod(): void
    {
        try {
            $this->activePeriod = Period::active()->first();
            $this->hasActivePeriod = !is_null($this->activePeriod);

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
        }
    }

    private function loadData(): void
    {
        try {
            $userId = auth()->id();
            $periodId = $this->activePeriod->id;

            $pointB = PointBModel::where('user_id', $userId)
                ->where('period_id', $periodId)
                ->first();

            if ($pointB) {
                $data = $pointB->toArray();

                // Set default 0 untuk field skor yang null
                $requiredFields = $this->getRequiredFields();
                foreach ($requiredFields as $field) {
                    if (!isset($data[$field]) || $data[$field] === null) {
                        if (
                            str_starts_with($field, 'scor') ||
                            str_starts_with($field, 'Total') ||
                            str_starts_with($field, 'Nilai') ||
                            str_starts_with($field, 'JumlahSkor') ||
                            str_starts_with($field, 'SkorTambahan') ||
                            str_starts_with($field, 'JumlahYangDihasilkan')
                        ) {
                            $data[$field] = 0;
                        }
                    }
                }

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
            Log::error('Error loading PointB data:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body('Terjadi kesalahan saat memuat data.')
                ->danger()
                ->send();
        }
    }

    private function getRequiredFields(): array
    {
        $fields = [];

        // B1-B18
        for ($i = 1; $i <= 18; $i++) {
            $fields[] = "B{$i}";
            $fields[] = "scorB{$i}";
            $fields[] = "scorMaxB{$i}";
            $fields[] = "scorSubItemB{$i}";
        }

        // Jumlah yang dihasilkan
        $jumlahFields = [
            'B1_2',
            'B1_3',
            'B1_4',
            'B1_5',
            'B2_4',
            'B2_5',
            'B3_4',
            'B3_5',
            'B5_5',
            'B6_5',
            'B7_5',
            'B9_3',
            'B9_5',
            'B10_3',
            'B10_5',
            'B11_5',
            'B12_5',
            'B13_3',
            'B13_4',
            'B13_5',
            'B14_2',
            'B14_3',
            'B14_4',
            'B14_5',
            'B15_3',
            'B15_4',
            'B15_5',
            'B17_2',
            'B17_3',
            'B17_4',
            'B17_5'
        ];

        foreach ($jumlahFields as $field) {
            $fields[] = "JumlahYangDihasilkan{$field}";
            $fields[] = "SkorTambahan{$field}";
        }

        // Total fields
        $totalFields = [
            'TotalSkorPenelitianPointB',
            'TotalKelebihaB1',
            'TotalKelebihaB2',
            'TotalKelebihaB3',
            'TotalKelebihaB5',
            'TotalKelebihaB6',
            'TotalKelebihaB7',
            'TotalKelebihaB9',
            'TotalKelebihaB10',
            'TotalKelebihaB11',
            'TotalKelebihaB12',
            'TotalKelebihaB13',
            'TotalKelebihaB14',
            'TotalKelebihaB15',
            'TotalKelebihaB17',
            'TotalKelebihanSkor',
            'NilaiPenelitian',
            'NilaiTambahPenelitian',
            'NilaiTotalPenelitiandanKaryaIlmiah'
        ];

        return array_merge($fields, $totalFields);
    }

    public function form(Form $form): Form
    {
        if (!$this->hasActivePeriod) {
            return $form;
        }

        $schema = [
            Hidden::make('user_id')->default(auth()->id()),
            Hidden::make('period_id')->default($this->activePeriod->id),

            // B1-B18
            ...$this->generateHiddenFields('B', 1, 18),

            // Semua skor
            ...$this->generateHiddenFields('scorB', 1, 18),
            ...$this->generateHiddenFields('scorMaxB', 1, 18),
            ...$this->generateHiddenFields('scorSubItemB', 1, 18),

            // Jumlah yang dihasilkan
            Hidden::make('JumlahYangDihasilkanB1_2'),
            Hidden::make('JumlahYangDihasilkanB1_3'),
            Hidden::make('JumlahYangDihasilkanB1_4'),
            Hidden::make('JumlahYangDihasilkanB1_5'),
            Hidden::make('JumlahYangDihasilkanB2_4'),
            Hidden::make('JumlahYangDihasilkanB2_5'),
            Hidden::make('JumlahYangDihasilkanB3_4'),
            Hidden::make('JumlahYangDihasilkanB3_5'),
            Hidden::make('JumlahYangDihasilkanB5_5'),
            Hidden::make('JumlahYangDihasilkanB6_5'),
            Hidden::make('JumlahYangDihasilkanB7_5'),
            Hidden::make('JumlahYangDihasilkanB9_3'),
            Hidden::make('JumlahYangDihasilkanB9_5'),
            Hidden::make('JumlahYangDihasilkanB10_3'),
            Hidden::make('JumlahYangDihasilkanB10_5'),
            Hidden::make('JumlahYangDihasilkanB11_5'),
            Hidden::make('JumlahYangDihasilkanB12_5'),
            Hidden::make('JumlahYangDihasilkanB13_3'),
            Hidden::make('JumlahYangDihasilkanB13_4'),
            Hidden::make('JumlahYangDihasilkanB13_5'),
            Hidden::make('JumlahYangDihasilkanB14_2'),
            Hidden::make('JumlahYangDihasilkanB14_3'),
            Hidden::make('JumlahYangDihasilkanB14_4'),
            Hidden::make('JumlahYangDihasilkanB14_5'),
            Hidden::make('JumlahYangDihasilkanB15_3'),
            Hidden::make('JumlahYangDihasilkanB15_4'),
            Hidden::make('JumlahYangDihasilkanB15_5'),
            Hidden::make('JumlahYangDihasilkanB17_2'),
            Hidden::make('JumlahYangDihasilkanB17_3'),
            Hidden::make('JumlahYangDihasilkanB17_4'),
            Hidden::make('JumlahYangDihasilkanB17_5'),

            // File paths
            ...$this->generateHiddenFields('fileB', 1, 18),

            // Total fields
            Hidden::make('TotalSkorPenelitianPointB'),
            Hidden::make('TotalKelebihaB1'),
            Hidden::make('TotalKelebihaB2'),
            Hidden::make('TotalKelebihaB3'),
            Hidden::make('TotalKelebihaB5'),
            Hidden::make('TotalKelebihaB6'),
            Hidden::make('TotalKelebihaB7'),
            Hidden::make('TotalKelebihaB9'),
            Hidden::make('TotalKelebihaB10'),
            Hidden::make('TotalKelebihaB11'),
            Hidden::make('TotalKelebihaB12'),
            Hidden::make('TotalKelebihaB13'),
            Hidden::make('TotalKelebihaB14'),
            Hidden::make('TotalKelebihaB15'),
            Hidden::make('TotalKelebihaB17'),
            Hidden::make('TotalKelebihanSkor'),
            Hidden::make('NilaiPenelitian'),
            Hidden::make('NilaiTambahPenelitian'),
            Hidden::make('NilaiTotalPenelitiandanKaryaIlmiah'),
        ];

        return $form->schema($schema)->statePath('data');
    }

    private function generateHiddenFields(string $prefix, int $start, int $end): array
    {
        $fields = [];
        for ($i = $start; $i <= $end; $i++) {
            $fields[] = Hidden::make("{$prefix}{$i}");
        }
        return $fields;
    }

    public function save(): void
    {
        if (!$this->hasActivePeriod) {
            Notification::make()
                ->title('Akses Ditolak!')
                ->body('Tidak dapat menyimpan data karena tidak ada periode aktif.')
                ->danger()
                ->send();
            return;
        }

        try {
            $this->validate();

            $data = $this->form->getState();

            if (!isset($data['user_id'])) {
                $data['user_id'] = auth()->id();
            }

            $periodId = $this->getActivePeriodId();
            if (!$data['period_id'] && $periodId) {
                $data['period_id'] = $periodId;
            }

            // Handle file uploads
            for ($i = 1; $i <= 18; $i++) {
                $field = "fileB{$i}";
                if ($this->{$field}) {
                    $path = $this->{$field}->store("point-b/documents/" . auth()->id(), 'public');
                    $data[$field] = $path;
                }
            }

            $data = $this->convertNumericValues($data);

            $pointB = PointBModel::updateOrCreate(
                ['user_id' => $data['user_id'], 'period_id' => $data['period_id']],
                $data
            );

            Notification::make()
                ->title('Berhasil!')
                ->body('Data Point B berhasil disimpan.')
                ->success()
                ->send();

            $this->resetFileProperties();
            $this->loadData();
        } catch (\Exception $e) {
            Log::error('Save error PointB:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body($e->getMessage())
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

    private function resetFileProperties(): void
    {
        for ($i = 1; $i <= 18; $i++) {
            $field = "fileB{$i}";
            $this->{$field} = null;
        }
    }

    private function convertNumericValues(array $data): array
    {
        $numericFields = $this->getRequiredFields();

        foreach ($numericFields as $field) {
            if (isset($data[$field])) {
                if ($data[$field] === '') {
                    if (
                        str_starts_with($field, 'scor') ||
                        str_starts_with($field, 'Total') ||
                        str_starts_with($field, 'Nilai') ||
                        str_starts_with($field, 'JumlahSkor') ||
                        str_starts_with($field, 'SkorTambahan')
                    ) {
                        $data[$field] = 0;
                    }
                } elseif (is_numeric($data[$field])) {
                    if (str_starts_with($field, 'B') && strlen($field) <= 3) {
                        $data[$field] = (int) $data[$field];
                    } elseif (str_starts_with($field, 'JumlahYangDihasilkan')) {
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
