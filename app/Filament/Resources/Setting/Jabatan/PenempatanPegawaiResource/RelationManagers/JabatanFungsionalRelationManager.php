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

    protected static ?string $title = 'Histori Jabatan Fungsional';

    protected static ?string $modelLabel = 'Jabatan Fungsional';

    protected static ?string $pluralModelLabel = 'Jabatan Fungsional';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jabatan_fungsional_id')
                    ->label('Jabatan Fungsional')
                    ->relationship('jabatanFungsional', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('golongan_min')
                            ->options($this->getGolonganOptions()),
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
                    ->nullable()
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
                    ->default('aktif'),
            ]);
    }

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

                Tables\Columns\IconColumn::make('is_active')
                    ->label('AKTIF')
                    ->boolean()
                    ->getStateUsing(function (UserJabatanFungsional $record): bool {
                        return $record->status === 'aktif' && is_null($record->tmt_selesai);
                    })
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
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
                    ->label('Tambah Jabatan Fungsional')
                    ->modalHeading('Tambah Jabatan Fungsional')
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire): array {
                        // Nonaktifkan jabatan fungsional aktif sebelumnya
                        UserJabatanFungsional::where('user_id', $livewire->ownerRecord->id)
                            ->where('status', 'aktif')
                            ->whereNull('tmt_selesai')
                            ->update([
                                'tmt_selesai' => $data['tmt_mulai'],
                                'status' => 'nonaktif'
                            ]);

                        return $data;
                    })
                    ->after(function (UserJabatanFungsional $record) {
                        // Jika ada unit kerja, sinkronkan ke user_unit_kerja
                        if ($record->unit_kerja_id) {
                            $this->syncUnitKerja($record);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data, UserJabatanFungsional $record): array {
                        // Update unit kerja jika ada perubahan
                        $oldUnitId = $record->unit_kerja_id;
                        $newUnitId = $data['unit_kerja_id'] ?? null;

                        if ($oldUnitId != $newUnitId) {
                            // Hapus unit kerja lama berdasarkan TMT
                            UserUnitKerja::where('user_id', $record->user_id)
                                ->where('unit_kerja_id', $oldUnitId)
                                ->where('tmt_mulai', $record->tmt_mulai)
                                ->delete();

                            // Buat unit kerja baru
                            if ($newUnitId) {
                                UserUnitKerja::create([
                                    'user_id' => $record->user_id,
                                    'unit_kerja_id' => $newUnitId,
                                    'tmt_mulai' => $data['tmt_mulai'],
                                    'tmt_selesai' => $data['tmt_selesai'] ?? null,
                                    'status' => $data['status'] ?? 'aktif',
                                ]);
                            }
                        }

                        return $data;
                    }),

                Tables\Actions\DeleteAction::make()
                    ->before(function (UserJabatanFungsional $record, Tables\Actions\DeleteAction $action) {
                        // Hapus unit kerja yang terkait
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
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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

    private function syncUnitKerja(UserJabatanFungsional $record): void
    {
        DB::transaction(function () use ($record) {
            // Nonaktifkan unit kerja aktif sebelumnya
            UserUnitKerja::where('user_id', $record->user_id)
                ->whereNull('tmt_selesai')
                ->update(['tmt_selesai' => $record->tmt_mulai]);

            // Buat unit kerja baru
            UserUnitKerja::create([
                'user_id' => $record->user_id,
                'unit_kerja_id' => $record->unit_kerja_id,
                'tmt_mulai' => $record->tmt_mulai,
                'tmt_selesai' => $record->tmt_selesai,
                'status' => $record->status, // Gunakan status dari jabfung
            ]);
        });
    }
}
