<?php

namespace App\Filament\Resources\Itikad\Submission\AssessmentResource\Pages;

use App\Filament\Resources\Itikad\Submission\AssessmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssessments extends ListRecords
{
    protected static string $resource = AssessmentResource::class;

    public function mount(): void
    {
        parent::mount();

        // ⬇️ Redirect langsung ke halaman create
        $this->redirect(
            AssessmentResource::getUrl('create')
        );
    }
}
