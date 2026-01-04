<?php

namespace App\Filament\Pages\Penilaian\Itikad;

use App\Models\Penilaian\Itikad\PointC as PointCModel;
use App\Models\Setting\Period;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class PointC extends Page implements HasForms
{
    use InteractsWithForms;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Penilaian Dosen';
    protected static string $view = 'filament.pages.penilaian.itikad.point-c';
    protected static ?string $title = 'Form Point C - Pengabdian Kepada Masyarakat';
    protected static ?string $slug = 'penilaian-dosen/itikad/point-c';

    public ?array $data = [];
    public array $formDataForJS = [];

    // Tambahkan property untuk kontrol tampilan
    public $hasActivePeriod = false;
    public $activePeriod = null;

    // File upload properties
    public $fileC1, $fileC2, $fileC3, $fileC4, $fileC5, $fileC6, $fileC7, $fileC8, $fileC9;

    protected $rules = [
        'fileC1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC4' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC5' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC6' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC7' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC8' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'fileC9' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
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

            $pointC = PointCModel::where('user_id', $userId)
                ->where('period_id', $periodId)
                ->first();

            if ($pointC) {
                $data = $pointC->toArray();

                // Daftar semua field yang diperlukan untuk Point C
                $requiredFields = $this->getRequiredFields();

                // Set default 0 untuk field skor yang null
                foreach ($requiredFields as $field) {
                    if (!isset($data[$field]) || $data[$field] === null) {
                        if ($this->isNumericField($field)) {
                            $data[$field] = 0;
                        }
                    }
                }

                Log::info('Loaded Point C data with defaults:', $data);

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
            Log::error('Error loading PointC data:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body('Terjadi kesalahan saat memuat data.')
                ->danger()
                ->send();
        }
    }

    private function getRequiredFields(): array
    {
        return [
            // C1-C9
            'C1',
            'C2',
            'C3',
            'C4',
            'C5',
            'C6',
            'C7',
            'C8',
            'C9',

            // Skor utama
            'scorC1',
            'scorC2',
            'scorC3',
            'scorC4',
            'scorC5',
            'scorC6',
            'scorC7',
            'scorC8',
            'scorC9',
            'scorMaxC1',
            'scorMaxC2',
            'scorMaxC3',
            'scorMaxC4',
            'scorMaxC5',
            'scorMaxC6',
            'scorMaxC7',
            'scorMaxC8',
            'scorMaxC9',
            'scorSubItemC1',
            'scorSubItemC2',
            'scorSubItemC3',
            'scorSubItemC4',
            'scorSubItemC5',
            'scorSubItemC6',
            'scorSubItemC7',
            'scorSubItemC8',
            'scorSubItemC9',

            // Jumlah yang dihasilkan untuk setiap C
            'JumlahYangDihasilkanC1_2',
            'JumlahYangDihasilkanC1_3',
            'JumlahYangDihasilkanC1_4',
            'JumlahYangDihasilkanC1_5',
            'JumlahYangDihasilkanC2_2',
            'JumlahYangDihasilkanC2_3',
            'JumlahYangDihasilkanC2_4',
            'JumlahYangDihasilkanC2_5',
            'JumlahYangDihasilkanC3_4',
            'JumlahYangDihasilkanC3_5',
            'JumlahYangDihasilkanC4_2',
            'JumlahYangDihasilkanC4_3',
            'JumlahYangDihasilkanC4_4',
            'JumlahYangDihasilkanC4_5',
            'JumlahYangDihasilkanC5_2',
            'JumlahYangDihasilkanC5_3',
            'JumlahYangDihasilkanC5_4',
            'JumlahYangDihasilkanC5_5',
            'JumlahYangDihasilkanC6_2',
            'JumlahYangDihasilkanC6_3',
            'JumlahYangDihasilkanC6_4',
            'JumlahYangDihasilkanC6_5',
            'JumlahYangDihasilkanC7_2',
            'JumlahYangDihasilkanC7_3',
            'JumlahYangDihasilkanC7_4',
            'JumlahYangDihasilkanC7_5',
            'JumlahYangDihasilkanC8_2',
            'JumlahYangDihasilkanC8_3',
            'JumlahYangDihasilkanC8_4',
            'JumlahYangDihasilkanC8_5',
            'JumlahYangDihasilkanC9_2',
            'JumlahYangDihasilkanC9_3',
            'JumlahYangDihasilkanC9_4',
            'JumlahYangDihasilkanC9_5',

            // Skor tambahan
            'SkorTambahanC1_2',
            'SkorTambahanC1_3',
            'SkorTambahanC1_4',
            'SkorTambahanC1_5',
            'SkorTambahanC2_2',
            'SkorTambahanC2_3',
            'SkorTambahanC2_4',
            'SkorTambahanC2_5',
            'SkorTambahanC3_4',
            'SkorTambahanC3_5',
            'SkorTambahanC4_2',
            'SkorTambahanC4_3',
            'SkorTambahanC4_4',
            'SkorTambahanC4_5',
            'SkorTambahanC5_2',
            'SkorTambahanC5_3',
            'SkorTambahanC5_4',
            'SkorTambahanC5_5',
            'SkorTambahanC6_2',
            'SkorTambahanC6_3',
            'SkorTambahanC6_4',
            'SkorTambahanC6_5',
            'SkorTambahanC7_2',
            'SkorTambahanC7_3',
            'SkorTambahanC7_4',
            'SkorTambahanC7_5',
            'SkorTambahanC8_2',
            'SkorTambahanC8_3',
            'SkorTambahanC8_4',
            'SkorTambahanC8_5',
            'SkorTambahanC9_2',
            'SkorTambahanC9_3',
            'SkorTambahanC9_4',
            'SkorTambahanC9_5',

            // Jumlah skor yang dihasilkan
            'JumlahSkorYangDiHasilkanC1',
            'JumlahSkorYangDiHasilkanC2',
            'JumlahSkorYangDiHasilkanC3',
            'JumlahSkorYangDiHasilkanC4',
            'JumlahSkorYangDiHasilkanC5',
            'JumlahSkorYangDiHasilkanC6',
            'JumlahSkorYangDiHasilkanC7',
            'JumlahSkorYangDiHasilkanC8',
            'JumlahSkorYangDiHasilkanC9',

            // Skor tambahan jumlah
            'SkorTambahanJumlahC1',
            'SkorTambahanJumlahC2',
            'SkorTambahanJumlahC3',
            'SkorTambahanJumlahC4',
            'SkorTambahanJumlahC5',
            'SkorTambahanJumlahC6',
            'SkorTambahanJumlahC7',
            'SkorTambahanJumlahC8',
            'SkorTambahanJumlahC9',

            // Skor tambahan jumlah skor
            'SkorTambahanJumlahSkorC1',
            'SkorTambahanJumlahSkorC2',
            'SkorTambahanJumlahSkorC3',
            'SkorTambahanJumlahSkorC4',
            'SkorTambahanJumlahSkorC5',
            'SkorTambahanJumlahSkorC6',
            'SkorTambahanJumlahSkorC7',
            'SkorTambahanJumlahSkorC8',
            'SkorTambahanJumlahSkorC9',

            // Skor tambahan jumlah bobot sub item
            'SkorTambahanJumlahBobotSubItemC1',
            'SkorTambahanJumlahBobotSubItemC2',
            'SkorTambahanJumlahBobotSubItemC3',
            'SkorTambahanJumlahBobotSubItemC4',
            'SkorTambahanJumlahBobotSubItemC5',
            'SkorTambahanJumlahBobotSubItemC6',
            'SkorTambahanJumlahBobotSubItemC7',
            'SkorTambahanJumlahBobotSubItemC8',
            'SkorTambahanJumlahBobotSubItemC9',

            // Hasil akhir
            'TotalSkorPengabdianKepadaMasyarakat',
            'TotalKelebihaC1',
            'TotalKelebihaC2',
            'TotalKelebihaC3',
            'TotalKelebihaC4',
            'TotalKelebihaC5',
            'TotalKelebihaC6',
            'TotalKelebihaC7',
            'TotalKelebihaC8',
            'TotalKelebihaC9',
            'TotalKelebihanSkor',
            'NilaiPengabdianKepadaMasyarakat',
            'NilaiTambahPengabdianKepadaMasyarakat',
            'NilaiTotalPengabdianKepadaMasyarakat',

            // File paths
            'fileC1',
            'fileC2',
            'fileC3',
            'fileC4',
            'fileC5',
            'fileC6',
            'fileC7',
            'fileC8',
            'fileC9',
        ];
    }

    private function isNumericField(string $field): bool
    {
        return str_starts_with($field, 'scor') ||
            str_starts_with($field, 'Total') ||
            str_starts_with($field, 'Nilai') ||
            str_starts_with($field, 'JumlahSkor') ||
            str_starts_with($field, 'SkorTambahan') ||
            str_starts_with($field, 'JumlahYangDihasilkan');
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

            // C1-C9 radio values
            Hidden::make('C1'),
            Hidden::make('C2'),
            Hidden::make('C3'),
            Hidden::make('C4'),
            Hidden::make('C5'),
            Hidden::make('C6'),
            Hidden::make('C7'),
            Hidden::make('C8'),
            Hidden::make('C9'),

            // Skor utama
            Hidden::make('scorC1'),
            Hidden::make('scorC2'),
            Hidden::make('scorC3'),
            Hidden::make('scorC4'),
            Hidden::make('scorC5'),
            Hidden::make('scorC6'),
            Hidden::make('scorC7'),
            Hidden::make('scorC8'),
            Hidden::make('scorC9'),

            Hidden::make('scorMaxC1'),
            Hidden::make('scorMaxC2'),
            Hidden::make('scorMaxC3'),
            Hidden::make('scorMaxC4'),
            Hidden::make('scorMaxC5'),
            Hidden::make('scorMaxC6'),
            Hidden::make('scorMaxC7'),
            Hidden::make('scorMaxC8'),
            Hidden::make('scorMaxC9'),

            Hidden::make('scorSubItemC1'),
            Hidden::make('scorSubItemC2'),
            Hidden::make('scorSubItemC3'),
            Hidden::make('scorSubItemC4'),
            Hidden::make('scorSubItemC5'),
            Hidden::make('scorSubItemC6'),
            Hidden::make('scorSubItemC7'),
            Hidden::make('scorSubItemC8'),
            Hidden::make('scorSubItemC9'),

            // Jumlah yang dihasilkan untuk setiap C
            Hidden::make('JumlahYangDihasilkanC1_2'),
            Hidden::make('JumlahYangDihasilkanC1_3'),
            Hidden::make('JumlahYangDihasilkanC1_4'),
            Hidden::make('JumlahYangDihasilkanC1_5'),
            Hidden::make('JumlahYangDihasilkanC2_2'),
            Hidden::make('JumlahYangDihasilkanC2_3'),
            Hidden::make('JumlahYangDihasilkanC2_4'),
            Hidden::make('JumlahYangDihasilkanC2_5'),
            Hidden::make('JumlahYangDihasilkanC3_4'),
            Hidden::make('JumlahYangDihasilkanC3_5'),
            Hidden::make('JumlahYangDihasilkanC4_2'),
            Hidden::make('JumlahYangDihasilkanC4_3'),
            Hidden::make('JumlahYangDihasilkanC4_4'),
            Hidden::make('JumlahYangDihasilkanC4_5'),
            Hidden::make('JumlahYangDihasilkanC5_2'),
            Hidden::make('JumlahYangDihasilkanC5_3'),
            Hidden::make('JumlahYangDihasilkanC5_4'),
            Hidden::make('JumlahYangDihasilkanC5_5'),
            Hidden::make('JumlahYangDihasilkanC6_2'),
            Hidden::make('JumlahYangDihasilkanC6_3'),
            Hidden::make('JumlahYangDihasilkanC6_4'),
            Hidden::make('JumlahYangDihasilkanC6_5'),
            Hidden::make('JumlahYangDihasilkanC7_2'),
            Hidden::make('JumlahYangDihasilkanC7_3'),
            Hidden::make('JumlahYangDihasilkanC7_4'),
            Hidden::make('JumlahYangDihasilkanC7_5'),
            Hidden::make('JumlahYangDihasilkanC8_2'),
            Hidden::make('JumlahYangDihasilkanC8_3'),
            Hidden::make('JumlahYangDihasilkanC8_4'),
            Hidden::make('JumlahYangDihasilkanC8_5'),
            Hidden::make('JumlahYangDihasilkanC9_2'),
            Hidden::make('JumlahYangDihasilkanC9_3'),
            Hidden::make('JumlahYangDihasilkanC9_4'),
            Hidden::make('JumlahYangDihasilkanC9_5'),

            // Skor tambahan
            Hidden::make('SkorTambahanC1_2'),
            Hidden::make('SkorTambahanC1_3'),
            Hidden::make('SkorTambahanC1_4'),
            Hidden::make('SkorTambahanC1_5'),
            Hidden::make('SkorTambahanC2_2'),
            Hidden::make('SkorTambahanC2_3'),
            Hidden::make('SkorTambahanC2_4'),
            Hidden::make('SkorTambahanC2_5'),
            Hidden::make('SkorTambahanC3_4'),
            Hidden::make('SkorTambahanC3_5'),
            Hidden::make('SkorTambahanC4_2'),
            Hidden::make('SkorTambahanC4_3'),
            Hidden::make('SkorTambahanC4_4'),
            Hidden::make('SkorTambahanC4_5'),
            Hidden::make('SkorTambahanC5_2'),
            Hidden::make('SkorTambahanC5_3'),
            Hidden::make('SkorTambahanC5_4'),
            Hidden::make('SkorTambahanC5_5'),
            Hidden::make('SkorTambahanC6_2'),
            Hidden::make('SkorTambahanC6_3'),
            Hidden::make('SkorTambahanC6_4'),
            Hidden::make('SkorTambahanC6_5'),
            Hidden::make('SkorTambahanC7_2'),
            Hidden::make('SkorTambahanC7_3'),
            Hidden::make('SkorTambahanC7_4'),
            Hidden::make('SkorTambahanC7_5'),
            Hidden::make('SkorTambahanC8_2'),
            Hidden::make('SkorTambahanC8_3'),
            Hidden::make('SkorTambahanC8_4'),
            Hidden::make('SkorTambahanC8_5'),
            Hidden::make('SkorTambahanC9_2'),
            Hidden::make('SkorTambahanC9_3'),
            Hidden::make('SkorTambahanC9_4'),
            Hidden::make('SkorTambahanC9_5'),

            // Jumlah skor yang dihasilkan
            Hidden::make('JumlahSkorYangDiHasilkanC1'),
            Hidden::make('JumlahSkorYangDiHasilkanC2'),
            Hidden::make('JumlahSkorYangDiHasilkanC3'),
            Hidden::make('JumlahSkorYangDiHasilkanC4'),
            Hidden::make('JumlahSkorYangDiHasilkanC5'),
            Hidden::make('JumlahSkorYangDiHasilkanC6'),
            Hidden::make('JumlahSkorYangDiHasilkanC7'),
            Hidden::make('JumlahSkorYangDiHasilkanC8'),
            Hidden::make('JumlahSkorYangDiHasilkanC9'),

            // Skor tambahan jumlah
            Hidden::make('SkorTambahanJumlahC1'),
            Hidden::make('SkorTambahanJumlahC2'),
            Hidden::make('SkorTambahanJumlahC3'),
            Hidden::make('SkorTambahanJumlahC4'),
            Hidden::make('SkorTambahanJumlahC5'),
            Hidden::make('SkorTambahanJumlahC6'),
            Hidden::make('SkorTambahanJumlahC7'),
            Hidden::make('SkorTambahanJumlahC8'),
            Hidden::make('SkorTambahanJumlahC9'),

            // Skor tambahan jumlah skor
            Hidden::make('SkorTambahanJumlahSkorC1'),
            Hidden::make('SkorTambahanJumlahSkorC2'),
            Hidden::make('SkorTambahanJumlahSkorC3'),
            Hidden::make('SkorTambahanJumlahSkorC4'),
            Hidden::make('SkorTambahanJumlahSkorC5'),
            Hidden::make('SkorTambahanJumlahSkorC6'),
            Hidden::make('SkorTambahanJumlahSkorC7'),
            Hidden::make('SkorTambahanJumlahSkorC8'),
            Hidden::make('SkorTambahanJumlahSkorC9'),

            // Skor tambahan jumlah bobot sub item
            Hidden::make('SkorTambahanJumlahBobotSubItemC1'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC2'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC3'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC4'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC5'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC6'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC7'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC8'),
            Hidden::make('SkorTambahanJumlahBobotSubItemC9'),

            // Hasil akhir
            Hidden::make('TotalSkorPengabdianKepadaMasyarakat'),
            Hidden::make('TotalKelebihaC1'),
            Hidden::make('TotalKelebihaC2'),
            Hidden::make('TotalKelebihaC3'),
            Hidden::make('TotalKelebihaC4'),
            Hidden::make('TotalKelebihaC5'),
            Hidden::make('TotalKelebihaC6'),
            Hidden::make('TotalKelebihaC7'),
            Hidden::make('TotalKelebihaC8'),
            Hidden::make('TotalKelebihaC9'),
            Hidden::make('TotalKelebihanSkor'),
            Hidden::make('NilaiPengabdianKepadaMasyarakat'),
            Hidden::make('NilaiTambahPengabdianKepadaMasyarakat'),
            Hidden::make('NilaiTotalPengabdianKepadaMasyarakat'),

            // File paths (hidden)
            Hidden::make('fileC1'),
            Hidden::make('fileC2'),
            Hidden::make('fileC3'),
            Hidden::make('fileC4'),
            Hidden::make('fileC5'),
            Hidden::make('fileC6'),
            Hidden::make('fileC7'),
            Hidden::make('fileC8'),
            Hidden::make('fileC9'),
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
                'fileC1',
                'fileC2',
                'fileC3',
                'fileC4',
                'fileC5',
                'fileC6',
                'fileC7',
                'fileC8',
                'fileC9'
            ];

            foreach ($fileFields as $field) {
                if ($this->{$field}) {
                    $path = $this->{$field}->store("point-c/documents/" . auth()->id(), 'public');
                    $data[$field] = $path;
                }
            }

            // Konversi nilai
            $data = $this->convertNumericValues($data);

            // Simpan
            $pointC = PointCModel::updateOrCreate(
                ['user_id' => $data['user_id'], 'period_id' => $data['period_id']],
                $data
            );

            Notification::make()
                ->title('Berhasil!')
                ->body('Data Point C berhasil disimpan.')
                ->success()
                ->send();

            // Reset file properties
            $this->resetFileProperties();
            $this->loadData();
        } catch (\Exception $e) {
            Log::error('Save error Point C:', ['error' => $e->getMessage()]);
            Notification::make()
                ->title('Error!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    private function resetFileProperties(): void
    {
        $this->fileC1 = $this->fileC2 = $this->fileC3 = $this->fileC4 = $this->fileC5 =
            $this->fileC6 = $this->fileC7 = $this->fileC8 = $this->fileC9 = null;
    }

    private function convertNumericValues(array $data): array
    {
        $numericFields = [
            // C1-C9
            'C1',
            'C2',
            'C3',
            'C4',
            'C5',
            'C6',
            'C7',
            'C8',
            'C9',

            // Skor utama
            'scorC1',
            'scorC2',
            'scorC3',
            'scorC4',
            'scorC5',
            'scorC6',
            'scorC7',
            'scorC8',
            'scorC9',
            'scorMaxC1',
            'scorMaxC2',
            'scorMaxC3',
            'scorMaxC4',
            'scorMaxC5',
            'scorMaxC6',
            'scorMaxC7',
            'scorMaxC8',
            'scorMaxC9',
            'scorSubItemC1',
            'scorSubItemC2',
            'scorSubItemC3',
            'scorSubItemC4',
            'scorSubItemC5',
            'scorSubItemC6',
            'scorSubItemC7',
            'scorSubItemC8',
            'scorSubItemC9',

            // Jumlah yang dihasilkan (integer)
            'JumlahYangDihasilkanC1_2',
            'JumlahYangDihasilkanC1_3',
            'JumlahYangDihasilkanC1_4',
            'JumlahYangDihasilkanC1_5',
            'JumlahYangDihasilkanC2_2',
            'JumlahYangDihasilkanC2_3',
            'JumlahYangDihasilkanC2_4',
            'JumlahYangDihasilkanC2_5',
            'JumlahYangDihasilkanC3_4',
            'JumlahYangDihasilkanC3_5',
            'JumlahYangDihasilkanC4_2',
            'JumlahYangDihasilkanC4_3',
            'JumlahYangDihasilkanC4_4',
            'JumlahYangDihasilkanC4_5',
            'JumlahYangDihasilkanC5_2',
            'JumlahYangDihasilkanC5_3',
            'JumlahYangDihasilkanC5_4',
            'JumlahYangDihasilkanC5_5',
            'JumlahYangDihasilkanC6_2',
            'JumlahYangDihasilkanC6_3',
            'JumlahYangDihasilkanC6_4',
            'JumlahYangDihasilkanC6_5',
            'JumlahYangDihasilkanC7_2',
            'JumlahYangDihasilkanC7_3',
            'JumlahYangDihasilkanC7_4',
            'JumlahYangDihasilkanC7_5',
            'JumlahYangDihasilkanC8_2',
            'JumlahYangDihasilkanC8_3',
            'JumlahYangDihasilkanC8_4',
            'JumlahYangDihasilkanC8_5',
            'JumlahYangDihasilkanC9_2',
            'JumlahYangDihasilkanC9_3',
            'JumlahYangDihasilkanC9_4',
            'JumlahYangDihasilkanC9_5',

            // Skor tambahan (float)
            'SkorTambahanC1_2',
            'SkorTambahanC1_3',
            'SkorTambahanC1_4',
            'SkorTambahanC1_5',
            'SkorTambahanC2_2',
            'SkorTambahanC2_3',
            'SkorTambahanC2_4',
            'SkorTambahanC2_5',
            'SkorTambahanC3_4',
            'SkorTambahanC3_5',
            'SkorTambahanC4_2',
            'SkorTambahanC4_3',
            'SkorTambahanC4_4',
            'SkorTambahanC4_5',
            'SkorTambahanC5_2',
            'SkorTambahanC5_3',
            'SkorTambahanC5_4',
            'SkorTambahanC5_5',
            'SkorTambahanC6_2',
            'SkorTambahanC6_3',
            'SkorTambahanC6_4',
            'SkorTambahanC6_5',
            'SkorTambahanC7_2',
            'SkorTambahanC7_3',
            'SkorTambahanC7_4',
            'SkorTambahanC7_5',
            'SkorTambahanC8_2',
            'SkorTambahanC8_3',
            'SkorTambahanC8_4',
            'SkorTambahanC8_5',
            'SkorTambahanC9_2',
            'SkorTambahanC9_3',
            'SkorTambahanC9_4',
            'SkorTambahanC9_5',

            // Jumlah skor yang dihasilkan (float)
            'JumlahSkorYangDiHasilkanC1',
            'JumlahSkorYangDiHasilkanC2',
            'JumlahSkorYangDiHasilkanC3',
            'JumlahSkorYangDiHasilkanC4',
            'JumlahSkorYangDiHasilkanC5',
            'JumlahSkorYangDiHasilkanC6',
            'JumlahSkorYangDiHasilkanC7',
            'JumlahSkorYangDiHasilkanC8',
            'JumlahSkorYangDiHasilkanC9',

            // Skor tambahan jumlah (float)
            'SkorTambahanJumlahC1',
            'SkorTambahanJumlahC2',
            'SkorTambahanJumlahC3',
            'SkorTambahanJumlahC4',
            'SkorTambahanJumlahC5',
            'SkorTambahanJumlahC6',
            'SkorTambahanJumlahC7',
            'SkorTambahanJumlahC8',
            'SkorTambahanJumlahC9',

            // Skor tambahan jumlah skor (float)
            'SkorTambahanJumlahSkorC1',
            'SkorTambahanJumlahSkorC2',
            'SkorTambahanJumlahSkorC3',
            'SkorTambahanJumlahSkorC4',
            'SkorTambahanJumlahSkorC5',
            'SkorTambahanJumlahSkorC6',
            'SkorTambahanJumlahSkorC7',
            'SkorTambahanJumlahSkorC8',
            'SkorTambahanJumlahSkorC9',

            // Skor tambahan jumlah bobot sub item (float)
            'SkorTambahanJumlahBobotSubItemC1',
            'SkorTambahanJumlahBobotSubItemC2',
            'SkorTambahanJumlahBobotSubItemC3',
            'SkorTambahanJumlahBobotSubItemC4',
            'SkorTambahanJumlahBobotSubItemC5',
            'SkorTambahanJumlahBobotSubItemC6',
            'SkorTambahanJumlahBobotSubItemC7',
            'SkorTambahanJumlahBobotSubItemC8',
            'SkorTambahanJumlahBobotSubItemC9',

            // Hasil akhir (float)
            'TotalSkorPengabdianKepadaMasyarakat',
            'TotalKelebihaC1',
            'TotalKelebihaC2',
            'TotalKelebihaC3',
            'TotalKelebihaC4',
            'TotalKelebihaC5',
            'TotalKelebihaC6',
            'TotalKelebihaC7',
            'TotalKelebihaC8',
            'TotalKelebihaC9',
            'TotalKelebihanSkor',
            'NilaiPengabdianKepadaMasyarakat',
            'NilaiTambahPengabdianKepadaMasyarakat',
            'NilaiTotalPengabdianKepadaMasyarakat',
        ];

        foreach ($numericFields as $field) {
            if (isset($data[$field])) {
                if ($data[$field] === '') {
                    // Jika field kosong dan termasuk field skor, set ke 0
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
                    // Konversi tipe data
                    if (
                        in_array($field, ['C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C7', 'C8', 'C9']) ||
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
