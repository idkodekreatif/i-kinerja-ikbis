<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

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
        $today = now()->format('Y-m-d');
        return $query->where('is_closed', false)
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_closed', true)
            ->orWhereDate('end_date', '<', now()->format('Y-m-d'));
    }

    public function scopeCurrent($query)
    {
        return $this->scopeActive($query);
    }

    public function getStatusAttribute()
    {
        $today = now()->format('Y-m-d');

        if ($this->is_closed) {
            return 'Tertutup';
        }

        if ($this->end_date < $today) {
            return 'Kadaluarsa';
        }

        if ($this->start_date > $today) {
            return 'Belum Dimulai';
        }

        return 'Aktif';
    }

    public function getStatusColorAttribute()
    {
        $status = $this->status;

        return match ($status) {
            'Aktif' => 'success',
            'Kadaluarsa' => 'danger',
            'Belum Dimulai' => 'warning',
            'Tertutup' => 'danger',
            default => 'secondary',
        };
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
