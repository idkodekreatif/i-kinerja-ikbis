<?php

namespace App\Filament\Resources\Setting\Jabatan;

use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\Pages;
use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\RelationManagers;
use App\Models\Setting\Jabatan\PenempatanPegawai;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenempatanPegawaiResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Penempatan Pegawai';

    protected static ?string $modelLabel = 'Penempatan Pegawai';

    protected static ?string $pluralModelLabel = 'Penempatan Pegawai';

    protected static ?string $navigationGroup = 'Setting Jabatan';

    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'setting-jabatan/penempatan-pegawai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // HAPUS Section untuk pilih pegawai di edit form
                // Karena ketika edit, kita sudah punya pegawai yang dipilih
                // Form hanya untuk melihat data, tidak untuk memilih user
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('NAMA PEGAWAI')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn(User $record): string => $record->email ?? '-'),

                Tables\Columns\TextColumn::make('jabatanFungsionalAktif.jabatanFungsional.name')
                    ->label('JABATAN FUNGSIONAL')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-')
                    ->color('primary')
                    ->url(
                        fn(User $record): ?string =>
                        $record->jabatanFungsionalAktif
                            ? route('filament.kpi-control-center.resources.setting-jabatan.jabatan-fungsionals.edit', $record->jabatanFungsionalAktif->jabatan_fungsional_id)
                            : null
                    )
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('jabatanStrukturalAktif.jabatanStruktural.name')
                    ->label('JABATAN STRUKTURAL')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-')
                    ->color('warning')
                    ->url(
                        fn(User $record): ?string =>
                        $record->jabatanStrukturalAktif
                            ? route('filament.kpi-control-center.resources.setting-jabatan.jabatan-strukturals.edit', $record->jabatanStrukturalAktif->jabatan_struktural_id)
                            : null
                    )
                    ->openUrlInNewTab(),

                Tables\Columns\TextColumn::make('unitKerjaAktif.unitKerja.name')
                    ->label('UNIT KERJA')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-')
                    ->color('success')
                    ->url(
                        fn(User $record): ?string =>
                        $record->unitKerjaAktif
                            ? route('filament.kpi-control-center.resources.setting-jabatan.unit-kerjas.edit', $record->unitKerjaAktif->unit_kerja_id)
                            : null
                    )
                    ->openUrlInNewTab(),

                Tables\Columns\BadgeColumn::make('status_penempatan')
                    ->label('STATUS')
                    ->colors([
                        'success' => 'Lengkap',
                        'warning' => 'Sebagian',
                        'gray' => 'Belum',
                    ])
                    ->getStateUsing(function (User $record): string {
                        $hasJabfung = $record->jabatanFungsionalAktif ? true : false;
                        $hasJabstruk = $record->jabatanStrukturalAktif ? true : false;

                        if ($hasJabfung && $hasJabstruk) return 'Lengkap';
                        if ($hasJabfung || $hasJabstruk) return 'Sebagian';
                        return 'Belum';
                    }),

                Tables\Columns\TextColumn::make('jabatanFungsionals_count')
                    ->label('HISTORI JABFUNG')
                    ->counts('jabatanFungsionals')
                    ->sortable()
                    ->alignCenter()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('jabatanStrukturals_count')
                    ->label('HISTORI JABSTRUK')
                    ->counts('jabatanStrukturals')
                    ->sortable()
                    ->alignCenter()
                    ->color('warning'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jabatan_fungsional')
                    ->label('Jabatan Fungsional')
                    ->relationship('jabatanFungsionals.jabatanFungsional', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('jabatan_struktural')
                    ->label('Jabatan Struktural')
                    ->relationship('jabatanStrukturals.jabatanStruktural', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('unit_kerja')
                    ->label('Unit Kerja')
                    ->relationship('unitKerjaHistori.unitKerja', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\TernaryFilter::make('status_penempatan')
                    ->label('Status Penempatan')
                    ->placeholder('Semua Status')
                    ->trueLabel('Sudah Ditempatkan')
                    ->falseLabel('Belum Ditempatkan')
                    ->queries(
                        true: fn(Builder $query) => $query->whereHas('jabatanFungsionals')
                            ->orWhereHas('jabatanStrukturals'),
                        false: fn(Builder $query) => $query->whereDoesntHave('jabatanFungsionals')
                            ->whereDoesntHave('jabatanStrukturals'),
                    ),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Kelola Penempatan')
                        ->icon('heroicon-o-cog')
                        ->color('primary'),

                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus User')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus User')
                        ->modalDescription('Apakah Anda yakin ingin menghapus user ini? Semua histori penempatan juga akan dihapus.')
                        ->modalSubmitActionLabel('Ya, Hapus'),
                ])
                    ->label('Aksi')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->button()
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Penempatan'),
            ])
            ->defaultSort('name', 'asc')
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UnitKerjaRelationManager::class,
            RelationManagers\JabatanFungsionalRelationManager::class,
            RelationManagers\JabatanStrukturalRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenempatanPegawais::route('/'),
            'create' => Pages\CreatePenempatanPegawai::route('/create'),
            'edit' => Pages\EditPenempatanPegawai::route('/{record}/edit'),
            // 'view' => Pages\ViewPenempatanPegawai::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $total = User::whereHas('jabatanFungsionals')
            ->orWhereHas('jabatanStrukturals')
            ->count();

        return $total ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'jabatanFungsionals' => function ($query) {
                    $query->where('status', 'aktif')->whereNull('tmt_selesai');
                },
                'jabatanFungsionals.jabatanFungsional',
                'jabatanFungsionals.unitKerja',
                'jabatanStrukturals' => function ($query) {
                    $query->where('status', 'aktif')->whereNull('tmt_selesai');
                },
                'jabatanStrukturals.jabatanStruktural',
                'jabatanStrukturals.jabatanStruktural.unitKerja',
                'unitKerjaHistori' => function ($query) {
                    $query->whereNull('tmt_selesai');
                },
                'unitKerjaHistori.unitKerja',
            ]);
    }
}
