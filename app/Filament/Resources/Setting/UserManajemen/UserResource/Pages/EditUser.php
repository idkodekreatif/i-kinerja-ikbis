<?php

namespace App\Filament\Resources\Setting\UserManajemen\UserResource\Pages;

use App\Filament\Resources\Setting\UserManajemen\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'User berhasil diperbarui';
    }

    protected function afterSave(): void
    {
        // Kirim notifikasi tambahan
        Notification::make()
            ->title('User Berhasil Diperbarui')
            ->body('Data user ' . $this->record->name . ' telah berhasil diperbarui.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('lihatDaftar')
                ->label('Lihat Daftar User')
                ->url(static::getResource()::getUrl('index'))
                ->color('gray')
                ->icon('heroicon-o-list-bullet'),

            Actions\DeleteAction::make()
                ->label('Hapus User')
                ->icon('heroicon-o-trash')
                ->modalHeading('Hapus User')
                ->modalDescription('Apakah Anda yakin ingin menghapus user ini?')
                ->modalSubmitActionLabel('Ya, Hapus')
                ->successNotification(
                    Notification::make()
                        ->title('User Berhasil Dihapus')
                        ->body('User telah dihapus dari sistem.')
                        ->success()
                ),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Simpan Perubahan')
                ->icon('heroicon-o-check'),

            $this->getCancelFormAction()
                ->label('Batal')
                ->color('gray')
                ->url(static::getResource()::getUrl('index')),
        ];
    }

    protected function beforeSave(): void
    {
        // Jika password kosong, jangan update password
        if (empty($this->data['password'])) {
            unset($this->data['password']);
            unset($this->data['password_confirmation']);
        }
    }
}
