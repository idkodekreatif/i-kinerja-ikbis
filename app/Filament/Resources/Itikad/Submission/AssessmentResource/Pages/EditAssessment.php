<?php

namespace App\Filament\Resources\Itikad\Submission\AssessmentResource\Pages;

use App\Filament\Resources\Itikad\Submission\AssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssessment extends EditRecord
{
    protected static string $resource = AssessmentResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Hitung total score dari weighted scores
        $totalScore = 0;
        if (isset($data['assessment_items'])) {
            foreach ($data['assessment_items'] as $item) {
                $totalScore += $item['weighted_score'] ?? 0;
            }
        }

        $data['total_score'] = $totalScore;
        return $data;
    }
}
