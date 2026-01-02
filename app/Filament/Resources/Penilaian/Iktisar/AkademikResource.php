<?php

namespace App\Filament\Resources\Penilaian\Iktisar;

use App\Filament\Resources\Penilaian\Iktisar\AkademikResource\Pages;
use App\Filament\Resources\Penilaian\Iktisar\AkademikResource\RelationManagers;
use App\Models\Penilaian\Iktisar\Akademik;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AkademikResource extends Resource
{
    protected static ?string $model = Akademik::class;

    protected static ?string $navigationGroup = 'Iktisar';
    protected static ?string $navigationLabel = 'Akademik';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationParentItem = null; // Ini adalah parent menu

    // Atau jika ITIKAD adalah Resource tanpa model:
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 3;

    protected static ?string $slug = 'penilaian/iktisar/akademik';

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
            'index' => Pages\ListAkademiks::route('/'),
            'create' => Pages\CreateAkademik::route('/create'),
            'edit' => Pages\EditAkademik::route('/{record}/edit'),
        ];
    }
}
