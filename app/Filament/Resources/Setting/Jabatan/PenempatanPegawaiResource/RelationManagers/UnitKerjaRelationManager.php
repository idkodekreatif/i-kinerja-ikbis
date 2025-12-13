<?php

namespace App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\RelationManagers;

use App\Models\Setting\Jabatan\UserUnitKerja;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UnitKerjaRelationManager extends RelationManager
{
    protected static string $relationship = 'unitKerjaHistori';

    protected static ?string $title = 'Histori Unit Kerja';

    protected static ?string $modelLabel = 'Unit Kerja';

    protected static ?string $pluralModelLabel = 'Unit Kerja';

    public function form(Form $form): Form
    {
        // Form tidak diperlukan karena hanya view
        return $form->schema([]);
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

                Tables\Columns\TextColumn::make('sumber_info')
                    ->label('SUMBER')
                    ->getStateUsing(function (UserUnitKerja $record): string {
                        $userId = $record->user_id;
                        $unitId = $record->unit_kerja_id;
                        $tmt = $record->tmt_mulai;

                        // Cek dari jabatan struktural
                        $fromJabstruk = \App\Models\Setting\Jabatan\UserJabatanStruktural::where('user_id', $userId)
                            ->whereHas('jabatanStruktural', function ($query) use ($unitId) {
                                $query->where('unit_kerja_id', $unitId);
                            })
                            ->where('tmt_mulai', $tmt)
                            ->exists();

                        if ($fromJabstruk) return 'Jabatan Struktural';

                        return 'Manual';
                    })
                    ->badge()
                    ->colors([
                        'warning' => 'Jabatan Struktural',
                        'gray' => 'Manual',
                    ]),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('AKTIF SEKARANG')
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
            ])
            ->headerActions([]) // Tidak bisa tambah manual
            ->actions([]) // Tidak bisa edit/delete
            ->bulkActions([])
            ->emptyStateHeading('Belum ada riwayat unit kerja')
            ->emptyStateDescription('Unit kerja akan otomatis terisi ketika menambahkan jabatan struktural.');
    }
}
