<?php

namespace App\Filament\Resources\Penilaian\Itikad;

use App\Filament\Resources\Penilaian\Itikad\PointDResource\Pages;
use App\Filament\Resources\Penilaian\Itikad\PointDResource\RelationManagers;
use App\Models\Penilaian\Itikad\PointD;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PointDResource extends Resource
{
    protected static ?string $model = PointD::class;

    protected static ?string $navigationGroup = 'Itikad';
    protected static ?string $navigationLabel = 'Point D';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationParentItem = null; // Ini adalah parent menu

    // Atau jika ITIKAD adalah Resource tanpa model:
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 4;

    protected static ?string $slug = 'penilaian/itikad/poin-d';

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
            'index' => Pages\ListPointDS::route('/'),
            'create' => Pages\CreatePointD::route('/create'),
            'edit' => Pages\EditPointD::route('/{record}/edit'),
        ];
    }
}
