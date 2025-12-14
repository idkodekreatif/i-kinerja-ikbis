<?php

namespace App\Filament\Resources\Setting\UserManajemen\UserResource\Pages;

use App\Filament\Resources\Setting\UserManajemen\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'User berhasil dibuat';
    }

    protected function afterCreate(): void
    {
        // Kirim notifikasi tambahan
        Notification::make()
            ->title('User Berhasil Ditambahkan')
            ->body('User ' . $this->record->name . ' telah berhasil ditambahkan ke sistem.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('kembali')
                ->label('Kembali ke Daftar User')
                ->url(static::getResource()::getUrl('index'))
                ->color('gray')
                ->icon('heroicon-o-arrow-left'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan User')
                ->icon('heroicon-o-user-plus'),

            $this->getCancelFormAction()
                ->label('Batal')
                ->color('gray'),
        ];
    }
}
