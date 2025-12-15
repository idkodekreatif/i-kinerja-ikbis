<?php

namespace App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\Pages;

use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource;
use App\Models\Setting\Jabatan\UserJabatanFungsional;
use App\Models\Setting\Jabatan\UserJabatanStruktural;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePenempatanPegawai extends CreateRecord
{
    protected static string $resource = PenempatanPegawaiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record->id]);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Pegawai berhasil ditambahkan!';
    }

    protected function getCreatedNotificationDescription(): ?string
    {
        return 'Sekarang Anda dapat menambahkan jabatan dan unit kerja untuk pegawai ini.';
    }

    // Override form untuk create page saja
    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\Select::make('id')
                ->label('Pilih Pegawai')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->required()
                ->placeholder('Cari nama pegawai')
                ->helperText('Pilih pegawai dari daftar user'),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Karena kita memilih existing user, cukup return user yang dipilih
        return \App\Models\User::findOrFail($data['id']);
    }
}
