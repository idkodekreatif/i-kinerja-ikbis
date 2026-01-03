<?php

namespace App\Filament\Pages\Penilaian\Itikad;

use App\Models\Penilaian\Itikad\PointA as PointAModel;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

class PointA extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Penilaian Dosen';
    protected static string $view = 'filament.pages.penilaian.itikad.point-a';
    protected static ?string $title = 'Form Point A - Pendidikan dan Pengajaran';
    protected static ?string $slug = 'point-a';

    public ?array $data = [];
    public array $formDataForJS = []; // Data untuk JavaScript

    public function mount(): void
    {
        $this->loadData();
    }

    private function loadData(): void
    {
        $pointA = PointAModel::where('user_id', auth()->id())->first();

        if ($pointA) {
            $data = $pointA->toArray();
            $this->form->fill($data);
            $this->data = $data;

            // Data untuk JavaScript (bentuk array PHP)
            $this->formDataForJS = $data;
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(auth()->id()),

                // Semua field hanya sebagai hidden input untuk form submission
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

                Hidden::make('JumlahYangDihasilkanA11_5'),
                Hidden::make('JumlahYangDihasilkanA12_3'),
                Hidden::make('JumlahYangDihasilkanA12_4'),
                Hidden::make('JumlahYangDihasilkanA12_5'),

                // Hasil kalkulasi dari JavaScript
                Hidden::make('TotalSkorPendidikanPointA'),
                Hidden::make('TotalKelebihanA11'),
                Hidden::make('TotalKelebihanA12'),
                Hidden::make('TotalKelebihanSkor'),
                Hidden::make('nilaiPendidikandanPengajaran'),
                Hidden::make('NilaiTambahPendidikanDanPengajaran'),
                Hidden::make('NilaiTotalPendidikanDanPengajaran'),

                // File uploads
                Section::make('Upload Dokumen Pendukung')
                    ->schema([
                        FileUpload::make('fileA1')
                            ->label('1. Hasil evaluasi perkuliahan')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA2')
                            ->label('2. Checklist RPS dari Prodi')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA3')
                            ->label('3. Jumlah SKS (termasuk SKS Mengajar, Jabatan Struktural, dll)')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA4')
                            ->label('4. SK Pembimbing dan Keterangan Prodi')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA5')
                            ->label('5. SK Pembimbingan PKL/PPM/KKM')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA6')
                            ->label('6. SK Pembimbingan Skripsi')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA7')
                            ->label('7. SK penunjukkan sebagai penguji')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA8')
                            ->label('8. SK Dosen Pembimbing Akademik (Dosen PA/Dosen Wali)')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA9')
                            ->label('9. Keterangan dari Prodi dan BAAK')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA10')
                            ->label('10. Keterangan dari Prodi')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA11')
                            ->label('11. Bukti tertulis metode pembelajaran baru')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA12')
                            ->label('12. Bukti fisik bahan pengajaran')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),

                        FileUpload::make('fileA13')
                            ->label('13. SK Pengangkatan sebagai Pejabat Struktural')
                            ->directory('point-a/documents')
                            ->acceptedFileTypes(['application/pdf', 'image/*'])
                            ->maxSize(5120),
                    ])
                    ->columns(1)
                    ->collapsed(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            // JavaScript akan mengisi form data sebelum submit
            $data = $this->form->getState();

            // Simpan data
            $pointA = PointAModel::updateOrCreate(
                ['user_id' => auth()->id()],
                $data
            );

            Notification::make()
                ->title('Data berhasil disimpan!')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Terjadi kesalahan!')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
