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

    protected static ?string $title = 'Histori Jabatan Struktural';

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
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sub_koordinator')
                            ->maxLength(255),
                    ])
                    ->createOptionUsing(function (array $data) {
                        $jabstruk = JabatanStruktural::create($data);
                        return $jabstruk->id;
                    }),

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

                Tables\Columns\IconColumn::make('is_active')
                    ->label('AKTIF')
                    ->boolean()
                    ->getStateUsing(function (UserJabatanStruktural $record): bool {
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
                    ->label('Tambah Jabatan Struktural')
                    ->modalHeading('Tambah Jabatan Struktural')
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire): array {
                        // Nonaktifkan jabatan struktural aktif sebelumnya
                        UserJabatanStruktural::where('user_id', $livewire->ownerRecord->id)
                            ->where('status', 'aktif')
                            ->whereNull('tmt_selesai')
                            ->update([
                                'tmt_selesai' => $data['tmt_mulai'],
                                'status' => 'nonaktif'
                            ]);

                        return $data;
                    })
                    ->after(function (UserJabatanStruktural $record) {
                        // Sinkronkan unit kerja dari jabatan struktural
                        $this->syncUnitKerja($record);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function (UserJabatanStruktural $record) {
                        // Update unit kerja
                        $this->syncUnitKerja($record);
                    }),

                Tables\Actions\DeleteAction::make()
                    ->before(function (UserJabatanStruktural $record, Tables\Actions\DeleteAction $action) {
                        // Hapus unit kerja yang terkait berdasarkan TMT
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
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    private function syncUnitKerja(UserJabatanStruktural $record): void
    {
        DB::transaction(function () use ($record) {
            $unitId = $record->jabatanStruktural?->unit_kerja_id;

            if ($unitId) {
                // Hapus unit kerja lama berdasarkan TMT
                UserUnitKerja::where('user_id', $record->user_id)
                    ->where('unit_kerja_id', $unitId)
                    ->where('tmt_mulai', $record->tmt_mulai)
                    ->delete();

                // Nonaktifkan unit kerja aktif sebelumnya
                UserUnitKerja::where('user_id', $record->user_id)
                    ->whereNull('tmt_selesai')
                    ->update(['tmt_selesai' => $record->tmt_mulai]);

                // Buat unit kerja baru
                UserUnitKerja::create([
                    'user_id' => $record->user_id,
                    'unit_kerja_id' => $unitId,
                    'tmt_mulai' => $record->tmt_mulai,
                    'tmt_selesai' => $record->tmt_selesai,
                    'status' => $record->status, // Gunakan status dari jabstruk
                ]);
            }
        });
    }
}
