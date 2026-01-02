<?php

namespace App\Filament\Resources\Penilaian\Itikad;

use App\Filament\Resources\Penilaian\Itikad\PointBResource\Pages;
use App\Filament\Resources\Penilaian\Itikad\PointBResource\RelationManagers;
use App\Models\Penilaian\Itikad\PointB;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PointBResource extends Resource
{
    protected static ?string $model = PointB::class;

    protected static ?string $navigationGroup = 'Itikad';
    protected static ?string $navigationLabel = 'Point B';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationParentItem = null; // Ini adalah parent menu

    // Atau jika ITIKAD adalah Resource tanpa model:
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 2;

    protected static ?string $slug = 'penilaian/itikad/poin-b';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPointBS::route('/'),
            'create' => Pages\CreatePointB::route('/create'),
            'edit' => Pages\EditPointB::route('/{record}/edit'),
        ];
    }
}
