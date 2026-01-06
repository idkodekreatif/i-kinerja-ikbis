<?php

namespace App\Filament\Pages\Penilaian;

use App\Models\Setting\Period;
use App\Models\Setting\Indikator\PredikatAssessment;
use App\Models\Setting\Indikator\KomponenPoin;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Response;

class RaportDosen extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.penilaian.raport-dosen';
    protected static ?string $navigationGroup = 'Penilaian';
    protected static ?string $navigationLabel = 'Raport Dosen';
    protected static ?int $navigationSort = 2;

    public ?array $data = [];
    public ?int $period_id = null;
    public $resultArray = [];
    public $periods = [];
    public $jabfung = [];
    public $jabfungName = '';
    public $selectedPeriodId = null;
    public $isLoading = false;
    public $activeJabatanCode = 'non_jad';

    public function mount(): void
    {
        $this->loadPeriods();
        $this->loadUserJabatan();

        // Set periode aktif default
        $activePeriod = Period::where('is_closed', 1)
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->first();

        if ($activePeriod) {
            $this->period_id = $activePeriod->id;
            $this->selectedPeriodId = $activePeriod->id;
            $this->loadRaportData();
        }

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('period_id')
                    ->label('Pilih Periode')
                    ->options(fn() => Period::orderBy('start_date', 'desc')
                        ->get()
                        ->pluck('name', 'id')
                        ->toArray())
                    ->required()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function ($state) {
                        $this->period_id = $state;
                        $this->selectedPeriodId = $state;
                        $this->loadRaportData();
                    }),
            ])
            ->statePath('data');
    }

    protected function loadPeriods(): void
    {
        $this->periods = Period::orderBy('start_date', 'desc')->get();
    }

    protected function loadUserJabatan(): void
    {
        $user = auth()->user();

        // Ambil jabatan fungsional
        $this->jabfung = $user->jabfung()->get() ?? collect();
        $this->jabfungName = $this->jabfung->isNotEmpty()
            ? $this->jabfung->pluck('name')->join(', ')
            : 'Non-JAD';

        // Tentukan kode jabatan untuk mapping
        $this->activeJabatanCode = $this->mapJabatanToCode($this->jabfungName);
    }

    protected function mapJabatanToCode($jabatanName): string
    {
        $jabatanName = strtolower(trim($jabatanName));

        if (str_contains($jabatanName, 'guru besar') || str_contains($jabatanName, 'profesor')) {
            return 'gb';
        } elseif (str_contains($jabatanName, 'lektor kepala') || str_contains($jabatanName, 'lk')) {
            return 'lk';
        } elseif (str_contains($jabatanName, 'lektor')) {
            return 'lektor';
        } elseif (str_contains($jabatanName, 'asisten ahli') || str_contains($jabatanName, 'aa')) {
            return 'aa';
        } else {
            return 'non_jad';
        }
    }

    protected function getStandarKomponen($type): float
    {
        $komponen = KomponenPoin::where('nama_komponen', $type)->first();

        if (!$komponen) {
            \Log::warning("Komponen {$type} tidak ditemukan di database");
            return $this->getDefaultStandar($type);
        }

        // Pastikan kolom ada di model
        $column = $this->activeJabatanCode;
        if (!in_array($column, ['non_jad', 'aa', 'lektor', 'lk', 'gb'])) {
            $column = 'non_jad';
        }

        $value = $komponen->{$column} ?? $this->getDefaultStandar($type);

        return (float) $value;
    }

    protected function getDefaultStandar($type): float
    {
        $defaults = [
            'Pendidikan' => 50.00,
            'Penelitian' => 30.00,
            'Pengabdian' => 15.00,
            'Penunjang' => 5.00,
        ];

        return $defaults[$type] ?? 0.00;
    }

    protected function getPredikat($nilai): string
    {
        if ($nilai >= 120) return 'ISTIMEWA';
        if ($nilai >= 110) return 'SANGAT BAIK';
        if ($nilai >= 100) return 'BAIK';
        if ($nilai >= 80) return 'CUKUP';
        return 'KURANG';
    }

    public function loadRaportData(): void
    {
        $this->isLoading = true;

        try {
            $this->resultArray = [];

            if (!$this->period_id) {
                Notification::make()
                    ->title('Silakan pilih periode terlebih dahulu')
                    ->warning()
                    ->send();
                $this->isLoading = false;
                return;
            }

            $activePeriod = Period::find($this->period_id);
            if (!$activePeriod) {
                Notification::make()
                    ->title('Periode tidak ditemukan')
                    ->danger()
                    ->send();
                $this->isLoading = false;
                return;
            }

            $this->selectedPeriodId = $this->period_id;

            // Query data raport
            $raportData = DB::table('users')
                ->leftJoin('point_a', function ($join) use ($activePeriod) {
                    $join->on('point_a.user_id', '=', 'users.id')
                        ->where('point_a.period_id', '=', $activePeriod->id);
                })
                ->leftJoin('point_b', function ($join) use ($activePeriod) {
                    $join->on('point_b.user_id', '=', 'users.id')
                        ->where('point_b.period_id', '=', $activePeriod->id);
                })
                ->leftJoin('point_c', function ($join) use ($activePeriod) {
                    $join->on('point_c.user_id', '=', 'users.id')
                        ->where('point_c.period_id', '=', $activePeriod->id);
                })
                ->leftJoin('point_d', function ($join) use ($activePeriod) {
                    $join->on('point_d.user_id', '=', 'users.id')
                        ->where('point_d.period_id', '=', $activePeriod->id);
                })
                ->leftJoin('point_e', function ($join) use ($activePeriod) {
                    $join->on('point_e.user_id', '=', 'users.id')
                        ->where('point_e.period_id', '=', $activePeriod->id);
                })
                ->select('users.*', 'point_a.*', 'point_b.*', 'point_c.*', 'point_d.*', 'point_e.*')
                ->where('users.id', auth()->id())
                ->first();

            if (!$raportData) {
                Notification::make()
                    ->title('Data raport tidak ditemukan untuk periode ini')
                    ->warning()
                    ->send();
                $this->isLoading = false;
                return;
            }

            // Hitung nilai
            $this->calculateRaportValues($raportData);

            Notification::make()
                ->title('Raport berhasil dimuat')
                ->success()
                ->send();
        } catch (\Exception $e) {
            \Log::error("Error loading raport data: " . $e->getMessage());
            Notification::make()
                ->title('Terjadi kesalahan')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }

        $this->isLoading = false;
    }

    protected function calculateRaportValues($raportData): void
    {
        // Ambil standar komponen berdasarkan jabatan
        $standarA = $this->getStandarKomponen('Pendidikan');
        $standarB = $this->getStandarKomponen('Penelitian');
        $standarC = $this->getStandarKomponen('Pengabdian');
        $standarD = $this->getStandarKomponen('Penunjang');

        // Nilai mentah
        $a = (float) ($raportData->NilaiTotalPendidikanDanPengajaran ?? 0);
        $b = (float) ($raportData->NilaiTotalPenelitiandanKaryaIlmiah ?? 0);
        $c = (float) ($raportData->NilaiTotalPengabdianKepadaMasyarakat ?? 0);
        $d = (float) ($raportData->ResultSumNilaiTotalUnsurPenunjang ?? 0);
        $e = (float) ($raportData->NilaiUnsurPengabdian ?? 0);

        $total_Ntu = $a + $b + $c;
        $total_Ntd = $d + $e;
        $total_Nkd = $total_Ntu + $total_Ntd;

        // Hitung persentase
        $NtAFinalSum = $standarA > 0 ? ($a / $standarA) * 100 : 0;
        $NTiFinalSum = $standarB > 0 ? ($b / $standarB) * 100 : 0;
        $NTiFinalSumPkm = $standarC > 0 ? ($c / $standarC) * 100 : 0;
        $SUMUnsurPenungjang = $standarD > 0 ? ($total_Ntd / $standarD) * 100 : 0;

        $totalStandar = $standarA + $standarB + $standarC + $standarD;
        $result_PCT = $totalStandar > 0 ? (($a + $b + $c + $total_Ntd) / $totalStandar) * 100 : 0;

        $this->resultArray = [
            'a' => number_format($a, 2, '.', ''),
            'b' => number_format($b, 2, '.', ''),
            'c' => number_format($c, 2, '.', ''),
            'total_Ntu' => number_format($total_Ntu, 2, '.', ''),
            'total_Ntd' => number_format($total_Ntd, 2, '.', ''),
            'total_Nkd' => number_format($total_Nkd, 2, '.', ''),
            'SumNkt' => number_format($total_Nkd, 2, '.', ''),
            'standar_a' => number_format($standarA, 2, '.', ''),
            'standar_b' => number_format($standarB, 2, '.', ''),
            'standar_c' => number_format($standarC, 2, '.', ''),
            'standar_d' => number_format($standarD, 2, '.', ''),
            'sum_Skt' => number_format($totalStandar, 2, '.', ''),
            'result_PCT' => number_format($result_PCT, 2, '.', ''),
            'NtAFinalSum' => number_format($NtAFinalSum, 2, '.', ''),
            'NTiFinalSum' => number_format($NTiFinalSum, 2, '.', ''),
            'NTiFinalSumPkm' => number_format($NTiFinalSumPkm, 2, '.', ''),
            'SUMUnsurPenungjang' => number_format($SUMUnsurPenungjang, 2, '.', ''),
            'outputHasilPDP' => $this->getPredikat($NtAFinalSum),
            'OutputHasilPki' => $this->getPredikat($NTiFinalSum),
            'OutputHasilPkm' => $this->getPredikat($NTiFinalSumPkm),
            'OutputHasilUnsurPenunjang' => $this->getPredikat($SUMUnsurPenungjang),
            'jabatan_code' => $this->activeJabatanCode,
        ];

        // Cari predikat
        $testPredikat = PredikatAssessment::where('a_poin', $this->resultArray['outputHasilPDP'])
            ->where('b_poin', 'LIKE', '%' . $this->resultArray['OutputHasilPki'] . '%')
            ->where('c_poin', 'LIKE', '%' . $this->resultArray['OutputHasilPkm'] . '%')
            ->where('d_poin', 'LIKE', '%' . $this->resultArray['OutputHasilUnsurPenunjang'] . '%')
            ->first();

        $this->resultArray['predikat'] = $testPredikat ? $testPredikat->predikat : 'Predikat tidak ditemukan';
    }

    public function downloadPdf()
    {
        try {
            if (empty($this->resultArray)) {
                Notification::make()
                    ->title('Tidak ada data raport untuk diunduh')
                    ->warning()
                    ->send();
                return;
            }

            $user = auth()->user();
            $period = Period::find($this->period_id);

            if (!$period) {
                $period = Period::where('is_closed', 1)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->first();
            }

            // Data untuk view PDF
            $data = [
                'resultArray' => $this->resultArray,
                'jabfungName' => $this->jabfungName,
                'jabatanCode' => $this->activeJabatanCode,
                'period' => $period,
                'periods' => $this->periods,
                'selectedPeriodId' => $this->selectedPeriodId,
                'user' => $user,
            ];

            // Generate nama file
            $fileName = 'REKAP-NILAI-ITIKAD-'
                . strtoupper(str_replace(' ', '-', $user->name))
                . '-TA-' . ($period ? str_replace('/', '-', $period->name) : date('Y'))
                . '.pdf';

            // Coba generate PDF dengan DomPDF
            if (class_exists('Barryvdh\DomPDF\Facade\Pdf')) {
                $pdf = Pdf::loadView('filament.pages.penilaian.raport-pdf', $data)
                    ->setPaper('A4', 'portrait')
                    ->setOptions([
                        'defaultFont' => 'sans-serif',
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true,
                    ]);

                return response()->streamDownload(
                    fn() => print($pdf->output()),
                    $fileName
                );
            } else {
                // Fallback: tampilkan view sebagai HTML jika PDF tidak tersedia
                return view('filament.pages.penilaian.raport-pdf', $data);
            }
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());

            Notification::make()
                ->title('Gagal membuat PDF')
                ->body('Error: ' . $e->getMessage())
                ->danger()
                ->send();
            return;
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->color('primary')
                ->url(fn() => $this->getPdfDownloadUrl())
                ->openUrlInNewTab()
                ->visible(fn() => !empty($this->resultArray))
                ->disabled(fn() => $this->isLoading),
        ];
    }

    protected function getPdfDownloadUrl(): string
    {
        return route('raport.pdf', [
            'period_id' => $this->period_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function getTitle(): string|Htmlable
    {
        return 'Raport Dosen';
    }
}
