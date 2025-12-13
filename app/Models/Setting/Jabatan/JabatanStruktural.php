<?php

namespace App\Models\Setting\Jabatan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanStruktural extends Model
{
    use HasFactory;

    protected $table = 'jabatan_struktural';

    protected $fillable = [
        'name',
        'sub_koordinator',
        'description',
        'unit_kerja_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Unit Kerja
    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    // Accessor untuk nama lengkap dengan unit kerja
    public function getNamaLengkapAttribute(): string
    {
        if ($this->unitKerja) {
            return "{$this->name} - {$this->unitKerja->name}";
        }
        return $this->name;
    }

    // Accessor untuk status sub koordinator
    public function getStatusSubKoordinatorAttribute(): string
    {
        return $this->sub_koordinator ? 'Ada' : 'Tidak Ada';
    }

    // Scope untuk filter berdasarkan unit kerja
    public function scopeByUnitKerja($query, $unitKerjaId)
    {
        if ($unitKerjaId) {
            return $query->where('unit_kerja_id', $unitKerjaId);
        }
        return $query;
    }

    // Scope untuk yang memiliki sub koordinator
    public function scopeHasSubKoordinator($query)
    {
        return $query->whereNotNull('sub_koordinator');
    }

    // Scope untuk yang tanpa unit kerja
    public function scopeWithoutUnitKerja($query)
    {
        return $query->whereNull('unit_kerja_id');
    }
}
