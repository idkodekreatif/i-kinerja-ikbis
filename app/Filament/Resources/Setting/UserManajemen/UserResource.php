<?php

namespace App\Filament\Resources\Setting\UserManajemen;

use App\Filament\Resources\Setting\UserManajemen\UserResource\Pages;
use App\Filament\Resources\Setting\UserManajemen\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required(),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\TextInput::make('password')
                ->password()
                ->required(fn($operation) => $operation === 'create')
                ->dehydrated(fn($state) => filled($state))
                ->dehydrateStateUsing(fn($state) => Hash::make($state))
                ->rule(Password::default()),

            Forms\Components\Toggle::make('is_active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('last_login_at')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                /* RESET PASSWORD */
                Tables\Actions\Action::make('resetPassword')
                    ->icon('heroicon-o-key')
                    ->form([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->rule(Password::default()),
                    ])
                    ->action(
                        fn($record, $data) =>
                        $record->update([
                            'password' => Hash::make($data['password'])
                        ])
                    ),

                /* LOGIN AS */
                Tables\Actions\Action::make('loginAs')
                    ->icon('heroicon-o-arrow-right-on-rectangle')
                    ->requiresConfirmation()
                    ->action(function (User $record) {
                        abort_if(!$record->is_active, 403);
                        abort_if(auth()->id() === $record->id, 403);

                        return auth()->user()->impersonate($record);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
