<?php

namespace App\Filament\Resources\Setting\Periode;

use App\Filament\Resources\Setting\Periode\PeriodResource\Pages;
use App\Filament\Resources\Setting\Periode\PeriodResource\RelationManagers;
use App\Models\Setting\Period;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class PeriodResource extends Resource
{
    protected static ?string $model = Period::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?string $navigationLabel = 'Periode';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Periode';

    protected static ?string $pluralModelLabel = 'Periode';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Periode')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Periode')
                            ->required()
                            ->maxLength(100)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: Semester 1 2024')
                            ->columnSpanFull(),

                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->closeOnDateSelection()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $endDate = $get('end_date');
                                if ($state && $endDate && $state > $endDate) {
                                    $set('end_date', $state);
                                }
                            }),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->closeOnDateSelection()
                            ->live()
                            ->minDate(fn($get) => $get('start_date') ?: now())
                            ->rules([
                                fn($get) => function (string $attribute, $value, $fail) use ($get) {
                                    $startDate = $get('start_date');
                                    if ($startDate && $value < $startDate) {
                                        $fail('Tanggal selesai harus setelah atau sama dengan tanggal mulai.');
                                    }
                                },
                            ]),

                        Forms\Components\Toggle::make('is_closed')
                            ->label('Status Periode')
                            ->inline(false)
                            ->onColor('danger')
                            ->offColor('success')
                            ->onIcon('heroicon-o-lock-closed')
                            ->offIcon('heroicon-o-lock-open')
                            ->helperText('Aktifkan untuk menonaktifkan periode')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (!$state) {
                                    $set('warning_message', 'Periode akan diaktifkan dan periode aktif lainnya akan dinonaktifkan otomatis.');
                                } else {
                                    $set('warning_message', null);
                                }
                            }),

                        Forms\Components\Placeholder::make('warning_message')
                            ->hidden(fn($get) => $get('is_closed'))
                            ->content('Periode akan diaktifkan dan periode aktif lainnya akan dinonaktifkan otomatis.')
                            ->extraAttributes(['class' => 'text-warning-600 bg-warning-50 p-2 rounded']),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informasi Tambahan')
                    ->schema([
                        Forms\Components\Placeholder::make('duration')
                            ->label('Durasi')
                            ->content(function ($get) {
                                $startDate = $get('start_date');
                                $endDate = $get('end_date');

                                if ($startDate && $endDate) {
                                    $start = \Carbon\Carbon::parse($startDate);
                                    $end = \Carbon\Carbon::parse($endDate);
                                    $days = $start->diffInDays($end) + 1;
                                    return "{$days} hari";
                                }

                                return '- hari';
                            }),

                        Forms\Components\Placeholder::make('current_status')
                            ->label('Status Saat Ini')
                            ->content(function ($get, $record) {
                                if ($record) {
                                    if ($record->isActive()) {
                                        return 'Sedang Berjalan';
                                    } elseif ($record->is_closed) {
                                        return 'Tidak Aktif';
                                    } elseif ($record->start_date > now()) {
                                        return 'Belum Dimulai';
                                    } else {
                                        return 'Sudah Lewat';
                                    }
                                }

                                $startDate = $get('start_date');
                                $endDate = $get('end_date');
                                $isClosed = $get('is_closed');

                                if (!$startDate || !$endDate) {
                                    return '-';
                                }

                                $today = now()->format('Y-m-d');
                                $start = \Carbon\Carbon::parse($startDate)->format('Y-m-d');
                                $end = \Carbon\Carbon::parse($endDate)->format('Y-m-d');

                                if (!$isClosed && $start <= $today && $end >= $today) {
                                    return 'Akan Berjalan';
                                } elseif ($isClosed) {
                                    return 'Tidak Aktif';
                                } elseif ($start > $today) {
                                    return 'Belum Dimulai';
                                } else {
                                    return 'Sudah Lewat';
                                }
                            }),
                    ])
                    ->hidden(fn($record) => $record === null)
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Periode')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Selesai')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi')
                    ->getStateUsing(fn($record) => $record->duration),

                Tables\Columns\IconColumn::make('is_closed')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-lock-closed')
                    ->falseIcon('heroicon-o-lock-open')
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->getStateUsing(fn($record) => !$record->is_closed),

                Tables\Columns\TextColumn::make('status_info')
                    ->label('Info')
                    ->getStateUsing(function ($record) {
                        if ($record->isActive()) {
                            return 'Berjalan';
                        } elseif ($record->is_closed) {
                            return 'Nonaktif';
                        } elseif ($record->start_date > now()) {
                            return 'Akan Datang';
                        } else {
                            return 'Lewat';
                        }
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                        'current' => 'Sedang Berjalan',
                        'future' => 'Akan Datang',
                        'past' => 'Sudah Lewat',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['value'])) {
                            $today = now()->format('Y-m-d');

                            switch ($data['value']) {
                                case 'active':
                                    return $query->where('is_closed', false);
                                case 'inactive':
                                    return $query->where('is_closed', true);
                                case 'current':
                                    return $query->where('is_closed', false)
                                        ->where('start_date', '<=', $today)
                                        ->where('end_date', '>=', $today);
                                case 'future':
                                    return $query->where('start_date', '>', $today);
                                case 'past':
                                    return $query->where('end_date', '<', $today);
                            }
                        }

                        return $query;
                    }),

                Tables\Filters\Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('start_from')
                            ->label('Mulai Dari'),
                        Forms\Components\DatePicker::make('start_until')
                            ->label('Sampai Dengan'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date),
                            )
                            ->when(
                                $data['start_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('start_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('activate')
                    ->label('Aktifkan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->is_closed)
                    ->action(function ($record) {
                        try {
                            DB::beginTransaction();

                            // Nonaktifkan semua periode aktif lainnya
                            Period::where('is_closed', false)->update(['is_closed' => true]);

                            // Aktifkan periode ini
                            $record->update(['is_closed' => false]);

                            DB::commit();

                            \Filament\Notifications\Notification::make()
                                ->title('Periode Diaktifkan')
                                ->body("Periode {$record->name} telah diaktifkan")
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            DB::rollBack();
                            \Filament\Notifications\Notification::make()
                                ->title('Gagal')
                                ->body('Gagal mengaktifkan periode')
                                ->danger()
                                ->send();
                        }
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Aktifkan Periode')
                    ->modalDescription('Periode ini akan diaktifkan dan periode aktif lainnya akan dinonaktifkan otomatis.')
                    ->modalSubmitActionLabel('Ya, Aktifkan'),

                Tables\Actions\Action::make('deactivate')
                    ->label('Nonaktifkan')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn($record) => !$record->is_closed)
                    ->action(function ($record) {
                        $record->update(['is_closed' => true]);

                        \Filament\Notifications\Notification::make()
                            ->title('Periode Dinonaktifkan')
                            ->body("Periode {$record->name} telah dinonaktifkan")
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),

                Tables\Actions\EditAction::make()
                    ->icon('heroicon-o-pencil')
                    ->tooltip('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->tooltip('Hapus')
                    ->before(function ($record) {
                        // Cek apakah periode digunakan (sesuaikan dengan relasi Anda)
                        // if ($record->iktisars()->exists() || $record->itikads()->exists()) {
                        //     \Filament\Notifications\Notification::make()
                        //         ->title('Gagal Hapus')
                        //         ->body('Periode tidak dapat dihapus karena sudah digunakan')
                        //         ->danger()
                        //         ->send();
                        //
                        //     return false;
                        // }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih')
                        ->requiresConfirmation()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                // Cek setiap record sebelum dihapus
                                // if ($record->iktisars()->exists() || $record->itikads()->exists()) {
                                //     \Filament\Notifications\Notification::make()
                                //         ->title('Gagal Hapus')
                                //         ->body("Periode {$record->name} tidak dapat dihapus karena sudah digunakan")
                                //         ->danger()
                                //         ->send();
                                //     return false;
                                // }
                            }
                        }),
                ]),
            ])
            ->defaultSort('start_date', 'desc')
            ->reorderable('start_date')
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
            'index' => Pages\ListPeriods::route('/'),
            'create' => Pages\CreatePeriod::route('/create'),
            'edit' => Pages\EditPeriod::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::where('is_closed', false)->exists() ? 'success' : 'gray';
    }
}
