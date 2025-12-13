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
        // return $form
        //     ->schema([
        //     ]);

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

                Tables\Columns\TextColumn::make('jabatanStrukturalCount')
                    ->label('JUMLAH JABATAN STRUKTURAL')
                    ->getStateUsing(
                        fn(User $record): string =>
                        $record->jabatanStrukturals()->count() . ' jabatan'
                    )
                    ->color('warning'),

                Tables\Columns\TextColumn::make('unitKerjaAktif.unitKerja.name')
                    ->label('UNIT KERJA AKTIF')
                    ->placeholder('-')
                    ->color('success'),

                Tables\Columns\TextColumn::make('unitKerjaHistoriCount')
                    ->label('RIWAYAT UNIT KERJA')
                    ->getStateUsing(
                        fn(User $record): string =>
                        $record->unitKerjaHistori()->count() . ' riwayat'
                    )
                    ->color('info'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Kelola Penempatan')
                    ->icon('heroicon-o-cog')
                    ->color('primary'),
            ]);
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

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'jabatanStrukturals.jabatanStruktural.unitKerja',
                'unitKerjaAktif.unitKerja',
                'unitKerjaHistori.unitKerja',
            ]);
    }
}
