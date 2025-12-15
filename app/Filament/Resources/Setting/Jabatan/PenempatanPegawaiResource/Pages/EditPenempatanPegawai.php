<?php

namespace App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource\Pages;

use App\Filament\Resources\Setting\Jabatan\PenempatanPegawaiResource;
use App\Models\Setting\Jabatan\UserJabatanFungsional;
use App\Models\Setting\Jabatan\UserJabatanStruktural;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPenempatanPegawai extends EditRecord
{
    protected static string $resource = PenempatanPegawaiResource::class;
    protected function getHeaderActions(): array
    {
        return [
            // Hapus atau comment Actions\DeleteAction::make()
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Data pegawai berhasil diperbarui!';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Override form untuk edit page (kosong karena hanya relation managers)
    protected function getFormSchema(): array
    {
        return [
            \Filament\Forms\Components\Section::make('Informasi Pegawai')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('name')
                        ->label('Nama Pegawai')
                        ->disabled()
                        ->dehydrated(false),

                    \Filament\Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->disabled()
                        ->dehydrated(false),
                ])
                ->columns(2),
        ];
    }
}
