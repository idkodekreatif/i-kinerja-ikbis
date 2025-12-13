<?php

namespace App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\RelationManagers;

use App\Models\Setting\Jabatan\UnitKerja;
use App\Models\Setting\Jabatan\UserUnitKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UnitKerjaRelationManager extends RelationManager
{
    protected static string $relationship = 'unitKerjaHistori';

    protected static ?string $title = 'Histori Unit Kerja';

    protected static ?string $modelLabel = 'Unit Kerja';

    protected static ?string $pluralModelLabel = 'Unit Kerja';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('unit_kerja_id')
                    ->label('Unit Kerja')
                    ->relationship('unitKerja', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Unit Kerja')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->label('Tipe')
                            ->options(['Akademik' => 'Akademik', 'Non-akademik' => 'Non-akademik']),
                    ])
                    ->createOptionUsing(function (array $data) {
                        $unitKerja = UnitKerja::create($data);
                        return $unitKerja->id;
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
            ->recordTitleAttribute('unitKerja.name')
            ->columns([
                Tables\Columns\TextColumn::make('unitKerja.name')
                    ->label('UNIT KERJA')
                    ->searchable()
                    ->sortable()
                    ->color('primary'),

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
                    ->getStateUsing(fn(UserUnitKerja $record): bool => is_null($record->tmt_selesai))
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\Filter::make('masih_aktif')
                    ->label('Masih aktif')
                    ->query(fn(Builder $query): Builder => $query->whereNull('tmt_selesai')),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Nonaktif',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Unit Kerja')
                    ->modalHeading('Tambah Unit Kerja')
                    ->mutateFormDataUsing(function (array $data, RelationManager $livewire): array {
                        // Nonaktifkan unit kerja aktif sebelumnya
                        UserUnitKerja::where('user_id', $livewire->ownerRecord->id)
                            ->whereNull('tmt_selesai')
                            ->update(['tmt_selesai' => $data['tmt_mulai']]);

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data, UserUnitKerja $record): array {
                        // Jika TMT mulai diubah, update TMT selesai dari record sebelumnya
                        if ($record->tmt_mulai->format('Y-m-d') !== $data['tmt_mulai']) {
                            $prevRecord = UserUnitKerja::where('user_id', $record->user_id)
                                ->where('id', '<', $record->id)
                                ->orderBy('id', 'desc')
                                ->first();

                            if ($prevRecord && is_null($prevRecord->tmt_selesai)) {
                                $prevRecord->update(['tmt_selesai' => $data['tmt_mulai']]);
                            }
                        }

                        return $data;
                    }),

                Tables\Actions\DeleteAction::make()
                    ->before(function (UserUnitKerja $record, Tables\Actions\DeleteAction $action) {
                        // Cek apakah ini record terakhir
                        $isLast = !UserUnitKerja::where('user_id', $record->user_id)
                            ->where('id', '>', $record->id)
                            ->exists();

                        if ($isLast && is_null($record->tmt_selesai)) {
                            // Aktifkan record sebelumnya jika ada
                            $prevRecord = UserUnitKerja::where('user_id', $record->user_id)
                                ->where('id', '<', $record->id)
                                ->orderBy('id', 'desc')
                                ->first();

                            if ($prevRecord) {
                                $prevRecord->update(['tmt_selesai' => null]);
                            }
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
