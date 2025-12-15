<?php

namespace App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\RelationManagers;

use App\Models\Setting\Jabatan\JabatanStruktural;
use App\Models\Setting\Jabatan\UserJabatanStruktural;
use App\Models\Setting\Jabatan\UserUnitKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class JabatanStrukturalRelationManager extends RelationManager
{
    protected static string $relationship = 'jabatanStrukturals';

    protected static ?string $title = 'Jabatan Struktural';

    protected static ?string $modelLabel = 'Jabatan Struktural';

    protected static ?string $pluralModelLabel = 'Jabatan Struktural';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jabatan_struktural_id')
                    ->label('Jabatan Struktural')
                    ->relationship('jabatanStruktural', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Auto-fill unit kerja dari jabatan yang dipilih
                        if ($state) {
                            $jabatan = JabatanStruktural::find($state);
                            if ($jabatan && $jabatan->unit_kerja_id) {
                                $set('unit_kerja_info', $jabatan->unitKerja->name ?? '-');
                            } else {
                                $set('unit_kerja_info', 'Tidak ada unit kerja');
                            }
                        }
                    })
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sub_koordinator')
                            ->maxLength(255),
                        Forms\Components\Select::make('unit_kerja_id')
                            ->label('Unit Kerja (Jabatan)')
                            ->relationship('unitKerja', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->helperText('Unit kerja bawaan dari jabatan ini'),
                        Forms\Components\Textarea::make('description'),
                    ])
                    ->createOptionUsing(function (array $data) {
                        $jabstruk = JabatanStruktural::create($data);
                        return $jabstruk->id;
                    }),

                Forms\Components\Placeholder::make('unit_kerja_info')
                    ->label('Unit Kerja (Otomatis)')
                    ->content(
                        fn($get) =>
                        $get('jabatan_struktural_id')
                            ? (JabatanStruktural::find($get('jabatan_struktural_id'))?->unitKerja?->name ?? 'Tidak ada unit kerja')
                            : 'Pilih jabatan terlebih dahulu'
                    )
                    ->hidden(fn($get) => !$get('jabatan_struktural_id')),

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
                    ->default('aktif'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('jabatanStruktural.name')
            ->columns([
                Tables\Columns\TextColumn::make('jabatanStruktural.name')
                    ->label('JABATAN STRUKTURAL')
                    ->searchable()
                    ->sortable()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('jabatanStruktural.unitKerja.name')
                    ->label('UNIT KERJA (JABATAN)')
                    ->searchable()
                    ->sortable()
                    ->color('success')
                    ->placeholder('-'),

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
                //     ->getStateUsing(function (UserJabatanStruktural $record): bool {
                //         return $record->status === 'aktif' && is_null($record->tmt_selesai);
                //     })
                //     ->trueIcon('heroicon-o-check-circle')
                //     ->falseIcon('heroicon-o-x-circle')
                //     ->trueColor('success')
                //     ->falseColor('danger'),
            ])
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
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Jabatan Struktural')
                    ->modalHeading('Tambah Jabatan Struktural')
                    ->mutateFormDataUsing(function (array $data) {
                        // Ambil unit kerja dari jabatan struktural yang dipilih
                        $jabatan = JabatanStruktural::find($data['jabatan_struktural_id']);
                        $unitId = $jabatan?->unit_kerja_id;

                        if ($unitId) {
                            // Buat/update unit kerja di tabel user_unit_kerja
                            $this->syncUnitKerja(
                                userId: $this->getOwnerRecord()->id,
                                unitId: $unitId,
                                tmtMulai: $data['tmt_mulai'],
                                tmtSelesai: $data['tmt_selesai'] ?? null
                            );
                        }

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data, UserJabatanStruktural $record) {
                        // Cek apakah jabatan berubah
                        if ($record->jabatan_struktural_id != $data['jabatan_struktural_id']) {
                            // Ambil unit kerja lama dan baru
                            $oldJabatan = $record->jabatanStruktural;
                            $newJabatan = JabatanStruktural::find($data['jabatan_struktural_id']);

                            $oldUnitId = $oldJabatan?->unit_kerja_id;
                            $newUnitId = $newJabatan?->unit_kerja_id;

                            // Hapus unit kerja lama jika ada
                            if ($oldUnitId) {
                                UserUnitKerja::where('user_id', $record->user_id)
                                    ->where('unit_kerja_id', $oldUnitId)
                                    ->where('tmt_mulai', $record->tmt_mulai)
                                    ->delete();
                            }

                            // Buat unit kerja baru jika ada
                            if ($newUnitId) {
                                $this->syncUnitKerja(
                                    userId: $record->user_id,
                                    unitId: $newUnitId,
                                    tmtMulai: $data['tmt_mulai'],
                                    tmtSelesai: $data['tmt_selesai'] ?? null
                                );
                            }
                        }
                        // Jika hanya TMT atau status yang berubah
                        else if (
                            $record->tmt_mulai->format('Y-m-d') != $data['tmt_mulai'] ||
                            $record->tmt_selesai != $data['tmt_selesai']
                        ) {
                            $unitId = $record->jabatanStruktural?->unit_kerja_id;

                            if ($unitId) {
                                // Update unit kerja yang terkait
                                UserUnitKerja::where('user_id', $record->user_id)
                                    ->where('unit_kerja_id', $unitId)
                                    ->where('tmt_mulai', $record->tmt_mulai)
                                    ->update([
                                        'tmt_mulai' => $data['tmt_mulai'],
                                        'tmt_selesai' => $data['tmt_selesai'] ?? null,
                                    ]);
                            }
                        }

                        return $data;
                    }),

                Tables\Actions\DeleteAction::make()
                    ->before(function (UserJabatanStruktural $record, Tables\Actions\DeleteAction $action) {
                        // Hapus unit kerja yang terkait
                        $unitId = $record->jabatanStruktural?->unit_kerja_id;
                        if ($unitId) {
                            UserUnitKerja::where('user_id', $record->user_id)
                                ->where('unit_kerja_id', $unitId)
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
                                $unitId = $record->jabatanStruktural?->unit_kerja_id;
                                if ($unitId) {
                                    UserUnitKerja::where('user_id', $record->user_id)
                                        ->where('unit_kerja_id', $unitId)
                                        ->where('tmt_mulai', $record->tmt_mulai)
                                        ->delete();
                                }
                            }
                        }),
                ]),
            ]);
    }

    /**
     * Sync unit kerja ke tabel user_unit_kerja
     */
    private function syncUnitKerja($userId, $unitId, $tmtMulai, $tmtSelesai = null): void
    {
        DB::transaction(function () use ($userId, $unitId, $tmtMulai, $tmtSelesai) {
            // Nonaktifkan unit kerja aktif sebelumnya (set tmt_selesai = tmt_mulai baru)
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
        });
    }
}
