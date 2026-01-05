<?php

namespace App\Filament\Resources\Penilaian\Itikad;

use App\Filament\Resources\Penilaian\Itikad\RaportResource\Pages;
use App\Models\User;
use App\Models\Period;
use App\Models\Setting\Jabatan\JabatanFungsional;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class RaportResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Raport Dosen';
    protected static ?string $modelLabel = 'Raport Dosen';
    protected static ?string $pluralModelLabel = 'Raport Dosen';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Pilih Dosen')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('period_id')
                    ->label('Periode')
                    ->options(Period::orderBy('start_date', 'desc')->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Dosen')
                    ->searchable(),

                Tables\Columns\TextColumn::make('period.name')
                    ->label('Periode'),

                Tables\Columns\TextColumn::make('total_nilai')
                    ->label('Total Nilai')
                    ->numeric(decimalPlaces: 2),

                Tables\Columns\TextColumn::make('predikat')
                    ->label('Predikat')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'ISTIMEWA' => 'success',
                        'SANGAT BAIK' => 'primary',
                        'BAIK' => 'info',
                        'CUKUP' => 'warning',
                        'KURANG' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('period_id')
                    ->label('Periode')
                    ->options(Period::orderBy('start_date', 'desc')->pluck('name', 'id')),

                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Dosen')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record): string => route('filament.admin.resources.raports.view', $record))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('download')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn($record) => static::downloadRaport($record->user_id, $record->period_id)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRaports::route('/'),
            'create' => Pages\CreateRaport::route('/create'),
            'edit' => Pages\EditRaport::route('/{record}/edit'),
        ];
    }

    public static function downloadRaport($userId, $periodId = null)
    {
        $data = static::generateRaportData($userId, $periodId);

        if (!$data['users']) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $pdf = Pdf::loadView('filament.pages.raport-pdf', $data)
            ->setPaper('A4', 'portrait')
            ->setOptions(['defaultFont' => 'sans-serif']);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'raport-dosen-' . ($data['users']->name ?? 'user') . '.pdf');
    }

    public static function generateRaportData($userId, $periodId = null)
    {
        if (!$periodId) {
            $activePeriod = Period::where('is_closed', 1)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->first();

            if (!$activePeriod) {
                return [
                    'users' => null,
                    'resultArray' => null,
                    'periods' => Period::orderBy('start_date', 'desc')->get(),
                    'selectedPeriodId' => null
                ];
            }

            $periodId = $activePeriod->id;
        } else {
            $activePeriod = Period::find($periodId);
        }

        $users = DB::table('users')
            ->leftJoin('point_a', function ($join) use ($activePeriod) {
                $join->on('point_a.new_user_id', '=', 'users.id')
                    ->where('point_a.period_id', '=', $activePeriod->id);
            })
            ->leftJoin('point_b', function ($join) use ($activePeriod) {
                $join->on('point_b.new_user_id', '=', 'users.id')
                    ->where('point_b.period_id', '=', $activePeriod->id);
            })
            ->leftJoin('point_c', function ($join) use ($activePeriod) {
                $join->on('point_c.new_user_id', '=', 'users.id')
                    ->where('point_c.period_id', '=', $activePeriod->id);
            })
            ->leftJoin('point_d', function ($join) use ($activePeriod) {
                $join->on('point_d.new_user_id', '=', 'users.id')
                    ->where('point_d.period_id', '=', $activePeriod->id);
            })
            ->leftJoin('point_e', function ($join) use ($activePeriod) {
                $join->on('point_e.new_user_id', '=', 'users.id')
                    ->where('point_e.period_id', '=', $activePeriod->id);
            })
            ->select('users.*', 'point_a.*', 'point_b.*', 'point_c.*', 'point_d.*', 'point_e.*')
            ->where('users.id', $userId)
            ->first();

        if (!$users) {
            return [
                'users' => null,
                'resultArray' => null,
                'periods' => Period::orderBy('start_date', 'desc')->get(),
                'selectedPeriodId' => $periodId
            ];
        }

        // Ambil data jabatan fungsional
        $user = User::find($userId);
        $jabfung = $user->jabfung ?? collect();
        $jabfungName = $jabfung->isNotEmpty() ? $jabfung->pluck('name')->join(', ') : '-';

        // Ambil standar komponen
        $standarA = static::getStandarKomponen($userId, 'Pendidikan');
        $standarB = static::getStandarKomponen($userId, 'Penelitian');
        $standarC = static::getStandarKomponen($userId, 'Pengabdian');
        $standarD = static::getStandarKomponen($userId, 'Penunjang');

        // Nilai mentah
        $a = (float) ($users->NilaiTotalPendidikanDanPengajaran ?? 0);
        $b = (float) ($users->NilaiTotalPenelitiandanKaryaIlmiah ?? 0);
        $c = (float) ($users->NilaiTotalPengabdianKepadaMasyarakat ?? 0);
        $d = (float) ($users->ResultSumNilaiTotalUnsurPenunjang ?? 0);
        $e = (float) ($users->NilaiUnsurPengabdian ?? 0);

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

        $resultArray = [
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
            'outputHasilPDP' => static::getPredikat($NtAFinalSum),
            'OutputHasilPki' => static::getPredikat($NTiFinalSum),
            'OutputHasilPkm' => static::getPredikat($NTiFinalSumPkm),
            'OutputHasilUnsurPenunjang' => static::getPredikat($SUMUnsurPenungjang),
        ];

        $testPredikat = \App\Models\Raport::where('a_poin', $resultArray['outputHasilPDP'])
            ->where('b_poin', 'LIKE', '%' . $resultArray['OutputHasilPki'] . '%')
            ->where('c_poin', 'LIKE', '%' . $resultArray['OutputHasilPkm'] . '%')
            ->where('d_poin', 'LIKE', '%' . $resultArray['OutputHasilUnsurPenunjang'] . '%')
            ->first();

        $resultArray['predikat'] = $testPredikat ? $testPredikat->predikat : 'Predikat tidak ditemukan';

        return [
            'users' => $users,
            'resultArray' => $resultArray,
            'periods' => Period::orderBy('start_date', 'desc')->get(),
            'selectedPeriodId' => $periodId,
            'jabfungName' => $jabfungName,
            'activePeriod' => $activePeriod,
            'user' => $user,
        ];
    }

    private static function getStandarKomponen($userId, $komponen)
    {
        // Implementasi getStandarKomponen sesuai kebutuhan Anda
        // Contoh sederhana:
        $user = User::find($userId);
        if (!$user) return 0;

        // Ambil standar berdasarkan jabatan fungsional
        $jabfung = $user->jabfung()->first();
        if (!$jabfung) return 0;

        // Sesuaikan dengan struktur database Anda
        // Ini adalah contoh, sesuaikan dengan kebutuhan
        switch ($komponen) {
            case 'Pendidikan':
                return 40; // Contoh standar
            case 'Penelitian':
                return 30; // Contoh standar
            case 'Pengabdian':
                return 20; // Contoh standar
            case 'Penunjang':
                return 10; // Contoh standar
            default:
                return 0;
        }
    }

    private static function getPredikat($nilai)
    {
        if ($nilai >= 120) return 'ISTIMEWA';
        if ($nilai >= 110) return 'SANGAT BAIK';
        if ($nilai >= 100) return 'BAIK';
        if ($nilai >= 80) return 'CUKUP';
        return 'KURANG';
    }
}
