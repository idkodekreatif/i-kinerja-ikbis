<?php

namespace App\Filament\Resources\Setting\Periode\PeriodResource\Pages;

use App\Filament\Resources\Setting\Periode\PeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;

class CreatePeriod extends CreateRecord
{
    protected static string $resource = PeriodResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika membuat periode aktif, nonaktifkan periode aktif lainnya
        if (isset($data['is_closed']) && !$data['is_closed']) {
            DB::table('periods')->where('is_closed', false)->update(['is_closed' => true]);
        }

        return $data;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Periode berhasil ditambahkan';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
