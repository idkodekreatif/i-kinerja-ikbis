<?php

namespace App\Models\Itikad\Submission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturer_name',
        'academic_year',
        'semester',
        'A1_score',
        'A1_weighted_score',
        'fileA1',
        'total_score',
    ];

    protected $casts = [
        'A1_score' => 'integer',
        'A1_weighted_score' => 'decimal:2',
        'total_score' => 'decimal:2',
    ];

    // Accessor untuk persentase
    public function getPercentageAttribute()
    {
        return $this->total_score ? round(($this->total_score / 5) * 100, 2) : 0;
    }

    // Mutator untuk total score
    public function setTotalScoreAttribute($value)
    {
        $this->attributes['total_score'] = $value;
        $this->attributes['final_score'] = $value; // Jika final score sama dengan total
    }
}
