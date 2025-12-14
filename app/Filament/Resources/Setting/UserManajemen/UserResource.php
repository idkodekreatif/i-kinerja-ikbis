<?php

namespace App\Filament\Resources\Setting\UserManajemen;

use App\Filament\Resources\Setting\UserManajemen\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Filament\Notifications\Notification;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'User Management';
    protected static ?string $modelLabel = 'User';
    protected static ?string $pluralModelLabel = 'User Management';
    protected static ?string $navigationGroup = 'System';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(2),

                        // Password dengan fitur intip (toggle visibility)
                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable() // Fitur intip password
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->rule(Password::default())
                            ->maxLength(255)
                            ->columnSpan(1),

                        // Konfirmasi password dengan fitur intip
                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->revealable() // Fitur intip password
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->same('password')
                            ->dehydrated(false)
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informasi Kontak')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\Textarea::make('address')
                            ->label('Alamat')
                            ->rows(3)
                            ->maxLength(500),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Forms\Components\Section::make('Informasi Login')
                    ->schema([
                        Forms\Components\DateTimePicker::make('last_login_at')
                            ->label('Terakhir Login')
                            ->disabled()
                            ->displayFormat('d/m/Y H:i'),

                        Forms\Components\TextInput::make('last_login_ip')
                            ->label('IP Terakhir')
                            ->disabled(),
                    ])
                    ->columns(2)
                    ->collapsible()
                    ->visible(fn($record) => $record && $record->last_login_at),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(
                        fn(User $record): string =>
                        $record->trashed() ? '[TERHAPUS]' : ''
                    ),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Email disalin'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->extraAttributes(fn(User $record): array => [
                        'class' => $record->trashed() ? 'opacity-50' : '',
                    ]),

                Tables\Columns\TextColumn::make('last_login_at')
                    ->label('Terakhir Login')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('last_login_ip')
                    ->label('IP Terakhir')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Dihapus Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->placeholder('-'),
            ])
            ->filters([
                // Filter untuk soft delete dengan placeholder "Semua"
                Tables\Filters\TrashedFilter::make()
                    ->label('Status Hapus')
                    ->placeholder('Semua') // Ini placeholder yang benar
                    ->default(null), // Default ke "Semua"

                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status Aktif')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Nonaktif',
                    ])
                    ->placeholder('Semua Status'), // Tambahkan placeholder

                Tables\Filters\Filter::make('never_logged_in')
                    ->label('Belum Pernah Login')
                    ->query(fn(Builder $query): Builder => $query->whereNull('last_login_at')),

                Tables\Filters\Filter::make('logged_in_last_week')
                    ->label('Login 7 Hari Terakhir')
                    ->query(
                        fn(Builder $query): Builder =>
                        $query->where('last_login_at', '>=', now()->subDays(7))
                    ),
            ])
            ->actions([
                // Action untuk restore user yang di-soft delete
                Tables\Actions\Action::make('restoreUser')
                    ->label('Restore')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->action(function (User $record) {
                        $record->restore();

                        Notification::make()
                            ->title('User Berhasil Dikembalikan')
                            ->body('User ' . $record->name . ' telah berhasil dikembalikan.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Restore User')
                    ->modalDescription(
                        fn(User $record): string =>
                        "Anda akan mengembalikan user {$record->name}. User akan kembali aktif di sistem."
                    )
                    ->modalSubmitActionLabel('Ya, Restore User Ini')
                    ->visible(fn(User $record): bool => $record->trashed()),

                // Action untuk force delete permanen
                Tables\Actions\Action::make('forceDelete')
                    ->label('Hapus Permanen')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->action(function (User $record) {
                        $recordName = $record->name;
                        $record->forceDelete();

                        Notification::make()
                            ->title('User Dihapus Permanen')
                            ->body('User ' . $recordName . ' telah dihapus secara permanen.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Permanen')
                    ->modalDescription('User akan dihapus secara permanen dari database. Tindakan ini tidak dapat dibatalkan!')
                    ->modalSubmitActionLabel('Ya, Hapus Permanen')
                    ->visible(fn(User $record): bool => $record->trashed()),

                // Action Login As (hanya untuk user aktif) - PERBAIKAN: Hilangkan HTML tag dari notification
                Tables\Actions\Action::make('loginAs')
                    ->label('Login As')
                    ->icon('heroicon-o-arrow-right-on-rectangle')
                    ->color('warning')
                    ->action(function (User $record) {
                        // Cek apakah user target aktif
                        if (!$record->is_active) {
                            Notification::make()
                                ->title('Gagal Login As')
                                ->body('User ini tidak aktif.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Cek apakah user sudah dihapus
                        if ($record->trashed()) {
                            Notification::make()
                                ->title('Gagal Login As')
                                ->body('User ini sudah dihapus.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Cek apakah mencoba login as diri sendiri
                        if (auth()->id() === $record->id) {
                            Notification::make()
                                ->title('Gagal Login As')
                                ->body('Tidak bisa login sebagai diri sendiri.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Mulai impersonate
                        auth()->user()->impersonate($record);

                        // Notification sukses TANPA HTML tag
                        Notification::make()
                            ->title('Login As Berhasil')
                            ->body('Anda sekarang login sebagai ' . $record->name)
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Login Sebagai User')
                    ->modalDescription(
                        fn(User $record): string =>
                        "Anda akan login sebagai user {$record->name}. Semua aktivitas akan tercatat atas nama user ini."
                    )
                    ->modalSubmitActionLabel('Ya, Login Sebagai User Ini')
                    ->visible(
                        fn(User $record): bool =>
                        auth()->id() !== $record->id &&
                            $record->is_active &&
                            !$record->trashed()
                    ),

                // Action Reset Password dengan form yang bisa intip password
                Tables\Actions\Action::make('resetPassword')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->color('success')
                    ->form([
                        Forms\Components\TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable() // Fitur intip password
                            ->required()
                            ->rule(Password::default()),

                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable() // Fitur intip password
                            ->required()
                            ->same('new_password'),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->update([
                            'password' => Hash::make($data['new_password'])
                        ]);

                        Notification::make()
                            ->title('Password Berhasil Direset')
                            ->body('Password untuk user ' . $record->name . ' telah berhasil direset.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Reset Password')
                    ->modalDescription(
                        fn(User $record): string =>
                        "Anda akan mereset password untuk user {$record->name}. User akan perlu menggunakan password baru untuk login selanjutnya."
                    )
                    ->modalSubmitActionLabel('Ya, Reset Password')
                    ->visible(fn(User $record): bool => !$record->trashed()),

                Tables\Actions\EditAction::make()
                    ->color('primary')
                    ->visible(fn(User $record): bool => !$record->trashed()),

                Tables\Actions\DeleteAction::make()
                    ->label('Soft Delete')
                    ->color('danger')
                    ->action(function (User $record) {
                        $record->delete();

                        Notification::make()
                            ->title('User Berhasil Dihapus')
                            ->body('User ' . $record->name . ' telah dihapus (soft delete).')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus User')
                    ->modalDescription('User akan dihapus secara soft delete dan dapat dikembalikan nanti.')
                    ->modalSubmitActionLabel('Ya, Hapus User')
                    ->visible(fn(User $record): bool => !$record->trashed()),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Bulk Restore untuk user yang di-soft delete
                    Tables\Actions\BulkAction::make('bulkRestore')
                        ->label('Restore Selected')
                        ->icon('heroicon-o-arrow-uturn-left')
                        ->color('warning')
                        ->action(function ($records) {
                            $restoredCount = 0;
                            foreach ($records as $record) {
                                if ($record->trashed()) {
                                    $record->restore();
                                    $restoredCount++;
                                }
                            }

                            if ($restoredCount > 0) {
                                Notification::make()
                                    ->title($restoredCount . ' User Berhasil Dikembalikan')
                                    ->success()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),

                    // Bulk Force Delete permanen
                    Tables\Actions\BulkAction::make('bulkForceDelete')
                        ->label('Hapus Permanen Selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->action(function ($records) {
                            $deletedCount = 0;
                            foreach ($records as $record) {
                                if ($record->trashed()) {
                                    $record->forceDelete();
                                    $deletedCount++;
                                }
                            }

                            if ($deletedCount > 0) {
                                Notification::make()
                                    ->title($deletedCount . ' User Dihapus Permanen')
                                    ->success()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Hapus Permanen User Terpilih')
                        ->modalDescription('User yang terhapus akan dihapus secara permanen dari database. Tindakan ini tidak dapat dibatalkan!')
                        ->modalSubmitActionLabel('Ya, Hapus Permanen')
                        ->deselectRecordsAfterCompletion(),

                    // Bulk actions untuk user aktif
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $activatedCount = 0;
                            foreach ($records as $record) {
                                if (!$record->trashed()) {
                                    $record->update(['is_active' => true]);
                                    $activatedCount++;
                                }
                            }

                            if ($activatedCount > 0) {
                                Notification::make()
                                    ->title($activatedCount . ' User Diaktifkan')
                                    ->success()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            $deactivatedCount = 0;
                            foreach ($records as $record) {
                                if (!$record->trashed()) {
                                    $record->update(['is_active' => false]);
                                    $deactivatedCount++;
                                }
                            }

                            if ($deactivatedCount > 0) {
                                Notification::make()
                                    ->title($deactivatedCount . ' User Dinonaktifkan')
                                    ->success()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),

                    // Bulk Soft Delete
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Soft Delete Selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->action(function ($records) {
                            $softDeletedCount = 0;
                            foreach ($records as $record) {
                                if (!$record->trashed()) {
                                    $record->delete();
                                    $softDeletedCount++;
                                }
                            }

                            if ($softDeletedCount > 0) {
                                Notification::make()
                                    ->title($softDeletedCount . ' User Dihapus (Soft Delete)')
                                    ->success()
                                    ->send();
                            }
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah User Baru'),
            ])
            ->defaultSort('name', 'asc')
            ->striped()
            ->recordClasses(function (User $record) {
                if ($record->trashed()) {
                    return 'bg-gray-100 dark:bg-gray-800 opacity-70';
                }

                if (!$record->is_active) {
                    return 'bg-red-50 dark:bg-red-900/20';
                }

                return null;
            })
            ->modifyQueryUsing(fn(Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        $total = static::getModel()::count();
        $trashed = static::getModel()::onlyTrashed()->count();

        if ($trashed > 0) {
            return $total . ' (' . $trashed . ' terhapus)';
        }

        return (string) $total;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $trashedCount = static::getModel()::onlyTrashed()->count();

        if ($trashedCount > 0) {
            return 'warning';
        }

        return 'success';
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        $total = static::getModel()::count();
        $active = static::getModel()::where('is_active', true)->count();
        $trashed = static::getModel()::onlyTrashed()->count();

        return "Total: {$total} user | Aktif: {$active} | Terhapus: {$trashed}";
    }

    public static function getUrlWithTrashedFilter(): string
    {
        return static::getUrl('index', [
            'tableFilters' => [
                'trashed' => [
                    'value' => 'trashed',
                ],
            ],
        ]);
    }
}
