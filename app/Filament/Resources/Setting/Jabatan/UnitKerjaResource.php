<?php

namespace App\Filament\Resources\Setting\Jabatan;

use App\Filament\Resources\Setting\Jabatan\UnitKerjaResource\Pages;
use App\Filament\Resources\Setting\Jabatan\UnitKerjaResource\RelationManagers;
use App\Models\Setting\Jabatan\UnitKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitKerjaResource extends Resource
{
    protected static ?string $model = UnitKerja::class;

    /**
     * SIDEBAR CONFIG
     */
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Unit Kerja';

    protected static ?string $modelLabel = 'Unit Kerja';

    protected static ?string $pluralModelLabel = 'Unit Kerja';

    protected static ?string $navigationGroup = 'Setting Jabatan';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'setting-jabatan/unit-kerja';

    /**
     * FORM
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Unit Kerja')
                    ->description('Masukkan data unit kerja dengan lengkap')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Unit Kerja')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: IT, HRD, Keuangan')
                            ->helperText('Nama unit kerja harus unik'),

                        Forms\Components\Select::make('type')
                            ->label('Tipe Unit Kerja')
                            ->options([
                                'Akademik' => 'Akademik',
                                'Non-akademik' => 'Non-akademik',
                            ])
                            ->placeholder('Pilih tipe unit kerja')
                            ->nullable()
                            ->helperText('Akademik: Fakultas/Prodi, Non-akademik: Administrasi'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->nullable()
                            ->placeholder('Deskripsi singkat tentang unit kerja')
                            ->maxLength(500)
                            ->helperText('Maksimal 500 karakter'),
                    ])
                    ->columns(1)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('NAMA UNIT KERJA')
                    ->searchable()
                    ->sortable()
                    ->description(
                        fn(UnitKerja $record): string =>
                        $record->description ? substr($record->description, 0, 50) . '...' : ''
                    )
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('TIPE')
                    ->colors([
                        'success' => 'Akademik',
                        'warning' => 'Non-akademik',
                        'gray' => null,
                    ])
                    ->formatStateUsing(fn($state): string => $state ?? 'Tidak ada tipe')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('DIBUAT')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('DIUPDATE')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Filter Berdasarkan Tipe')
                    ->options([
                        'Akademik' => 'Akademik',
                        'Non-akademik' => 'Non-akademik',
                    ])
                    ->placeholder('Semua Tipe'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('info')
                    ->icon('heroicon-o-eye'),

                Tables\Actions\EditAction::make()
                    ->color('warning')
                    ->icon('heroicon-o-pencil'),

                Tables\Actions\DeleteAction::make()
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Unit Kerja')
                    ->modalDescription('Apakah Anda yakin ingin menghapus unit kerja ini? Data yang dihapus tidak dapat dikembalikan.')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Unit Kerja Pertama')
                    ->icon('heroicon-o-plus'),
            ])
            ->defaultSort('name', 'asc')
            ->striped()
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relation managers jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnitKerjas::route('/'),
            'create' => Pages\CreateUnitKerja::route('/create'),
            // 'view' => Pages\ViewUnitKerja::route('/{record}'),
            'edit' => Pages\EditUnitKerja::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'success';
    }
}
