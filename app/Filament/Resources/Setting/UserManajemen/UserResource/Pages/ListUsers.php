<?php

namespace App\Filament\Resources\Setting\UserManajemen\UserResource\Pages;

use App\Filament\Resources\Setting\UserManajemen\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah User Baru')
                ->icon('heroicon-o-user-plus')
                ->color('primary'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            UserResource\Widgets\UserStatsWidget::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua User')
                ->icon('heroicon-o-user-group')
                ->badge(User::withoutGlobalScopes()->count())
                ->badgeColor('gray')
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->withoutGlobalScopes()
                ),

            'active' => Tab::make('User Aktif')
                ->icon('heroicon-o-check-circle')
                ->badgeColor('success')
                ->badge(User::where('is_active', true)->count())
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->where('is_active', true)
                ),

            'inactive' => Tab::make('User Nonaktif')
                ->icon('heroicon-o-x-circle')
                ->badgeColor('danger')
                ->badge(User::where('is_active', false)->count())
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->where('is_active', false)
                ),
        ];
    }

    public function getDefaultActiveTab(): string|int|null
    {
        return 'all';
    }

    protected function getTableEmptyStateIcon(): ?string
    {
        return 'heroicon-o-user-group';
    }

    protected function getTableEmptyStateHeading(): ?string
    {
        return 'Belum ada user';
    }

    protected function getTableEmptyStateDescription(): ?string
    {
        return 'Klik tombol "Tambah User Baru" untuk membuat user pertama Anda.';
    }

    protected function getTableEmptyStateActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah User Baru')
                ->icon('heroicon-o-plus')
                ->button(),
        ];
    }
}
