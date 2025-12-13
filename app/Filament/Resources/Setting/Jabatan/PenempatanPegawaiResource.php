<?php

namespace App\Filament\Resources\Setting\Jabatan;

use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\Pages;
use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

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
                Forms\Components\Section::make('Informasi Pegawai')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled()
                            ->dehydrated(false),
                    ]),
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
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('jabatanFungsionalAktifInfo')
                    ->label('JABATAN FUNGSIONAL')
                    ->getStateUsing(function (User $record): string {
                        $jabfung = $record->jabatanFungsionalAktif;
                        if (!$jabfung) return '-';

                        $tmt = $jabfung->tmt_mulai?->format('d/m/Y') ?? '-';
                        return $jabfung->jabatanFungsional?->name . " (TMT: {$tmt})";
                    })
                    ->color('primary'),

                Tables\Columns\TextColumn::make('jabatanStrukturalCount')
                    ->label('JUMLAH JABATAN STRUKTURAL')
                    ->getStateUsing(
                        fn(User $record): string =>
                        $record->jabatanStrukturals()->count() . ' jabatan'
                    )
                    ->color('warning'),

                Tables\Columns\TextColumn::make('unitKerjaAktifInfo')
                    ->label('UNIT KERJA AKTIF')
                    ->getStateUsing(function (User $record): string {
                        $unit = $record->unitKerjaAktif;
                        if (!$unit) return '-';

                        $tmt = $unit->tmt_mulai?->format('d/m/Y') ?? '-';
                        return $unit->unitKerja?->name . " (TMT: {$tmt})";
                    })
                    ->color('success'),

                Tables\Columns\TextColumn::make('unitKerjaHistoriCount')
                    ->label('RIWAYAT UNIT KERJA')
                    ->getStateUsing(
                        fn(User $record): string =>
                        $record->unitKerjaHistori()->count() . ' riwayat'
                    )
                    ->color('info')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Kelola Penempatan')
                    ->icon('heroicon-o-cog')
                    ->color('primary'),
            ])
            ->bulkActions([])
            ->defaultSort('name', 'asc');
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
            'edit' => Pages\EditPenempatanPegawai::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'jabatanFungsionalAktif.jabatanFungsional',
                'jabatanFungsionalAktif.unitKerja',
                'jabatanStrukturals.jabatanStruktural.unitKerja',
                'unitKerjaAktif.unitKerja',
                'unitKerjaHistori.unitKerja',
            ]);
    }
}
