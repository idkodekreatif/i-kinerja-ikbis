<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $table = 'periode';
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_closed'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_closed' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_closed', false);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_closed', true);
    }

    public function scopeCurrent($query)
    {
        $today = now()->format('Y-m-d');
        return $query->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->where('is_closed', false);
    }

    public function getStatusAttribute()
    {
        return $this->is_closed ? 'Tidak Aktif' : 'Aktif';
    }

    public function getStatusColorAttribute()
    {
        return $this->is_closed ? 'danger' : 'success';
    }

    public function isActive()
    {
        $today = now()->format('Y-m-d');
        return !$this->is_closed &&
            $this->start_date <= $today &&
            $this->end_date >= $today;
    }

    public function getDurationAttribute()
    {
        return $this->start_date->diffInDays($this->end_date) + 1 . ' hari';
    }
}
