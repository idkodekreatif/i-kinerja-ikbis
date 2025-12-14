<?php

namespace App\Filament\Resources\Setting\Periode\PeriodResource\Pages;

use App\Filament\Resources\Setting\Periode\PeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;

class EditPeriod extends EditRecord
{
    protected static string $resource = PeriodResource::class;
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $originalData = $this->record->toArray();

        // Jika mengubah status dari tidak aktif menjadi aktif
        if ($originalData['is_closed'] && !$data['is_closed']) {
            // Nonaktifkan semua periode aktif lainnya
            DB::table('periods')
                ->where('is_closed', false)
                ->where('id', '!=', $this->record->id)
                ->update(['is_closed' => true]);
        }

        return $data;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Periode berhasil diperbarui';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus Periode'),

            Actions\Action::make('view_all')
                ->label('Lihat Semua')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray')
                ->icon('heroicon-o-arrow-left'),
        ];
    }
}
