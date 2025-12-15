<?php

namespace App\Models\Setting\Jabatan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerja';

    protected $fillable = [
        'name',
        'type',
        'description'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk unit kerja akademik
    public function scopeAkademik($query)
    {
        return $query->where('type', 'Akademik');
    }

    // Scope untuk unit kerja non-akademik
    public function scopeNonAkademik($query)
    {
        return $query->where('type', 'Non-akademik');
    }

    // Get nama dengan tipe
    public function getNamaLengkapAttribute()
    {
        if ($this->type) {
            return $this->name . " ({$this->type})";
        }
        return $this->name;
    }

    public function jabatanStruktural()
    {
        return $this->hasMany(JabatanStruktural::class);
    }
}
