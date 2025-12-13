<?php

namespace App\Filament\Resources\Setting\Jabatan;

use App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource\Pages;
use App\Filament\Resources\Setting\Jabatan\JabatanFungsionalResource\RelationManagers;
use App\Models\Setting\Jabatan\JabatanFungsional;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JabatanFungsionalResource extends Resource
{
    protected static ?string $model = JabatanFungsional::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationLabel = 'Jabatan Fungsional';

    protected static ?string $modelLabel = 'Jabatan Fungsional';

    protected static ?string $pluralModelLabel = 'Jabatan Fungsional';

    protected static ?string $navigationGroup = 'Setting Jabatan';

    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'setting-jabatan/jabatan-fungsional';

    public static function form(Form $form): Form
    {
        // Daftar golongan PNS
        $golongan = [
            'I/a' => 'I/a - Juru Muda',
            'I/b' => 'I/b - Juru Muda Tingkat I',
            'I/c' => 'I/c - Juru',
            'I/d' => 'I/d - Juru Tingkat I',
            'II/a' => 'II/a - Pengatur Muda',
            'II/b' => 'II/b - Pengatur Muda Tingkat I',
            'II/c' => 'II/c - Pengatur',
            'II/d' => 'II/d - Pengatur Tingkat I',
            'III/a' => 'III/a - Penata Muda',
            'III/b' => 'III/b - Penata Muda Tingkat I',
            'III/c' => 'III/c - Penata',
            'III/d' => 'III/d - Penata Tingkat I',
            'IV/a' => 'IV/a - Pembina',
            'IV/b' => 'IV/b - Pembina Tingkat I',
            'IV/c' => 'IV/c - Pembina Utama Muda',
            'IV/d' => 'IV/d - Pembina Utama Madya',
            'IV/e' => 'IV/e - Pembina Utama',
        ];

        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Jabatan')
                    ->description('Data utama jabatan fungsional')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Jabatan')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: Asisten Ahli, Lektor, Guru Besar')
                            ->helperText('Nama jabatan harus unik'),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->nullable()
                            ->placeholder('Deskripsi tugas, wewenang, dan tanggung jawab')
                            ->maxLength(1000)
                            ->helperText('Maksimal 1000 karakter')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Golongan')
                    ->description('Range golongan yang berlaku')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\Select::make('golongan_min')
                                    ->label('Golongan Minimum')
                                    ->options($golongan)
                                    ->nullable()
                                    ->searchable()
                                    ->placeholder('Pilih golongan minimum'),

                                Forms\Components\Select::make('golongan_max')
                                    ->label('Golongan Maksimum')
                                    ->options($golongan)
                                    ->nullable()
                                    ->searchable()
                                    ->placeholder('Pilih golongan maksimum'),
                            ])
                            ->columns(2),

                        Forms\Components\Placeholder::make('range_golongan')
                            ->label('Range Golongan')
                            ->content(
                                fn($get): string =>
                                $get('golongan_min') && $get('golongan_max')
                                    ? "{$get('golongan_min')} - {$get('golongan_max')}"
                                    : ($get('golongan_min') ? $get('golongan_min') : '-')
                            )
                            ->hidden(fn($get): bool => !$get('golongan_min')),
                    ]),

                Forms\Components\Section::make('Angka Kredit')
                    ->description('Persyaratan angka kredit')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\TextInput::make('angka_kredit_min')
                                    ->label('Angka Kredit Minimum')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->placeholder('0')
                                    ->helperText('Angka kredit untuk kenaikan pertama'),

                                Forms\Components\TextInput::make('angka_kredit_next')
                                    ->label('Angka Kredit Selanjutnya')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->placeholder('0')
                                    ->helperText('Angka kredit untuk kenaikan berikutnya'),
                            ])
                            ->columns(2),

                        Forms\Components\Placeholder::make('total_angka_kredit')
                            ->label('Total Angka Kredit')
                            ->content(
                                fn($get): string =>
                                number_format(($get('angka_kredit_min') ?? 0) + ($get('angka_kredit_next') ?? 0), 0, ',', '.')
                            ),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('NAMA JABATAN')
                    ->searchable()
                    ->sortable()
                    ->description(
                        fn(JabatanFungsional $record): string =>
                        $record->description ? substr($record->description, 0, 50) . '...' : ''
                    )
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\TextColumn::make('range_golongan')
                    ->label('GOLONGAN')
                    ->formatStateUsing(fn(JabatanFungsional $record): string => $record->range_golongan)
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('angka_kredit_min')
                    ->label('AK MIN')
                    ->formatStateUsing(fn($state): string => number_format($state, 0, ',', '.'))
                    ->sortable()
                    ->alignRight()
                    ->description('Minimum')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('angka_kredit_next')
                    ->label('AK NEXT')
                    ->formatStateUsing(fn($state): string => number_format($state, 0, ',', '.'))
                    ->sortable()
                    ->alignRight()
                    ->description('Selanjutnya')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('total_angka_kredit')
                    ->label('TOTAL AK')
                    ->formatStateUsing(
                        fn(JabatanFungsional $record): string =>
                        number_format($record->total_angka_kredit, 0, ',', '.')
                    )
                    ->sortable()
                    ->alignRight()
                    ->weight('bold')
                    ->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('DIBUAT')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('golongan_min')
                    ->label('Filter Golongan Minimum')
                    ->options([
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
                    ])
                    ->placeholder('Semua Golongan'),

                Tables\Filters\Filter::make('angka_kredit')
                    ->form([
                        Forms\Components\TextInput::make('angka_kredit_dari')
                            ->label('Angka Kredit Dari')
                            ->numeric()
                            ->placeholder('0'),
                        Forms\Components\TextInput::make('angka_kredit_sampai')
                            ->label('Angka Kredit Sampai')
                            ->numeric()
                            ->placeholder('1000'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['angka_kredit_dari'],
                                fn(Builder $query, $value): Builder => $query->where('angka_kredit_min', '>=', $value),
                            )
                            ->when(
                                $data['angka_kredit_sampai'],
                                fn(Builder $query, $value): Builder => $query->where('angka_kredit_min', '<=', $value),
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
                    ->modalHeading('Hapus Jabatan Fungsional')
                    ->modalDescription('Apakah Anda yakin ingin menghapus jabatan fungsional ini?')
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
                    ->label('Tambah Jabatan Fungsional')
                    ->icon('heroicon-o-plus'),
            ])
            ->defaultSort('name', 'asc')
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
            'index' => Pages\ListJabatanFungsionals::route('/'),
            'create' => Pages\CreateJabatanFungsional::route('/create'),
            // 'view' => Pages\ViewJabatanFungsional::route('/{record}'),
            'edit' => Pages\EditJabatanFungsional::route('/{record}/edit'),
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
