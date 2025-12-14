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

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->rule(Password::default())
                            ->maxLength(255)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('password_confirmation')
                            ->label('Konfirmasi Password')
                            ->password()
                            ->revealable()
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
                    ->weight('bold'),

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
                    ->falseColor('danger'),

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
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status Aktif')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Nonaktif',
                    ])
                    ->placeholder('Semua Status'),

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
                // Action Login As (tetap sama)
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
                            $record->is_active
                    ),

                // Action Reset Password
                Tables\Actions\Action::make('resetPassword')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->color('success')
                    ->form([
                        Forms\Components\TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->required()
                            ->rule(Password::default()),

                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->revealable()
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
                    ->modalSubmitActionLabel('Ya, Reset Password'),

                Tables\Actions\EditAction::make()
                    ->color('primary'),

                // Delete Action (UBAH INI: dari Soft Delete ke Delete Permanen)
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus')
                    ->color('danger')
                    ->action(function (User $record) {
                        $record->delete(); // Ini akan delete permanen karena tidak ada soft delete

                        Notification::make()
                            ->title('User Berhasil Dihapus')
                            ->body('User ' . $record->name . ' telah dihapus permanen dari sistem.')
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Hapus User')
                    ->modalDescription('User akan dihapus secara permanen dari database. Tindakan ini tidak dapat dibatalkan!')
                    ->modalSubmitActionLabel('Ya, Hapus User'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Aktifkan Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_active' => true]);
                            }

                            Notification::make()
                                ->title('User Diaktifkan')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Nonaktifkan Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['is_active' => false]);
                            }

                            Notification::make()
                                ->title('User Dinonaktifkan')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),

                    Tables\Actions\DeleteBulkAction::make(), // Delete permanen
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah User Baru'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
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
