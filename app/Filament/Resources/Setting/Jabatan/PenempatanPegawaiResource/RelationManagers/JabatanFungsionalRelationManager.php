<?php

namespace App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\RelationManagers;

use App\Models\Setting\Jabatan\JabatanFungsional;
use App\Models\Setting\Jabatan\UserJabatanFungsional;
use App\Models\Setting\Jabatan\UserUnitKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class JabatanFungsionalRelationManager extends RelationManager
{
    protected static string $relationship = 'jabatanFungsionals';
    protected static ?string $title = 'Jabatan Fungsional';

    /* =====================================================
     * FORM
     * ===================================================== */
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('jabatan_fungsional_id')
                ->label('Jabatan Fungsional')
                ->relationship('jabatanFungsional', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->disabled(fn($record) => $record !== null)
                ->helperText(fn($record) => $record ? 'Jabatan tidak dapat diganti' : 'Pilih jabatan fungsional')
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\Select::make('golongan_min')
                        ->options($this->getGolonganOptions()),
                    Forms\Components\Select::make('golongan_max')
                        ->options($this->getGolonganOptions()),
                    Forms\Components\TextInput::make('angka_kredit_min')
                        ->numeric()
                        ->default(0),
                    Forms\Components\TextInput::make('angka_kredit_next')
                        ->numeric()
                        ->default(0),
                    Forms\Components\Textarea::make('description'),
                ])
                ->createOptionUsing(function (array $data) {
                    $jabfung = JabatanFungsional::create($data);
                    return $jabfung->id;
                }),

            Forms\Components\Select::make('unit_kerja_id')
                ->label('Unit Kerja')
                ->relationship('unitKerja', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->helperText('Unit kerja tempat bertugas'),

            Forms\Components\DatePicker::make('tmt_mulai')
                ->label('TMT Mulai')
                ->required()
                ->displayFormat('d/m/Y')
                ->native(false),

            Forms\Components\DatePicker::make('tmt_selesai')
                ->label('TMT Selesai')
                ->nullable()
                ->displayFormat('d/m/Y')
                ->native(false)
                ->helperText('Kosongkan jika masih aktif'),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'aktif' => 'Aktif',
                    'nonaktif' => 'Nonaktif',
                ])
                ->default('aktif')
                ->disabled(fn($record) => $record && $record->status === 'aktif' && is_null($record->tmt_selesai))
                ->helperText('Otomatis nonaktif jika TMT selesai diisi'),
        ]);
    }

    /* =====================================================
     * TABLE
     * ===================================================== */
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('jabatanFungsional.name')
            ->columns([
                Tables\Columns\TextColumn::make('jabatanFungsional.name')
                    ->label('JABATAN FUNGSIONAL')
                    ->searchable()
                    ->sortable()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('unitKerja.name')
                    ->label('UNIT KERJA')
                    ->searchable()
                    ->sortable()
                    ->color('success'),

                Tables\Columns\TextColumn::make('tmt_mulai')
                    ->label('TMT MULAI')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tmt_selesai')
                    ->label('TMT SELESAI')
                    ->date('d/m/Y')
                    ->placeholder('Masih aktif')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('STATUS')
                    ->colors([
                        'success' => 'aktif',
                        'danger' => 'nonaktif',
                    ]),

                // Tables\Columns\IconColumn::make('is_active')
                //     ->label('AKTIF SEKARANG')
                //     ->boolean()
                //     ->getStateUsing(function (UserJabatanFungsional $record): bool {
                //         return $record->status === 'aktif' && is_null($record->tmt_selesai);
                //     })
                //     ->trueIcon('heroicon-o-check-circle')
                //     ->falseIcon('heroicon-o-x-circle')
                //     ->trueColor('success')
                //     ->falseColor('danger'),
            ])

            /* ================= HEADER ACTION ================= */
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Jabatan Fungsional')
                    ->modalHeading('Tambah Jabatan Fungsional')
                    ->hidden(fn() => $this->hasAnyJabatanFungsional())
                    ->disabled(fn() => $this->hasAnyJabatanFungsional())
                    ->mutateFormDataUsing(function (array $data) {
                        // Validasi: hanya boleh 1 jabatan fungsional
                        if ($this->hasAnyJabatanFungsional()) {
                            throw new \Exception('User sudah memiliki jabatan fungsional');
                        }
                        return $data;
                    })
                    ->after(function (UserJabatanFungsional $record) {
                        // Sinkron unit kerja
                        if ($record->unit_kerja_id) {
                            $this->syncUnitKerja($record);
                        }
                    }),
            ])

            /* ================= ROW ACTION ================= */
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn($record) => $record !== null)
                    ->disabled(fn($record) => $record && $record->status === 'nonaktif')
                    ->mutateFormDataUsing(function (array $data, UserJabatanFungsional $record) {
                        // Update unit kerja jika berubah
                        if ($record->unit_kerja_id != $data['unit_kerja_id']) {
                            // Hapus unit kerja lama berdasarkan TMT yang sama
                            UserUnitKerja::where('user_id', $record->user_id)
                                ->where('unit_kerja_id', $record->unit_kerja_id)
                                ->where('tmt_mulai', $record->tmt_mulai)
                                ->delete();

                            // Buat unit kerja baru
                            if ($data['unit_kerja_id']) {
                                $this->syncUnitKerja($record, $data);
                            }
                        }
                        // Jika hanya TMT atau status yang berubah
                        else if (
                            $record->tmt_mulai->format('Y-m-d') != $data['tmt_mulai'] ||
                            $record->tmt_selesai != $data['tmt_selesai']
                        ) {
                            // Update unit kerja yang terkait
                            UserUnitKerja::where('user_id', $record->user_id)
                                ->where('unit_kerja_id', $record->unit_kerja_id)
                                ->where('tmt_mulai', $record->tmt_mulai)
                                ->update([
                                    'tmt_mulai' => $data['tmt_mulai'],
                                    'tmt_selesai' => $data['tmt_selesai'] ?? null,
                                ]);
                        }
                        return $data;
                    }),

                Tables\Actions\Action::make('nonaktifkan')
                    ->label('Nonaktifkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => $record && $record->status === 'aktif' && is_null($record->tmt_selesai))
                    ->action(function (UserJabatanFungsional $record) {
                        DB::transaction(function () use ($record) {
                            $record->update([
                                'tmt_selesai' => now(),
                                'status' => 'nonaktif'
                            ]);

                            // Nonaktifkan unit kerja yang terkait
                            if ($record->unit_kerja_id) {
                                UserUnitKerja::where('user_id', $record->user_id)
                                    ->where('unit_kerja_id', $record->unit_kerja_id)
                                    ->whereNull('tmt_selesai')
                                    ->update(['tmt_selesai' => now()]);
                            }
                        });
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Nonaktifkan Jabatan Fungsional')
                    ->modalDescription('Apakah Anda yakin ingin menonaktifkan jabatan fungsional ini?'),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn($record) => $record !== null)
                    ->before(function (UserJabatanFungsional $record) {
                        // HAPUS unit kerja yang terkait berdasarkan TMT yang sama
                        if ($record->unit_kerja_id) {
                            UserUnitKerja::where('user_id', $record->user_id)
                                ->where('unit_kerja_id', $record->unit_kerja_id)
                                ->where('tmt_mulai', $record->tmt_mulai)
                                ->delete();
                        }
                    }),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                // Hapus unit kerja yang terkait untuk setiap record
                                if ($record->unit_kerja_id) {
                                    UserUnitKerja::where('user_id', $record->user_id)
                                        ->where('unit_kerja_id', $record->unit_kerja_id)
                                        ->where('tmt_mulai', $record->tmt_mulai)
                                        ->delete();
                                }
                            }
                        }),
                ]),
            ])

            /* ================= FILTER ================= */
            ->filters([
                Tables\Filters\Filter::make('masih_aktif')
                    ->label('Masih aktif')
                    ->query(fn(Builder $query): Builder => $query->where('status', 'aktif')->whereNull('tmt_selesai')),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ]),
            ])

            /* ================= EMPTY STATE ================= */
            ->emptyStateHeading('Belum ada jabatan fungsional')
            ->emptyStateDescription('Tambahkan jabatan fungsional untuk pegawai ini.')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Jabatan Fungsional')
                    ->hidden(fn() => $this->hasAnyJabatanFungsional())
                    ->disabled(fn() => $this->hasAnyJabatanFungsional()),
            ]);
    }

    /* =====================================================
     * HELPERS
     * ===================================================== */

    /**
     * Cek apakah user sudah memiliki jabatan fungsional (apapun statusnya)
     */
    private function hasAnyJabatanFungsional(): bool
    {
        return UserJabatanFungsional::where('user_id', $this->getOwnerRecord()->id)->exists();
    }

    /**
     * Cek apakah user sudah memiliki jabatan fungsional aktif
     */
    private function hasActiveJabatanFungsional(): bool
    {
        return UserJabatanFungsional::where('user_id', $this->getOwnerRecord()->id)
            ->where('status', 'aktif')
            ->whereNull('tmt_selesai')
            ->exists();
    }

    /**
     * Sync unit kerja ke tabel user_unit_kerja
     */
    private function syncUnitKerja(UserJabatanFungsional $record, ?array $newData = null): void
    {
        DB::transaction(function () use ($record, $newData) {
            $userId = $record->user_id;
            $unitId = $newData['unit_kerja_id'] ?? $record->unit_kerja_id;
            $tmtMulai = $newData['tmt_mulai'] ?? $record->tmt_mulai;
            $tmtSelesai = $newData['tmt_selesai'] ?? $record->tmt_selesai;

            if ($unitId) {
                // Nonaktifkan unit kerja aktif sebelumnya
                UserUnitKerja::where('user_id', $userId)
                    ->whereNull('tmt_selesai')
                    ->update(['tmt_selesai' => $tmtMulai]);

                // Buat record unit kerja baru
                UserUnitKerja::create([
                    'user_id' => $userId,
                    'unit_kerja_id' => $unitId,
                    'tmt_mulai' => $tmtMulai,
                    'tmt_selesai' => $tmtSelesai,
                    'status' => 'aktif',
                ]);
            }
        });
    }

    private function getGolonganOptions(): array
    {
        return [
            'I/a' => 'I/a',
            'I/b' => 'I/b',
            'I/c' => 'I/c',
            'I/d' => 'I/d',
            'II/a' => 'II/a',
            'II/b' => 'II/b',
            'II/c' => 'II/c',
            'II/d' => 'II/d',
            'III/a' => 'III/a',
            'III/b' => 'III/b',
            'III/c' => 'III/c',
            'III/d' => 'III/d',
            'IV/a' => 'IV/a',
            'IV/b' => 'IV/b',
            'IV/c' => 'IV/c',
            'IV/d' => 'IV/d',
            'IV/e' => 'IV/e',
        ];
    }
}
