<?php
// app/Filament/Forms/Components/AssessmentTable.php

namespace App\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\Component;
use Illuminate\Support\Str;

class AssessmentTable extends Component
{
    protected string $view = 'filament.forms.components.assessment-table';

    protected array|Closure $items = [];
    protected array|Closure $descriptions = [];
    protected string|Closure|null $title = null;
    protected string|Closure|null $totalScoreField = 'total_score';
    protected string|Closure|null $percentageField = 'percentage';

    public static function make(string|Closure|null $title = null): static
    {
        $static = app(static::class);
        $static->title($title);
        $static->configure();

        return $static;
    }

    public function title(string|Closure|null $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function items(array|Closure $items): static
    {
        $this->items = $items;

        return $this;
    }

    public function descriptions(array|Closure $descriptions): static
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function totalScoreField(string|Closure|null $field): static
    {
        $this->totalScoreField = $field;

        return $this;
    }

    public function percentageField(string|Closure|null $field): static
    {
        $this->percentageField = $field;

        return $this;
    }

    public function getItems(): array
    {
        return $this->evaluate($this->items);
    }

    public function getDescriptions(): array
    {
        $defaultDescriptions = [
            '1' => 'Nilai rerata < 3.00 (KURANG)',
            '2' => 'Nilai rerata >= 3.00 - < 3.60 (CUKUP)',
            '3' => 'Nilai rerata >= 3.60 - < 4.60 (BAIK)',
            '4' => 'Nilai rerata >= 4.60 - < 4.80 (SANGAT BAIK)',
            '5' => 'Nilai rerata >= 4.80 - 5.00 (ISTIMEWA)',
        ];

        return $this->evaluate($this->descriptions) ?: $defaultDescriptions;
    }

    public function getTitle(): ?string
    {
        return $this->evaluate($this->title) ?: 'PENDIDIKAN DAN PENGAJARAN';
    }

    public function getTotalScoreField(): string
    {
        return $this->evaluate($this->totalScoreField) ?: 'total_score';
    }

    public function getPercentageField(): string
    {
        return $this->evaluate($this->percentageField) ?: 'percentage';
    }

    public function getState(): mixed
    {
        $state = parent::getState();

        if (is_array($state)) {
            return $state;
        }

        return [];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (AssessmentTable $component, $state) {
            // Inisialisasi state jika kosong
            if (empty($state)) {
                $component->state($this->getItems());
            }
        });

        $this->dehydrated(false);

        // Mendengarkan event untuk update data
        $this->registerListeners([
            'assessment-table::updateScore' => [
                fn(AssessmentTable $component, array $data) =>
                $component->handleScoreUpdate($data),
            ],
        ]);
    }

    public function handleScoreUpdate(array $data): void
    {
        $statePath = $this->getStatePath();
        $items = $this->getState();

        if (isset($data['index']) && isset($data['score'])) {
            $index = $data['index'];
            if (isset($items[$index])) {
                $items[$index]['score'] = $data['score'];
                $weight = $items[$index]['weight'] ?? 1.0;
                $maxScore = $items[$index]['max_score'] ?? 5;

                $items[$index]['weighted_score'] = number_format($data['score'] * $weight, 2);
                $items[$index]['score_over_max'] = $data['score'] . '/' . $maxScore;

                // Update state
                $this->state($items);

                // Hitung total
                $totalScore = 0;
                foreach ($items as $item) {
                    $totalScore += $item['weighted_score'] ?? 0;
                }

                // Update form data menggunakan set
                $this->getContainer()->getForm()->getLivewire()->dispatch('assessment-table::totalUpdated', [
                    'total' => $totalScore,
                    'percentage' => ($totalScore / 5) * 100,
                ]);
            }
        }
    }
}
