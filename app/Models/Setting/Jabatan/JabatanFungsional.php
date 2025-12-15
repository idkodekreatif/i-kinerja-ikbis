<?php

namespace App\Models\Setting\Jabatan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanFungsional extends Model
{
    use HasFactory;

    protected $table = 'jabatan_fungsional';

    protected $fillable = [
        'name',
        'golongan_min',
        'golongan_max',
        'angka_kredit_min',
        'angka_kredit_next',
        'description'
    ];

    protected $casts = [
        'angka_kredit_min' => 'integer',
        'angka_kredit_next' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Accessor untuk nama lengkap dengan golongan
    public function getNamaLengkapAttribute(): string
    {
        $golongan = '';
        if ($this->golongan_min && $this->golongan_max) {
            $golongan = " ({$this->golongan_min} - {$this->golongan_max})";
        } elseif ($this->golongan_min) {
            $golongan = " ({$this->golongan_min})";
        }

        return $this->name . $golongan;
    }

    // Accessor untuk range golongan
    public function getRangeGolonganAttribute(): string
    {
        if ($this->golongan_min && $this->golongan_max) {
            return "{$this->golongan_min} - {$this->golongan_max}";
        } elseif ($this->golongan_min) {
            return $this->golongan_min;
        }

        return '-';
    }

    // Accessor untuk total angka kredit
    public function getTotalAngkaKreditAttribute(): int
    {
        return $this->angka_kredit_min + $this->angka_kredit_next;
    }

    // Scope untuk filter berdasarkan golongan
    public function scopeByGolongan($query, $golongan)
    {
        return $query->where('golongan_min', '<=', $golongan)
            ->where('golongan_max', '>=', $golongan);
    }
}
