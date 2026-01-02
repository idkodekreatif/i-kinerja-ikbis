<?php

namespace App\Filament\Resources\Itikad\Submission;

use App\Filament\Resources\Itikad\Submission\AssessmentResource\Pages;
use App\Filament\Resources\Itikad\Submission\AssessmentResource\RelationManagers;
use App\Models\Itikad\Submission\Assessment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Forms\Components\AssessmentTable;

class AssessmentResource extends Resource
{
    protected static ?string $model = Assessment::class;

    protected static ?string $navigationGroup = 'Penilaian';
    protected static ?string $navigationLabel = 'Assesment';
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $navigationParentItem = null; // Ini adalah parent menu

    // Atau jika ITIKAD adalah Resource tanpa model:
    protected static bool $shouldRegisterNavigation = true;
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dosen')
                    ->schema([
                        Forms\Components\TextInput::make('lecturer_name')
                            ->label('Nama Dosen')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('academic_year')
                                    ->label('Tahun Akademik')
                                    ->required()
                                    ->placeholder('2023/2024')
                                    ->maxLength(9),

                                Forms\Components\Select::make('semester')
                                    ->label('Semester')
                                    ->required()
                                    ->options([
                                        'Gasal' => 'Gasal',
                                        'Genap' => 'Genap',
                                    ]),
                            ]),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Penilaian Kompetensi - Pendidikan dan Pengajaran')
                    ->schema([
                        AssessmentTable::make('PENDIDIKAN DAN PENGAJARAN')
                            ->items([
                                [
                                    'code' => 'A.1',
                                    'description' => 'Nilai rerata evaluasi perkuliahan untuk sem. Gasal - sem. Genap',
                                    'weight' => 1.0,
                                    'max_score' => 5,
                                    'has_file' => true,
                                    'file_label' => 'Upload Hasil evaluasi perkuliahan',
                                    'file_helper' => '* File PDF/Image maks 10MB',
                                    'file_required' => true,
                                ],
                            ])
                            ->statePath('assessment_items')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Hitung total dari weighted scores
                                $total = 0;
                                if (is_array($state)) {
                                    foreach ($state as $item) {
                                        $total += $item['weighted_score'] ?? 0;
                                    }
                                }

                                $set('total_score', $total);
                                $set('percentage', ($total / 5) * 100);
                            }),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Rekapitulasi')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('total_score')
                                    ->label('Total Skor')
                                    ->numeric()
                                    ->readOnly()
                                    ->default(0)
                                    ->live(),

                                Forms\Components\TextInput::make('max_total_score')
                                    ->label('Skor Maksimal')
                                    ->numeric()
                                    ->readOnly()
                                    ->default(5),

                                Forms\Components\TextInput::make('percentage')
                                    ->label('Persentase (%)')
                                    ->numeric()
                                    ->readOnly()
                                    ->suffix('%')
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lecturer_name')
                    ->label('Nama Dosen')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('academic_year')
                    ->label('Tahun Akademik')
                    ->sortable(),

                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_score')
                    ->label('Total Skor')
                    ->numeric(2)
                    ->sortable(),

                Tables\Columns\TextColumn::make('percentage')
                    ->label('Persentase')
                    ->suffix('%')
                    ->getStateUsing(function ($record) {
                        return $record->total_score ? round(($record->total_score / 5) * 100, 2) : 0;
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('semester')
                    ->options([
                        'Gasal' => 'Gasal',
                        'Genap' => 'Genap',
                    ]),

                Tables\Filters\SelectFilter::make('academic_year')
                    ->options(function () {
                        return Assessment::query()
                            ->select('academic_year')
                            ->distinct()
                            ->pluck('academic_year', 'academic_year')
                            ->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListAssessments::route('/'),
            'create' => Pages\CreateAssessment::route('/create'),
            'edit' => Pages\EditAssessment::route('/{record}/edit'),
        ];
    }
}
