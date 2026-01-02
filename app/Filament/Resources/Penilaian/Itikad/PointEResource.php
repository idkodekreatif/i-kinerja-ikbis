<?php

namespace App\Filament\Resources\Penilaian\Itikad;

use App\Filament\Resources\Penilaian\Itikad\PointEResource\Pages;
use App\Filament\Resources\Penilaian\Itikad\PointEResource\RelationManagers;
use App\Models\Penilaian\Itikad\PointE;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PointEResource extends Resource
{
    protected static ?string $model = PointE::class;

    protected static ?string $navigationGroup = 'Itikad';
    protected static ?string $navigationLabel = 'Point E';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationParentItem = null; // Ini adalah parent menu

    // Atau jika ITIKAD adalah Resource tanpa model:
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 5;

    protected static ?string $slug = 'penilaian/itikad/poin-e';

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
            'index' => Pages\ListPointES::route('/'),
            'create' => Pages\CreatePointE::route('/create'),
            'edit' => Pages\EditPointE::route('/{record}/edit'),
        ];
    }
}
