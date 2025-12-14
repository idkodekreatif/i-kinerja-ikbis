<?php

namespace App\Filament\Resources\Setting\Indikator\KomponenPoinResource\Pages;

use App\Filament\Resources\Setting\Indikator\KomponenPoinResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKomponenPoin extends EditRecord
{
    protected static string $resource = KomponenPoinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make()
            //     ->label('Hapus')
            //     ->icon('heroicon-o-trash'),

            // Opsional: Tombol reset
            Actions\Action::make('reset')
                ->label('Reset Nilai')
                ->icon('heroicon-o-arrow-path')
                ->color('warning')
                ->requiresConfirmation()
                ->modalHeading('Konfirmasi Reset Nilai')
                ->modalDescription('Apakah Anda yakin ingin mereset seluruh nilai? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Reset')
                ->modalCancelActionLabel('Batal')
                ->action(function () {
                    $this->record->update([
                        'non_jad' => null,
                        'aa'      => null,
                        'lektor' => null,
                        'lk'     => null,
                        'gb'     => null,
                    ]);

                    $this->refreshFormData([
                        'non_jad',
                        'aa',
                        'lektor',
                        'lk',
                        'gb',
                    ]);
                }),
        ];
    }

    // Opsional: Custom redirect setelah edit
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Opsional: Custom message setelah edit
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Komponen poin berhasil diperbarui';
    }

    // Opsional: Validasi sebelum save
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Pastikan semua nilai numerik
        foreach (['non_jad', 'aa', 'lektor', 'lk', 'gb'] as $field) {
            if (isset($data[$field]) && !is_numeric($data[$field])) {
                $data[$field] = null;
            }
        }

        return $data;
    }
}
