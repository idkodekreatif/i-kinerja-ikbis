<?php

namespace App\Filament\Resources\Setting\Indikator;

use App\Filament\Resources\Setting\Indikator\KomponenPoinResource\Pages;
use App\Filament\Resources\Setting\Indikator\KomponenPoinResource\RelationManagers;
use App\Models\Setting\Indikator\KomponenPoin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KomponenPoinResource extends Resource
{
    protected static ?string $model = KomponenPoin::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'Referensi';
    protected static ?string $navigationLabel = 'Indikator Poin';
    protected static ?string $modelLabel = 'Komponen Poin';
    protected static ?string $pluralModelLabel = 'Daftar Komponen Poin';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Komponen')
                    ->description('Isi data komponen dan poin untuk setiap jabatan')
                    ->schema([
                        Forms\Components\TextInput::make('nama_komponen')
                            ->label('Nama Komponen')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->disabledOn('edit') // Tidak bisa diubah saat edit
                            ->columnSpanFull()
                            ->placeholder('Contoh: Pendidikan, Penelitian, dll'),
                    ]),

                Forms\Components\Section::make('Poin per Jabatan')
                    ->description('Isi angka kredit untuk setiap jenis jabatan')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('non_jad')
                                    ->label('Non-JAD')
                                    ->numeric()
                                    ->step(0.01)
                                    ->maxValue(999.99)
                                    ->suffix('poin')
                                    ->placeholder('0.00'),

                                Forms\Components\TextInput::make('aa')
                                    ->label('Asisten Ahli')
                                    ->numeric()
                                    ->step(0.01)
                                    ->maxValue(999.99)
                                    ->suffix('poin')
                                    ->placeholder('0.00'),

                                Forms\Components\TextInput::make('lektor')
                                    ->label('Lektor')
                                    ->numeric()
                                    ->step(0.01)
                                    ->maxValue(999.99)
                                    ->suffix('poin')
                                    ->placeholder('0.00'),

                                Forms\Components\TextInput::make('lk')
                                    ->label('Lektor Kepala')
                                    ->numeric()
                                    ->step(0.01)
                                    ->maxValue(999.99)
                                    ->suffix('poin')
                                    ->placeholder('0.00'),

                                Forms\Components\TextInput::make('gb')
                                    ->label('Guru Besar')
                                    ->numeric()
                                    ->step(0.01)
                                    ->maxValue(999.99)
                                    ->suffix('poin')
                                    ->placeholder('0.00'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_komponen')
                    ->label('Komponen')
                    ->sortable()
                    ->searchable()
                    ->weight('bold')
                    ->description(fn($record) => 'ID: ' . $record->id),

                Tables\Columns\TextColumn::make('non_jad')
                    ->label('Non-JAD')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->alignRight()
                    ->color(fn($state) => $state ? null : 'gray')
                    ->formatStateUsing(fn($state) => $state ? number_format($state, 2) : '-'),

                Tables\Columns\TextColumn::make('aa')
                    ->label('Asisten Ahli')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->alignRight()
                    ->color(fn($state) => $state ? null : 'gray')
                    ->formatStateUsing(fn($state) => $state ? number_format($state, 2) : '-'),

                Tables\Columns\TextColumn::make('lektor')
                    ->label('Lektor')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->alignRight()
                    ->color(fn($state) => $state ? null : 'gray')
                    ->formatStateUsing(fn($state) => $state ? number_format($state, 2) : '-'),

                Tables\Columns\TextColumn::make('lk')
                    ->label('Lektor Kepala')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->alignRight()
                    ->color(fn($state) => $state ? null : 'gray')
                    ->formatStateUsing(fn($state) => $state ? number_format($state, 2) : '-'),

                Tables\Columns\TextColumn::make('gb')
                    ->label('Guru Besar')
                    ->numeric(decimalPlaces: 2)
                    ->sortable()
                    ->alignRight()
                    ->color(fn($state) => $state ? null : 'gray')
                    ->formatStateUsing(fn($state) => $state ? number_format($state, 2) : '-'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter jika ada banyak data
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),
                    // Tables\Actions\DeleteAction::make()
                    //     ->icon('heroicon-o-trash')
                    //     ->requiresConfirmation()
                    //     ->modalHeading('Hapus Komponen Poin')
                    //     ->modalDescription('Apakah Anda yakin ingin menghapus komponen poin ini? Data yang sudah dihapus tidak dapat dikembalikan.')
                    //     ->modalSubmitActionLabel('Ya, Hapus'),
                ]),
            ])
            ->bulkActions([
                // Nonaktifkan bulk delete untuk data referensi
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateHeading('Belum ada komponen poin')
            ->emptyStateDescription('Klik tombol "Tambah Komponen Baru" untuk menambahkan data.')
            ->emptyStateIcon('heroicon-o-document-text')
            ->deferLoading()
            ->striped();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKomponenPoins::route('/'),
            'create' => Pages\CreateKomponenPoin::route('/create'),
            'edit' => Pages\EditKomponenPoin::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
