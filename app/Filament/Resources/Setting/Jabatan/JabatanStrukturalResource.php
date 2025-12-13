<?php

namespace App\Filament\Resources\Setting\Jabatan;

use App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource\Pages;
use App\Filament\Resources\Setting\Jabatan\JabatanStrukturalResource\RelationManagers;
use App\Models\Setting\Jabatan\JabatanStruktural;
use App\Models\Setting\Jabatan\UnitKerja;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JabatanStrukturalResource extends Resource
{
    protected static ?string $model = JabatanStruktural::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Jabatan Struktural';

    protected static ?string $modelLabel = 'Jabatan Struktural';

    protected static ?string $pluralModelLabel = 'Jabatan Struktural';

    protected static ?string $navigationGroup = 'Setting Jabatan';

    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'setting-jabatan/jabatan-struktural';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Jabatan')
                    ->description('Data utama jabatan struktural')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Jabatan')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: Kepala Bagian, Manager, Direktur')
                            ->helperText('Nama jabatan harus unik'),

                        Forms\Components\Select::make('unit_kerja_id')
                            ->label('Unit Kerja')
                            ->relationship('unitKerja', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable()
                            ->placeholder('Pilih unit kerja (opsional)')
                            ->helperText('Unit kerja tempat jabatan ini berada')
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
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Struktur Organisasi')
                    ->description('Informasi struktur dan koordinasi')
                    ->schema([
                        Forms\Components\TextInput::make('sub_koordinator')
                            ->label('Sub Koordinator')
                            ->maxLength(255)
                            ->nullable()
                            ->placeholder('Nama sub koordinator/wakil')
                            ->helperText('Jika jabatan ini memiliki wakil/sub koordinator'),
                    ]),

                Forms\Components\Section::make('Lainnya')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi & Tugas Pokok')
                            ->rows(4)
                            ->nullable()
                            ->placeholder('Deskripsi tugas, wewenang, dan tanggung jawab jabatan')
                            ->maxLength(1000)
                            ->helperText('Maksimal 1000 karakter')
                            ->columnSpanFull(),
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
                        fn(JabatanStruktural $record): string =>
                        $record->description ? substr($record->description, 0, 50) . '...' : ''
                    )
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\TextColumn::make('unitKerja.name')
                    ->label('UNIT KERJA')
                    ->searchable()
                    ->sortable()
                    ->url(
                        fn(JabatanStruktural $record): ?string =>
                        $record->unit_kerja_id
                            // PERBAIKAN: Gunakan route yang benar dari output route:list
                            ? route('filament.kpi-control-center.resources.setting-jabatan.unit-kerja.edit', ['record' => $record->unit_kerja_id])
                            : null
                    )
                    ->color('primary')
                    ->placeholder('-')
                    ->tooltip('Klik untuk edit unit kerja'),

                Tables\Columns\TextColumn::make('sub_koordinator')
                    ->label('SUB KOORDINATOR')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->placeholder('-'),

                Tables\Columns\BadgeColumn::make('status_sub_koordinator')
                    ->label('STATUS')
                    ->colors([
                        'success' => 'Ada',
                        'warning' => 'Tidak Ada',
                    ])
                    ->formatStateUsing(fn(JabatanStruktural $record): string => $record->status_sub_koordinator)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('DIBUAT')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit_kerja_id')
                    ->label('Filter Unit Kerja')
                    ->relationship('unitKerja', 'name')
                    ->searchable()
                    ->preload()
                    ->placeholder('Semua Unit Kerja'),

                Tables\Filters\TernaryFilter::make('sub_koordinator')
                    ->label('Sub Koordinator')
                    ->nullable()
                    ->placeholder('Semua Status')
                    ->trueLabel('Ada Sub Koordinator')
                    ->falseLabel('Tidak Ada Sub Koordinator')
                    ->queries(
                        true: fn(Builder $query) => $query->whereNotNull('sub_koordinator'),
                        false: fn(Builder $query) => $query->whereNull('sub_koordinator'),
                    ),

                Tables\Filters\Filter::make('tanpa_unit_kerja')
                    ->label('Tanpa Unit Kerja')
                    ->query(fn(Builder $query): Builder => $query->whereNull('unit_kerja_id')),
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
                    ->modalHeading('Hapus Jabatan Struktural')
                    ->modalDescription('Apakah Anda yakin ingin menghapus jabatan struktural ini?')
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
                    ->label('Tambah Jabatan Struktural')
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
            'index' => Pages\ListJabatanStrukturals::route('/'),
            'create' => Pages\CreateJabatanStruktural::route('/create'),
            // 'view' => Pages\ViewJabatanStruktural::route('/{record}'),
            'edit' => Pages\EditJabatanStruktural::route('/{record}/edit'),
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
