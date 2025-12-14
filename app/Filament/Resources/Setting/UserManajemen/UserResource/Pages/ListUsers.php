<?php

namespace App\Filament\Resources\Setting\UserManajemen\UserResource\Pages;

use App\Filament\Resources\Setting\UserManajemen\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
