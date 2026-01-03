<?php

namespace App\Filament\Resources\Penilaian\Itikad;

use App\Filament\Resources\Penilaian\Itikad\PointAResource\Pages;
use App\Filament\Resources\Penilaian\Itikad\PointAResource\RelationManagers;
use App\Models\Penilaian\Itikad\PointA;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PointAResource extends Resource
{
    protected static ?string $model = PointA::class;

    protected static ?string $navigationGroup = 'Itikad';
    protected static ?string $navigationLabel = 'Point A';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationParentItem = null; // Ini adalah parent menu

    // Atau jika ITIKAD adalah Resource tanpa model:
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'penilaian/itikad/poin-a';

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
            'index' => Pages\ListPointAS::route('/'),
            'create' => Pages\CreatePointA::route('/create'),
            'edit' => Pages\EditPointA::route('/{record}/edit'),
        ];
    }
}
